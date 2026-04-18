<?php

uses(Tests\TestCase::class)->in(__DIR__);

test('generates valid slug', function () {
    expect(generate_slug('What is a "slug" in Laravel?'))->toBe('what-is-a-slug-in-laravel');
});

test('handles special chars', function () {
    expect(generate_slug('Hello World 123!'))->toBe('hello-world-123');
});

test('handles special characters and emojis smoothly', function () {

    expect(generate_slug('👽 Hello @ World 🔥!'))->toBe('hello-world');
});


