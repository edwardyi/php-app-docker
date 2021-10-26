<?php

namespace edwardyi\Press\Fields;

use edwardyi\Press\MarkdownParser;

class Body
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
            $type => MarkdownParser::parse($value)
        ];
    }
}