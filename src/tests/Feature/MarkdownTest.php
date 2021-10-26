<?php

namespace edwardyi\Press\Tests;

use edwardyi\Press\MarkdownParser;

class MarkdownTest extends TestCase
{
    /** @test */
    public function experiment()
    {
        $data = MarkdownParser::parse('# testing');
        $this->assertEquals('<h1>testing</h1>', $data);
    }
}