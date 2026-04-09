# Task 1 - Slug Generator

## Description
This project implements a Laravel helper function that converts a given title into a URL-friendly slug.

## Rules Followed
- Converts to lowercase
- Replaces spaces/punctuation with hyphens
- Removes special & non-ASCII characters
- Returns JSON response via `SlugController`

## Usage
GET /generate-slug?title=Your%20Article%20Title

## Testing
Run `php artisan test` to execute unit tests for the slug generation logic.
