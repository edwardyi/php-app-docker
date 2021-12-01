<?php

namespace edwardyi\Press;

use edwardyi\Press\Console\ProcessCommand;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use edwardyi\Press\Facades\Press;

class PressBaseServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerPublishing();
        }

        $this->registerResources();
    }

    public function register()
    {
        $this->commands([
            ProcessCommand::class
        ]);
    }

    private function registerResources()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'press'); // use press alias to access package's view

        $this->registerFacades();

        $this->registerRoutes();

        $this->registerFields();
    }

    protected function registerPublishing()
    {
        $this->publishes([
            __DIR__.'/../config/press.php' => config_path('press.php')
        ], 'press-config');

        $this->publishes([
            __DIR__.'/Console/stubs/PressServiceProvider.stub' => app_path('PressServiceProvider.php')
        ], 'press-provider');
    }

    private function loadRouteConfigurations()
    {
        return [
            'prefix' => Press::path(), // call static method path to load path from config
            'namespace' => 'edwardyi\Press\Http\Controllers'
        ];
    }

    protected function registerRoutes()
    {
        Route::group($this->loadRouteConfigurations(), function(){
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });
    }

    protected function registerFacades()
    {
        $this->app->singleton('Press', function($app) {
            return new \edwardyi\Press\Press();
        });
    }

    protected function registerFields()
    {
        Press::fields([
            Fields\Body::class,
            Fields\Date::class,
            Fields\Extra::class,
            Fields\Title::class,
            Fields\Description::class
        ]);
    }
}