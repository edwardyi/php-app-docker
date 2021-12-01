<?php

namespace App\Providers;

use edwardyi\Press\Facades\Press;
use Illuminate\Support\ServiceProvider;

class PressServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerFields();
    }

    public function register()
    {

    }

    public function registerFields()
    {
        Press::fields();
    }
}