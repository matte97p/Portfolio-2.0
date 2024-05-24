<?php

namespace App\Http\Controllers\Concrete;

use Exception;
use Illuminate\Http\Request;
use App\Exceptions\CustomHandler;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\AbstractApiController;

class AuthController extends AbstractApiController
{
    protected static $base_uri = [
        0 => 'AUTH_PROD',   //prod
        1 => 'AUTH_TEST'    //test
    ];

    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    protected function getBaseUri(): string
    {
        return env(self::$base_uri[(int) App::isLocal()]);
    }

    /**
     * Login OAuth2 -> oauth/token Passport
     *
     * @var Request $request
     *
     * @return RedirectResponse
     *
     * @throws Exception
     */
    public function login(Request $request): RedirectResponse
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'username' => ['required'],
                    'password' => ['required', 'string'],
                ],
                $this::$errors,
            );

            if ($validator->fails()) {
                throw ValidationException::withMessages($validator->errors()->all());
            }

            $credentials = [
                'name' => $request->get('username'),
                'password' => $request->get('password'),
            ];

            if (!Auth::attempt($credentials)) {
                return redirect()->back()->withErrors('Credenziali errate!');
            }

            // $token = Auth::user()->createToken('passportToken')->accessToken;

            return redirect('/dashboard', 201)->with('success', 'Login effettuato con successo!');
        } catch (\Exception $e) {
            return CustomHandler::renderCustom($e, "Login fallito!");
        }
    }

    /**
     * Logout OAuth2 -> oauth/token Passport
     *
     * @var Request $request
     *
     * @return RedirectResponse
     *
     * @throws Exception
     */
    public function logout(): RedirectResponse
    {
        try {
            if (!Auth::check()) {
                return response()->json(["message" => "Utente non loggato!"], 401);
            }

            Auth::logout();
            // Auth::user()->token()->revoke();

            return redirect('/login', 201)->with('success', 'Logout effettuato con successo!');
        } catch (\Exception $e) {
            return CustomHandler::renderCustom($e, "Login fallito!");
        }
    }
}
