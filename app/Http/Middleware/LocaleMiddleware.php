<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;

class LocaleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // translatable.php-dən mövcud dilləri alırıq
        $locales = Config::get('translatable.locales');

        if (Session::has('locale') && in_array(Session::get('locale'), $locales)) {
            $locale = Session::get('locale');
            Config::set('translatable.locale', $locale);
            App::setLocale($locale);
        } else {
            // Default dili translatable.php-dən alırıq
            $defaultLocale = Config::get('translatable.locale');
            Config::set('translatable.locale', $defaultLocale);
            App::setLocale($defaultLocale);
            Session::put('locale', $defaultLocale);
        }

        return $next($request);
    }
}
