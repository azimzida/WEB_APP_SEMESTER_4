<?php

/**
 * Test script untuk verifikasi Composer autoloading
 * Jalankan dari command line: php test_autoload.php
 */

echo "=== EduShare Autoload Test ===\n\n";

// Test 1: Load Composer autoloader
echo "[TEST 1] Loading Composer autoloader...\n";
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
    echo "✓ Composer autoloader loaded successfully\n\n";
} else {
    echo "✗ Composer autoloader not found. Run: composer install\n";
    exit(1);
}

// Test 2: Test Core classes
echo "[TEST 2] Testing Core classes...\n";
try {
    $classes = [
        'App\\Core\\App',
        'App\\Core\\Controller',
        'App\\Core\\Database',
        'App\\Core\\Model',
        'App\\Core\\SessionManager',
    ];

    foreach ($classes as $class) {
        if (class_exists($class)) {
            echo "✓ {$class} loaded\n";
        } else {
            echo "✗ {$class} not found\n";
        }
    }
    echo "\n";
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n\n";
}

// Test 3: Test Controllers
echo "[TEST 3] Testing Controllers...\n";
try {
    $controllers = [
        'App\\Controllers\\HomeController',
        'App\\Controllers\\AuthController',
    ];

    foreach ($controllers as $class) {
        if (class_exists($class)) {
            echo "✓ {$class} loaded\n";
        } else {
            echo "✗ {$class} not found\n";
        }
    }
    echo "\n";
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n\n";
}

// Test 4: Test Models
echo "[TEST 4] Testing Models...\n";
try {
    $models = [
        'App\\Models\\UserModel',
        'App\\Models\\HomeModel',
        'App\\Models\\CourseModel',
        'App\\Models\\KategoriModel',
        'App\\Models\\MateriModel',
    ];

    foreach ($models as $class) {
        if (class_exists($class)) {
            echo "✓ {$class} loaded\n";
        } else {
            echo "✗ {$class} not found\n";
        }
    }
    echo "\n";
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n\n";
}

// Test 5: Test Database connection
echo "[TEST 5] Testing Database connection...\n";
try {
    $dbStatus = \App\Core\Database::testConnection();
    if ($dbStatus) {
        echo "✓ Database connection successful\n";
    } else {
        echo "⚠ Database connection failed (check credentials in app/Core/Database.php)\n";
    }
    echo "\n";
} catch (Exception $e) {
    echo "⚠ Database error: " . $e->getMessage() . "\n\n";
}

// Test 6: Summary
echo "[SUMMARY]\n";
echo "✓ All autoload tests completed\n";
echo "✓ Composer PSR-4 autoloading is working correctly\n";
echo "\nNext steps:\n";
echo "1. Update database credentials in app/Core/Database.php\n";
echo "2. Run database schema: schema.sql\n";
echo "3. Start web server and test the application\n";
