<?php

namespace Modules\Seguridad\Http\Controllers\Auth;

use Auth;
use Cache;
use ErrorException;
use Illuminate\Http\Request;
use JWTAuth;
use Modules\Seguridad\Entities\Usuario;
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
                return response()->json(['error' => 'Usuario Invalido'], 401);
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

    public function user()
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
        return response()->json(compact('user'));
    }

    public function permissions()
    {
        $username = Auth::user()->username;
        Cache::flush();
        if (!Cache::has('role_'.$username) || !Cache::has('permissions_'.$username)) {
            try {
                $getRole = Auth::user()->roles();
                return response()->json(['acl' => $getRole], 200);
                $role = $getRole[0]->name;

                $getPermissions = Auth::user()->permissions();
                $permissions = [];

                foreach ($getPermissions as $key => $value) {
                    array_push($permissions, $value->name);
                }
                Cache::forever('role_'.$username, $role);
                Cache::forever('permissions_'.$username, $permissions);

            } catch (ErrorException $e) {
                Auth::logout();
                return response()->json(['error' => trans('validation.permissions_user')], 401);
            }
        } else {
            $role = Cache::get('role_'.$username);
            $permissions = Cache::get('permissions_'.$username);
        }

        return response()->json(['acl' => [$role => $permissions]], 200);
    }
}
