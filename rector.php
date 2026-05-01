<?php
// filepath: rector.php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Laravel\Set\LaravelSetList;
use Rector\Set\ValueObject\LevelSetList;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/app',
        __DIR__ . '/config',
        __DIR__ . '/database',
        __DIR__ . '/routes',
        __DIR__ . '/tests',
    ])
    ->withSkip([
        __DIR__ . '/vendor',
        __DIR__ . '/storage',
        __DIR__ . '/bootstrap/cache',
    ])
    // Pick the PHP level you want Rector to target (adjust as needed)
    ->withSets([
        LevelSetList::UP_TO_PHP_82,
        LaravelSetList::LARAVEL_100, // adjust to your Laravel version
    ]);
