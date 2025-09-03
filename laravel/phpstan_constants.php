<?php

declare(strict_types=1);

//https://phpstan.org/user-guide/discovering-symbols

define('LARAVEL_DIR', __DIR__);

// Include JpGraph constants if exists
if (file_exists(__DIR__ . '/vendor/amenadiel/jpgraph/src/config.inc.php')) {
    require_once __DIR__ . '/vendor/amenadiel/jpgraph/src/config.inc.php';
}
