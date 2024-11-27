<?php

namespace App\Providers;

use App\Http\Controllers\MainmenuController;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        view()->composer('components.theme.sidebar', function($view) {
			$menuController = new MainmenuController();
			$view->with('menus', $menuController->getMenus());
		});
    }
}
