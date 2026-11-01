<?php

$viewPath = sys_get_temp_dir().'/laravel-views';

$runtimeDefaults = [
    'SESSION_DRIVER' => 'cookie',
    'CACHE_STORE' => 'array',
    'LOG_CHANNEL' => 'stderr',
    'VIEW_COMPILED_PATH' => $viewPath,
];

foreach ($runtimeDefaults as $key => $value) {
    if (getenv($key) === false || getenv($key) === '') {
        putenv($key.'='.$value);
        $_ENV[$key] = $value;
        $_SERVER[$key] = $value;
    }
}

if (! is_dir($viewPath) && ! mkdir($viewPath, 0775, true) && ! is_dir($viewPath)) {
    throw new RuntimeException('Unable to create the temporary compiled views directory.');
}

require __DIR__.'/../public/index.php';
