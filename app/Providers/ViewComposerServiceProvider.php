<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Product;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('components.layout', function ($view) {
            $view->with([
                'stockCount' => Product::count(),
                'userCount'  => User::count(),
            ]);
        });
    }
}