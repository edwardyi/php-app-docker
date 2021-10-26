<?php

namespace edwardyi\Press\Fields;

use Carbon\Carbon;

class Date
{
    /**
     * @var string $type
     * @var string $value
     * 
     * @return array
     */
    public static function process($type, $value)
    {
        return [
            $type => Carbon::parse($value)
        ];
    }
}