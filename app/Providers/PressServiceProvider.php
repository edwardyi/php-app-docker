<?php

namespace App\Providers;

use App\Fields\Random;
use App\Fields\Title;
use edwardyi\Press\Facades\Press;
use Illuminate\Support\ServiceProvider;

class PressServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Press::fields($this->registerFields());
    }

    public function register()
    {

    }

    protected function registerFields()
    {
        return [
            Title::class,
            Random::class
        ];
    }
}