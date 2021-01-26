<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\Admin\HotelRepositoryInterface::class,
            \App\Repositories\Admin\HotelRepository::class
        );
        $this->app->bind(
            \App\Repositories\Admin\ProvinceRepositoryInterface::class,
            \App\Repositories\Admin\ProvinceRepository::class
        );
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
