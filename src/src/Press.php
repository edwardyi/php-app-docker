<?php

namespace edwardyi\Press;

use Illuminate\Support\Str;

class Press
{
    protected $fields = [];

    /**
     * fields that set by service provider
     */
    public function fields($fields)
    {
        $this->fields = array_merge($this->fields, $fields);
    }

    /**
     * fields that are available by parser
     */
    public function availableFields()
    {
        return $this->fields;
    }

    public function configNotPublished()
    {
        return is_null(config('press'));
    }

    public function driver()
    {
        $driver = Str::title(config('press.driver'));
        $class = 'edwardyi\\Press\\Drivers\\'.$driver.'Driver';

        return new $class;
    }

    public function path()
    {
        return config('press.path', 'blogs');
    }
}