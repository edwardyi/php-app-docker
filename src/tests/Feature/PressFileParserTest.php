<?php

namespace edwardyi\Press\Tests;

use edwardyi\Press\MarkdownParser;
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

    /** @test */
    public function each_head_field_gets_seperated()
    {
        $pressFileParser = new PressFileParser(__DIR__.'/../blogs/Markdown.md');

        $data = $pressFileParser->getData();

        // title: My tile
        $this->assertEquals('My title', $data['title']);

        // description: Description here
        $this->assertEquals('Description here', $data['description']);
    }

    /** @test */
    public function the_body_gets_saved_and_trimmed()
    {
        $pressFileParser = new PressFileParser(__DIR__.'/../blogs/Markdown.md');

        $data = $pressFileParser->getData();

        $this->assertEquals("# Heading\n\nBlog post body here", $data['body']);
    }
}