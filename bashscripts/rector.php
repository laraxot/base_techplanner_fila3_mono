<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\TypeDeclaration\Rector\ClassMethod\AddVoidReturnTypeWhereNoReturnRector;

return RectorConfig::configure()
    ->withPaths([
        __DIR__.'/',
    ])
    ->withSkip([
        __DIR__.'/vendor',
    ])
    // uncomment to reach your current PHP version
    ->withPhpSets()
    ->withRules([
        // AddVoidReturnTypeWhereNoReturnRector::class,
    ]);
