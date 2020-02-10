<?php

namespace App\Providers;

use Illuminate\Auth\EloquentUserProvider;

class CustomAuthEloquentProvider extends EloquentUserProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
