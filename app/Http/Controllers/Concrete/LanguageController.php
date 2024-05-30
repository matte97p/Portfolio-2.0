<?php

namespace App\Http\Controllers\Concrete;

use Illuminate\Support\Facades\App;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AbstractGenericController;

class LanguageController extends AbstractGenericController
{
    /**
     * @var string $locale
     *
     * @return Redirect
     */
    public function setLocale($locale): RedirectResponse
    {
        if (! in_array($locale, ['en', 'it'])) {
            return redirect()->back()->withErrors('Language not available!');
        }

        Session::put('locale', $locale);
        App::setLocale($locale);

        return redirect()->back();
    }
}
