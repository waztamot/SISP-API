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
        $credentials = $request->only('cedula', 'password');

        try {
            // verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                // return response()->json(['error' => trans('validation.invalid_user')], 401);
                return response()->json(['error' => 'Usuario Invalido'], 400);
            } elseif (!Auth::user()->activo) {
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

    public function usuario()
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
        $user = ['cedula' => $user->cedula, 'nombre' => $user->nombre];
        return response()->json(compact('user'));
    }

    public function permisos()
    {
        $cedula = Auth::user()->cedula;
        Cache::flush();
        if (!Cache::has('acl_'.$cedula)) {
            try {
                $getRoles = Auth::user()->getRoles();

                $rolesIds = [];
                foreach ($getRoles as $key => $value) {
                    array_push($rolesIds, $value->id);
                }

                $rolesCollection = Role::with('perms')->whereIn('id', $rolesIds)->get();

                $acl = [];
                foreach ($rolesCollection as $key => $valueRole) {
                    $permisos = [];
                    foreach ($valueRole->perms as $key2 => $valuePermission) {
                        array_push($permisos, $valuePermission->name);
                    }
                    array_push($acl, [$valueRole->name => $permisos]);
                }
                Cache::forever('acl_'.$cedula, $acl);

            } catch (ErrorException $e) {
                return response()->json(['error' => trans('validation.permisos_usuario')], 401);
            }
        } else {
            $acl = Cache::get('acl_'.$cedula);
        }

        return response()->json(['acl' => $acl], 200);
    }
}
