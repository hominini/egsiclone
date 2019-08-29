<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // reemplazando el campo que se utiliza para loguearse a cédula
    public function username()
    {
        return 'cedula';
    }

    /**
     * Sobreescribiendo el método para validar los parámetros
     * del login
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => [
                'required',
                'string',
                // TODO: realizar una validación más robusta de la cédula, (cálculo del último digito)
                'regex:/^(0[1-9]|1[0-9]|2[0-4]|30)[0-6][0-9]{7}([0-9][0-9][0-9])?$/',
            ],
            'password' => 'required|string',
        ]);
    }
}
