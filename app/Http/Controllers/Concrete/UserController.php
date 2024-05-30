<?php

namespace App\Http\Controllers\Concrete;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Exceptions\CustomHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\Password;
use App\Http\Controllers\AbstractCrudController;

class UserController extends AbstractCrudController
{
    protected static $base_uri = [
        0 => 'AUTH_PROD',   //prod
        1 => 'AUTH_TEST'    //test
    ];

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->request();
        // $this->middleware(['role_or_permission:Docente|Scrivere Ruoli']);
    }

    public function create(Request $request): RedirectResponse|JsonResponse
    {
        try {
            $request->validate(
                [
                    'username' => ['required', 'string', 'unique:App\Models\User', 'min:3', 'max:50'],
                    'email' => ['required', 'email', 'unique:App\Models\User', 'min:6'],
                    'password' => ['required', 'confirmed', Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised()],
                ],
                $this::$errors,
            );

            $data = $request->all();

            $user = User::create($data);

            return redirect('/dashboard', 201)->with('success', trans('auth.registerSucc'))->with("data", $user);
        } catch (\Exception $e) {
            return CustomHandler::renderCustom($e, trans('auth.errors.register'));
        }
    }

    public function read(Request $request): JsonResponse|RedirectResponse
    {
        try {
            throw new Exception('Not implemented');
        } catch (\Exception $e) {
            return CustomHandler::renderCustom($e, trans('main.errors.read'));
        }
    }

    public function update(Request $request): JsonResponse
    {
        try {
            throw new Exception('Not implemented');
        } catch (\Exception $e) {
            return CustomHandler::renderCustom($e, trans('main.errors.update'));
        }
    }

    public function delete(Request $request): JsonResponse
    {
        try {
            throw new Exception('Not implemented');
        } catch (\Exception $e) {
            return CustomHandler::renderCustom($e, trans('main.errors.delete'));
        }
    }
}
