<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CustomHandler
{
    public static function renderCustom(Throwable $e, $message = ""): RedirectResponse
    {
        if ($e instanceof NotFoundHttpException) {
            return back($e->getStatusCode())->with('error', 'Pagina non trovata');
        }

        if ($e instanceof ModelNotFoundException) {
            return back(404)->with('error', 'Dato non trovato');
        }

        if ($e instanceof QueryException) {
            return back(500)->with('error', 'Errore di dati');
        }

        if ($e instanceof ValidationException) {
            return back($e->status)->with('message', $message)->with('error', $e->errors());
        }

        return back($e->getMessage() ?? 500)->with('message', $message)->with('error', $e->getMessage());
    }
}
