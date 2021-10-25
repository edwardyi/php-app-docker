<?php

namespace edwardyi\Press;

use Parsedown;

class MarkdownParser
{

    public static function parse($str)
    {
        // $parseDown = new Parsedown();
        // return $parseDown->text($str);
        return Parsedown::instance()->text($str);
    }
}