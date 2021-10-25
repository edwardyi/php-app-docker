<?php

namespace edwardyi\Press\Tests;

use edwardyi\Press\PressFileParser;
use Orchestra\Testbench\TestCase;

class PressFileParserTest extends TestCase
{
    /** @test */
    public function the_head_and_body_gets_split()
    {
        $pressFileParser = new PressFileParser(__DIR__.'/../blogs/Markdown.md');

        $data = $pressFileParser->getData();

        $this->assertStringContainsString('title: My title', $data[1]);
        $this->assertStringContainsString('description: Description here', $data[1]);
        $this->assertStringContainsString(('Blog post body here'), $data[2]);
    }
}