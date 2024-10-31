<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Service;
use Illuminate\Pagination\Paginator;


class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        //
    }

    public function boot()
    {
        View::composer('front.home.footer', function ($view) {
            $view->with('footerServices', Service::all());
        });

        view()->composer('front.about', function ($view) {
            $view->with('services', Service::all());
        });

        view()->composer('front.gallery', function ($view) {
            $view->with('services', Service::all());
        });
        view()->composer('front.blog', function ($view) {
            $view->with('services', Service::all());
        });
        view()->composer('front.contact', function ($view) {
            $view->with('services', Service::all());
        });
        view()->composer('front.readmore', function ($view) {
            $view->with('services', Service::all());
        });
        View::composer('*', function ($view) {
            $allServices = Service::all();
            $view->with('allServices', $allServices);
        });

        Paginator::defaultView('pagination::default');
        Paginator::defaultSimpleView('pagination::simple-default');
    }
}
