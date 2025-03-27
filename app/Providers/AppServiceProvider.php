<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Plat;
use App\Observers\PlatObserver;


class AppServiceProvider extends ServiceProvider
{
    public function boot()
{
    Plat::observe(PlatObserver::class);
}
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

}
