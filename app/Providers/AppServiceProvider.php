<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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

        view()->composer('master.sidebar',function($view){
            $view->with('latestGroups', \App\Group::latestGroups());
        });

        view()->composer('master.sidebar', function($view){
            $view->with('randomMembers', \App\User::randomMembers());
        });
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
