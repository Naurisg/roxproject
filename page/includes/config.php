<?php
// SQLite Database configuration
define('DB_FOLDER', __DIR__ . '/../Database');
define('DB_PATH', DB_FOLDER . '/database.db');

// Site configuration
define('SITE_NAME', 'Yamaha Rox');
define('SITE_URL', 'http://localhost/yamaha-rox');

// Stripe configuration
define('STRIPE_PUBLISHABLE_KEY', 'pk_test_your_key_here');
define('STRIPE_SECRET_KEY', 'sk_test_your_key_here');

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ensure the Database folder exists
if (!is_dir(DB_FOLDER)) {
    mkdir(DB_FOLDER, 0777, true);
}

// Connect to SQLite database
try {
    $db = new PDO('sqlite:' . DB_PATH);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>