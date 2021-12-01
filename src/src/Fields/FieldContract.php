<?php

namespace edwardyi\Press\Fields;

abstract class FieldContract
{
    /**
     * @var string $fieldType
     * @var string $fieldValue
     * @var array $data
     * 
     * @return array
     */
    public static function process($fieldType, $fieldValue, $data)
    {
        return [$fieldType => $fieldValue];
    }
}