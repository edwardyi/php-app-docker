<?php

namespace edwardyi\Press\Tests;

use edwardyi\Press\MarkdownParser;
use Orchestra\Testbench\TestCase;

class MarkdownTest extends TestCase
{
    /** @test */
    public function the_head_and_body_gets_split()
    {
        $data = MarkdownParser::parse('# testing');
        $this->assertEquals('<h1>testing</h1>', $data);
    }
}