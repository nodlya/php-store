<?php

namespace App\Providers;

use App\Models\Basket;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot() {
        View::composer('layout.part.roots', function($view) {
            $view->with(['items' => Category::roots()]);
        });
        View::composer('layout.part.brands', function($view) {
            $view->with(['items' => Brand::popular()]);
        });
        View::composer('layout.site', function($view) {
            $view->with(['positions' => Basket::getCount()]);
        });
    }
}
