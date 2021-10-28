<?php

namespace App\Fields;

use edwardyi\Press\Fields\FieldContract;

class Title extends FieldContract
{
    public static function process($fieldType, $fieldValue, $data)
    {
        return [
            'title' => ' it works'
        ];
    }
}