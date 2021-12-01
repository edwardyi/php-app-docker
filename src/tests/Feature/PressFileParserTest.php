<?php

namespace edwardyi\Press\Tests;

use Carbon\Carbon;
use edwardyi\Press\PressFileParser;

class PressFileParserTest extends TestCase
{
    /** @test */
    public function the_head_and_body_gets_split()
    {
        $pressFileParser = new PressFileParser(__DIR__.'/../blogs/Markdown.md');

        $data = $pressFileParser->getRawData();

        $this->assertStringContainsString('title: My title', $data[1]);
        $this->assertStringContainsString('description: Description here', $data[1]);
        $this->assertStringContainsString(('Blog post body here'), $data[2]);
    }

    /** @test */
    public function a_string_can_also_be_used_instead()
    {
        $pressFileParser = new PressFileParser("---\ntitle: My title---\nBlog post body here");

        $data = $pressFileParser->getRawData();

        $this->assertStringContainsString('title: My title', $data[1]);
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

        $this->assertEquals("<h1>Heading</h1>\n<p>Blog post body here</p>", $data['body']);
    }

    /** @test */
    public function a_date_field_gets_parsed()
    {
        $pressFileParser = new PressFileParser("---\ndate: May 14, 1998---\n\n");

        $data = $pressFileParser->getData();

        $this->assertInstanceOf(Carbon::class, $data['date']);
        $this->assertEquals('05/14/1998', $data['date']->format('m/d/Y'));
    }

    /** @test */
    public function an_extra_fields_get_saved()
    {
        $pressFileParser = new PressFileParser("---\nauthor: Jone Doe---\n\n");

        $data = $pressFileParser->getData();

        $this->assertEquals(json_encode(['author' => 'Jone Doe']), $data['extra']);
    }

    /** @test */
    public function two_additional_fields_are_put_into_extra()
    {
        $pressFileParser = new PressFileParser("---\nauthor: Jone Doe\nimage: some\image.png---\n\n");

        $data = $pressFileParser->getData();

        $this->assertEquals(json_encode(['author' => 'Jone Doe', 'image' => 'some\image.png']), $data['extra']);
    }
}