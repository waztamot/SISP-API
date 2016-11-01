<?php

namespace Modules\Security\Http\Controllers\Auth;

use Auth;
use Cache;
use ErrorException;
use Illuminate\Http\Request;
use JWTAuth;
use Modules\Security\Entities\Role;
use Nwidart\Modules\Facades\Module;
use SISP\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;

class LoginController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Login Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles authenticating users for the application and
  | redirecting them to your home screen. The controller uses a trait
  | to conveniently provide its functionality to your applications.
  |
  */

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    // $this->middleware('jwt.auth', ['except' => 'login'] );
  }

  public function login(Request $request)
  {
    $credentials = $request->only('identification', 'password');

    try {
      // verify the credentials and create a token for the user
      if (!$token = JWTAuth::attempt($credentials)) {
        return response()->json(['error' => trans('auth.failed')], 400);
      } elseif (!Auth::user()->active) {
        // Auth::logout();
        return response()->json(['error' => trans('validation.custom.user.inactive')], 401);
      }
    } catch (JWTException $e) {
      // something went wrong
      return response()->json(['error' => 'could_not_create_token'], 500);
    }   

    // if no errors are encountered we can return a JWT
    return response()->json(compact('token'), 200);
  }

  /* No Implementado */
  public function logout()
  {
    if (Auth::logout()) {
      return response()->json(['success' => true], 200);
    }

    return response()->json(['error' => true], 200);
  }

  public function test()
  {
    $user = Auth::check();
    return response()->json(['user' => $user]);
  }

  public function user()
  {
    $user_login = $this->getUser();
    $modules = $this->getModules();
    $acl = $this->getPermissions($modules);
    return response()->json(['user' => $user_login, 'modules' => $modules, 'acl' => $acl]);
  }

  private function getUser()
  {
    try {
      if (!$user = JWTAuth::parseToken()->authenticate()) {
        return response()->json(['user_not_found'], 404);
      }
    } catch (TokenExpiredException $e) {
      return response()->json(['token_expired'], $e->getStatusCode());
    } catch (TokenInvalidException $e) {
      return response()->json(['token_invalid'], $e->getStatusCode());
    }   catch (JWTException $e) {
      return response()->json(['token_absent'], $e->getStatusCode());
    }
    //The token is valid and we have found the user via the sub claim
    $user = ['identification' => $user->identification, 'name' => $user->name];
    return $user;
  }

  public function permissions()
  {
    
    $acl = $this->getPermissions();
    return response()->json(['acl' => $acl], 200);
  }

  private function getPermissions(&$modules = null)
  {
    $user = Auth()->user();
    $identification = $user->identification;
    Cache::flush();
    if (!Cache::has('acl_'.$identification)) {
      try {
        $get_roles = Auth::user()->getRoles();

        $roles_ids = [];
        foreach ($get_roles as $key => $value) {
          array_push($roles_ids, $value->id);
        }

        $roles_collection = Role::with('perms')->whereIn('id', $roles_ids)->get();

        $acl = [];
        $modules_active_byUser = [];
        $modules_active = collect($modules);
        foreach ($roles_collection as $key => $value_role) {
          $permissions = [];
          foreach ($value_role->perms as $key2 => $value_permission) {
            if ($modules !== null) {
              $exist = strpos($value_permission->name, '.');
              if ($exist === false) {
                $var_cmp = strtolower($value_permission->name);
              } else {
                $var_cmp = strtolower(strstr($value_permission->name, ".",true));
              }
              
              if ($modules_active->get($var_cmp)) {
                array_push($modules_active_byUser, $var_cmp);
                array_push($permissions, $value_permission->name);
              }
            } else {
              array_push($permissions, $value_permission->name);
            }
          }
          $acl = array ($value_role->name => $permissions) + $acl;
        }
        Cache::forever('acl_'.$identification, $acl);

      } catch (ErrorException $e) {
        return response()->json(['error' => trans('validation.custom.user.permits')], 401);
      }
    } else {
      $acl = Cache::get('acl_'.$identification);
    }

    $modules_list = [];
    if ($modules !== null) {
      $modules_active_byUser = array_unique($modules_active_byUser);
      foreach ($modules as $key => $value_module) {
        $ok_module = false;
        foreach ($modules_active_byUser as $value) {
          if ($key === $value || $value_module == false) {
            $ok_module = true;
            break;
          }
        }
        if ($ok_module){
          $modules_list = array ($key => $value_module) + $modules_list;
        }
      }
      if (count($modules_active_byUser) > 0) {
        $modules = $modules_list;
      }
    }

    return $acl;
  }

  public function modules()
  {
    $modules = $this->getModules();
    return response()->json(compact('modules'));
  }

  private function getModules()
  {
    $modules = [];
    $list_module = Module::all();

    foreach ($list_module as $module) {
      $modules = array(
              $module->getStudlyName() => $module->enabled() ? true : false
            ) + $modules;
    }

    return array_change_key_case($modules);
  }
}
