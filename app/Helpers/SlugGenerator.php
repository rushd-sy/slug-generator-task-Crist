<?php

use Illuminate\Support\Str;

if (!function_exists('generate_slug')) {
    function generate_slug(string $title): string
    {
        // Laravel's Str::slug follows all your rules (lowercase, hyphens, removes special chars, ASCII transliteration)
        return Str::slug($title);
    }
}
