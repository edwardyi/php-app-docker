<?php

namespace edwardyi\Press;

use Illuminate\Support\Str;

class Press
{
    public static function configNotPublished()
    {
        return is_null(config('press'));
    }

    public static function driver()
    {
        $driver = Str::title(config('press.driver'));
        $class = 'edwardyi\\Press\\Drivers\\'.$driver;

        return new $class;
    }
}