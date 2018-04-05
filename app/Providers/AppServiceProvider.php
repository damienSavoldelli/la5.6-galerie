<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use App\Models\Category;
use Illuminate\Pagination\AbstractPaginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      Schema::defaultStringLength(191);

      setLocale(LC_TIME, config('app.locale'));

      AbstractPaginator::defaultView("pagination::bootstrap-4");

      Blade::if('admin', function () {
          return auth()->check() && auth()->user()->role === 'admin';
      });

      Blade::if('adminOrOwner', function ($id) {
          return auth()->check() && (auth()->id() === $id || auth()->user()->role === 'admin');
      });

      if(request()->server("SCRIPT_NAME") !== 'artisan') {
          view()->share('categories', Category::all());
      }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
