<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function setLanguage($locale)
    {
        // Validate the locale
        $availableLocales = ['az', 'ru', 'en'];
        if (in_array($locale, $availableLocales)) {
            session(['applocale' => $locale]);
        }

        return redirect()->back();
    }
}

