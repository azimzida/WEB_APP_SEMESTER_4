<?php

session_start();

define('APP_NAME', 'Edu Share');
define('APP_VERSION', '1.0');

// Load Composer autoloader
$autoloadPath = dirname(__DIR__) . '/vendor/autoload.php';
if (file_exists($autoloadPath)) {
    require_once $autoloadPath;
} else {
    // Fallback to manual autoloading if composer hasn't been installed yet
    spl_autoload_register(function ($class) {
        $prefix = 'App\\';
        if (strpos($class, $prefix) !== 0) {
            return;
        }

        $relative_class = substr($class, strlen($prefix));
        $base_dir = __DIR__ . '/';
        $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

        if (file_exists($file)) {
            require_once $file;
        }
    });
}

// Start the application
new \App\Core\App();
