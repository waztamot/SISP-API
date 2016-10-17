<?php

namespace Modules\Seguridad\Http\Controllers\Auth;

use Auth;
use Cache;
use ErrorException;
use Illuminate\Http\Request;
use JWTAuth;
use SISP\Entities\User;
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
}
