<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function switchLang($locale)
    {
        // translatable.php-dən mövcud dilləri yoxlayırıq
        $locales = Config::get('translatable.locales');

        if (!in_array($locale, $locales)) {
            abort(400);
        }

        // translatable.php-də locale-i yeniləyirik
        Config::set('translatable.locale', $locale);
        Session::put('locale', $locale);
        App::setLocale($locale);

        return redirect()->back();
    }
}
