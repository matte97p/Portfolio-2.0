<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CustomHandler
{
    public static function renderCustom(Throwable $e, $message = ""): RedirectResponse|JsonResponse
    {
        if ($e instanceof NotFoundHttpException) {
            return back($e->getStatusCode())->with('error', trans('main.errors.pageNF'));
        }

        if ($e instanceof ModelNotFoundException) {
            return back(404)->with('error', trans('main.errors.pageNF'));
        }

        if ($e instanceof QueryException) {
            return back(500)->with('error', trans('main.errors.dataE'));
        }

        if ($e instanceof ValidationException) {
            return redirect()->back()->withErrors($message);
            // return response()->json(["message" => $message, "error" => $e->errors()], $e->status);
            // return redirect()->back($e->status)->with('message', $message)->withErrors($e->errors());
        }

        if ($e instanceof UnauthorizedException) {
            return response()->json(["message" => trans('main.errors.permission'), "error" => $e], 403);
        }

        return back($e->status ?? 500)->with('message', $message)->with('error', $e->getMessage());
    }
}
