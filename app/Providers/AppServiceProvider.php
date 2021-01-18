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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 以下を追記:現在ではHTTPSが標準になっているため、HTTPSに設定します。
        if (\App::environment('production')) {
            \URL::forceScheme('https');
        }
    }
}
