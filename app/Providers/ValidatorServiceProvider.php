<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['validator']->extend('array_filled', function ($attribute, $value, $parameters, $validator) 
        {
            $validator->setCustomMessages(['array_filled' => 'Необходимо добавить как минимум одну референцию.']);
            return (empty(array_filter($value))) ? false : true;
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
