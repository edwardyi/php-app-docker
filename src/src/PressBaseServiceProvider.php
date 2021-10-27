<?php

namespace edwardyi\Press;

use edwardyi\Press\Console\ProcessCommand;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

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

        $this->registerRoutes();
    }

    protected function registerPublishing()
    {
        $this->publishes([
            __DIR__.'/../config/press.php' => config_path('press.php')
        ], 'press-config');
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
}