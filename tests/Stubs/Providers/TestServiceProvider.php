<?php

namespace CleaniqueCoders\OpenPayroll\Tests\Stubs\Providers;

use Illuminate\Support\ServiceProvider;

class TestServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \CleaniqueCoders\OpenPayroll\OpenPayroll::routes();
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
