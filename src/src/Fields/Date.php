<?php

namespace edwardyi\Press\Fields;

use Carbon\Carbon;

class Date extends FieldContract
{
    /**
     * @var string $type
     * @var string $value
     * @var array $data
     * 
     * @return array
     */
    public static function process($type, $value, $data)
    {
        return [
            $type => Carbon::parse($value),
            'parsed_at' => Carbon::now()
        ];
    }
}