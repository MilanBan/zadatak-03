<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function ($data, $status_code = 200) {
            return response()->json($data, $status_code);
        });

        Response::macro('error', function ($messages, $status_code) {
            return response()->json(['messages' => $messages], $status_code);
        });
    }
}
