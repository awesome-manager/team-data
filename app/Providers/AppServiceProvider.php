<?php

namespace App\Providers;

use App\TeamData\Repositories;
use Illuminate\Support\ServiceProvider;
use App\TeamData\Contracts as Contracts;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Contracts\Repositories\Repository::class, Repositories\Repository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
