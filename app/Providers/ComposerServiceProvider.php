<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Http\ViewComposers\PrimaryMenuComposer;
use App\Http\ViewComposers\CategoryMenuComposer;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot()
    {
        view()->composer('partials.menus.primary-menu', PrimaryMenuComposer::class);
        view()->composer('partials.menus.category-menu', CategoryMenuComposer::class);
    }
}
