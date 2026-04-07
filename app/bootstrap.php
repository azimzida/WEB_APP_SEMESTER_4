<?php

$config = require __DIR__ . '/config/config.php';

define('APP_NAME', $config['app_name']);
define('APP_VERSION', $config['version']);

spl_autoload_register(function ($class) {
    $paths = [
        __DIR__ . "/Core/$class.php",
        __DIR__ . "/Controllers/$class.php",
        __DIR__ . "/Models/$class.php",
    ];

    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});

new App();
