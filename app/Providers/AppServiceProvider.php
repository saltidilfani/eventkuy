<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        // Share categories with the public navbar
        try {
            View::composer('layouts.publik', function ($view) {
                $navbarCategories = Category::has('events')->orderBy('name')->get();
                $view->with('navbarCategories', $navbarCategories);
            });
        } catch (\Exception $e) {
            // Failsafe for when migrating or other commands run before DB is ready
            View::composer('layouts.publik', function ($view) {
                $view->with('navbarCategories', collect());
            });
        }
    }
}
