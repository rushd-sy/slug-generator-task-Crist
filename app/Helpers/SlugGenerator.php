<?php

// use Illuminate\Support\Str;

if (!function_exists('generate_slug')) {
    function generate_slug(string $title, string $separator = '-'): string
    {
        // regex solution //

        // UTF‑8 to ASCII
        // (e.g., “déjà vu” → “deja vu”)
        $text = iconv('UTF-8', 'ASCII//TRANSLIT', $title);

        // Replace non‑letters/digits with separator
        // (e.g., “deja vu! and 123” → “deja-vu!-and-123”)
        $text = preg_replace('~[^\\pL\\pN]+~u', $separator, $text);

        // Remove anything that’s not a word char or separator
        // (e.g., “id:-123” → “id-123”)
        $text = preg_replace('~[^-\\w]+~', '', $text);

        // Trim separators from both sides
        // (e.g., “-deja-vu-” → “deja-vu”)
        $text = trim($text, $separator);

        // Collapse multiple separators into one
        // (e.g., “deja----vu” → “deja-vu”)
        $text = preg_replace('~-+~', $separator, $text);

        // Lowercase
        // (e.g., “Deja Vu” → “deja-vu”)
        $text = strtolower($text);

        // Fallback if empty
        return $text ?: 'n-a';
    }

    //return Str::slug($title, $separator);
}


// for loop solution //
/*
if (!function_exists('generate_slug')) {
    function generate_slug(string $title, string $separator = '-'): string
    {
        $text = iconv('UTF-8', 'ASCII//TRANSLIT', $title);
        $len = strlen($text);
        $result = '';
        $prev = null;

        for ($i = 0; $i < $len; $i++) {
            $char = $text[$i];

            // decide if current char is “allowed” in the slug
            if (
                ctype_alpha($char) || // letter
                ctype_digit($char) || // digit
                $char === '-'  // separator
            ) {
                // adding a letter/digit, just append
                $result .= $char;
                $prev = $char;
            } else {
                // treat as potential separator
                // only add separator if last char wasn’t already one
                if ($prev !== $separator) {
                    $result .= $separator;
                    $prev = $separator;
                }
            }
        }

        $result = trim($result, $separator);

        $result = strtolower($result);

        return $result ?: 'n-a';
    }
}
*/
