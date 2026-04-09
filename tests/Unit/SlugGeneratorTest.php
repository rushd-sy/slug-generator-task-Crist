<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class SlugGeneratorTest extends TestCase
{
    /** @test */
    public function it_generates_a_valid_slug_from_title()
    {
        $title = 'What is a "slug" in Laravel?';
        $expected = 'what-is-a-slug-in-laravel';

        $this->assertEquals($expected, generate_slug($title));
    }

    /** @test */
    public function it_handles_numbers_and_special_characters()
    {
        $this->assertEquals('hello-world-123', generate_slug('Hello World 123!'));
        $this->assertEquals('cafe', generate_slug('Café'));
    }
}
