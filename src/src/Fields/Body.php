<?php

namespace edwardyi\Press\Fields;

use edwardyi\Press\MarkdownParser;

class Body extends FieldContract
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
            $type => MarkdownParser::parse($value)
        ];
    }
}