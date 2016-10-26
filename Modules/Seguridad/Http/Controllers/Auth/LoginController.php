<?php

namespace Modules\Seguridad\Http\Controllers\Auth;

use Auth;
use Cache;
use ErrorException;
use Illuminate\Http\Request;
use JWTAuth;
use Modules\Seguridad\Entities\Role;
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
        $this->middleware('jwt.auth', ['except' => 'login'] );
    }

    public function login(Request $request)
    {
        $credentials = $request->only('identification', 'password');

        try {
            // verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                // return response()->json(['error' => trans('validation.invalid_user')], 401);
                return response()->json(['error' => 'Usuario Invalido'], 400);
            } elseif (!Auth::user()->active) {
                // Auth::logout();
                // return response()->json(['error' => trans('validation.active_user')], 401);
                return response()->json(['error' => 'Usuario No activo'], 401);
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
        return '<h1>Hola test</h1>';
    }

    public function user()
    {
        $user_login = $this->getUser();
        $acl = $this->getPermissions();
        return response()->json(['user' => $user_login, 'acl' => $acl]);
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

    private function getPermissions()
    {
        $identification = Auth::user()->identification;
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
                foreach ($roles_collection as $key => $value_role) {
                    $permissions = [];
                    foreach ($value_role->perms as $key2 => $value_permission) {
                        array_push($permissions, $value_permission->name);
                    }
                    array_push($acl, [$value_role->name => $permissions]);
                }
                Cache::forever('acl_'.$identification, $acl);

            } catch (ErrorException $e) {
                return response()->json(['error' => trans('validation.permissions_user')], 401);
            }
        } else {
            $acl = Cache::get('acl_'.$identification);
        }

        return $acl;
    }
}
