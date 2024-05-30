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
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class CustomHandler
{
    public static function renderCustom(Throwable $e, $message = ""): RedirectResponse|JsonResponse
    {
        if ($e instanceof NotFoundHttpException || $e instanceof RouteNotFoundException || $e instanceof ModelNotFoundException) {
            return response()->json(["message" => $message, "error" => $e], 404);
        }

        if ($e instanceof UnauthorizedException) {
            return response()->json(["message" => trans('main.errors.permission'), "error" => $e], 403);
        }

        if ($e instanceof ValidationException) {
            return redirect()->back()->with('message', $message)->withErrors($e->errors())->withInput();
            // return response()->json(["message" => $message, "error" => $e->errors()], $e->status);
        }

        if ($e instanceof QueryException) {
            return response()->json(["message" => $message, "error" => trans('main.errors.dataE')], 500);
        }

        return response()->json(["message" => $message, "error" => $e->getMessage()], $e->status ?? 500);
    }
}
