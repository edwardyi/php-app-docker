<?php

namespace App\Fields;

use edwardyi\Press\Fields\FieldContract;

class Random extends FieldContract
{
    public static function process($fieldType, $fieldValue, $data)
    {
        return [
            'it works' => ' cool'
        ];
    }
}