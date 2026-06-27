<?php
/**
 * Server Setup Script
 * Upload this to your root directory and visit: https://itzrenzo.dev/setup.php
 * DELETE THIS FILE AFTER RUNNING!
 */

// Check if running from web
if (php_sapi_name() !== 'cli') {
    echo "<pre>";
}

echo "🚀 Starting server setup...\n\n";

// Load Laravel
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';

// Delete hot file if exists
$hotFile = __DIR__.'/public/hot';
if (file_exists($hotFile)) {
    unlink($hotFile);
    echo "✓ Deleted public/hot file\n";
} else {
    echo "✓ No public/hot file found\n";
}

// Check build files
echo "\n📦 Checking build files...\n";
$manifest = __DIR__.'/public/build/manifest.json';
if (file_exists($manifest)) {
    echo "✓ manifest.json exists\n";
    $data = json_decode(file_get_contents($manifest), true);
    foreach ($data as $key => $asset) {
        $file = __DIR__.'/public/build/'.$asset['file'];
        if (file_exists($file)) {
            echo "✓ " . $asset['file'] . " exists\n";
        } else {
            echo "✗ " . $asset['file'] . " MISSING!\n";
        }
    }
} else {
    echo "✗ manifest.json MISSING! Run 'npm run build' locally and upload public/build/ folder\n";
}

// Clear caches
echo "\n🧹 Clearing caches...\n";
try {
    Artisan::call('config:clear');
    echo "✓ Config cache cleared\n";
    
    Artisan::call('cache:clear');
    echo "✓ Application cache cleared\n";
    
    Artisan::call('route:clear');
    echo "✓ Route cache cleared\n";
    
    Artisan::call('view:clear');
    echo "✓ View cache cleared\n";
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
}

// Check permissions
echo "\n📁 Checking permissions...\n";
$writableDirs = ['storage', 'bootstrap/cache'];
foreach ($writableDirs as $dir) {
    $path = __DIR__.'/'.$dir;
    if (is_writable($path)) {
        echo "✓ $dir is writable\n";
    } else {
        echo "✗ $dir is NOT writable! Run: chmod -R 755 $dir\n";
    }
}

// Check database
echo "\n💾 Checking database...\n";
$dbFile = __DIR__.'/database/database.sqlite';
if (file_exists($dbFile)) {
    if (is_writable($dbFile)) {
        echo "✓ database.sqlite exists and is writable\n";
    } else {
        echo "✗ database.sqlite exists but is NOT writable! Run: chmod 664 database/database.sqlite\n";
    }
} else {
    echo "✗ database.sqlite MISSING! Create it and run migrations\n";
}

// Check .env
echo "\n⚙️ Checking .env configuration...\n";
if (file_exists(__DIR__.'/.env')) {
    echo "✓ .env file exists\n";
    echo "  - APP_ENV: " . env('APP_ENV') . "\n";
    echo "  - APP_DEBUG: " . (env('APP_DEBUG') ? 'true' : 'false') . "\n";
    echo "  - APP_URL: " . env('APP_URL') . "\n";
    echo "  - DB_CONNECTION: " . env('DB_CONNECTION') . "\n";
} else {
    echo "✗ .env file MISSING!\n";
}

echo "\n✅ Setup complete! Visit your site now.\n";
echo "\n⚠️  IMPORTANT: DELETE THIS FILE (setup.php) FOR SECURITY!\n";

if (php_sapi_name() !== 'cli') {
    echo "</pre>";
}
