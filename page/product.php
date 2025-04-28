<?php
// Start session for cart functionality
session_start();

// Include configuration for database path
require_once 'includes/config.php'; // Ensure config.php is included for DB_PATH

// Database connection (SQLite for this example)
try {
    $db = new PDO('sqlite:' . DB_PATH); // Use DB_PATH for database connection
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>

<?php include 'includes/header.php'; ?>

<!-- Featured Categories -->
<section class="featured-categories">
    <div class="container">
        <h2 class="section-title">Shop by Category</h2>
        <div class="category-grid">
            <a href="parts/cylinders.php" class="category-card">
                <div class="category-image">
                    <img src="images/categories/cylinders.webp" alt="Cylinders" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h3>Cylinders</h3>
            </a>
            <a href="products.php?category=crankshafts" class="category-card">
                <div class="category-image">
                    <img src="images/categories/crankshaft.jpg" alt="Crankshafts" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h3>Crankshafts</h3>
            </a>
            <a href="products.php?category=exhausts" class="category-card">
                <div class="category-image">
                    <img src="images/categories/exhaust.jpg" alt="Exhausts" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h3>Exhausts</h3>
            </a>
            <a href="parts/carburetor_and_intake.php" class="category-card">
                <div class="category-image">
                    <img src="images/categories/carburetor.webp" alt="Carburetors" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h3>Carburetor and Intake</h3>
            </a>
            <a href="parts/variator.php" class="category-card">
                <div class="category-image">
                    <img src="images/categories/variator.webp" alt="Variators" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h3>Variators</h3>
            </a>
            <a href="parts/clutch.php" class="category-card">
                <div class="category-image">
                    <img src="images/categories/clutch.jpg" alt="Clutch" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h3>Clutch</h3>
            </a>
            <a href="parts/transmission.php" class="category-card">
                <div class="category-image">
                    <img src="images/categories/transmission.webp" alt="Transmission" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h3>Transmission</h3>
            </a>
            <a href="parts/ignition.php" class="category-card">
                <div class="category-image">
                    <img src="images/categories/ignition.jpg" alt="Ignition" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h3>Ignition</h3>
            </a>
            <a href="parts/electrical.php" class="category-card">
                <div class="category-image">
                    <img src="images/categories/electrical.webp" alt="Electrical" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h3>Electrical</h3>
            </a>
            <a href="parts/lighting.php" class="category-card">
                <div class="category-image">
                    <img src="images/categories/rearlight.jpg" alt="Lighting" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h3>Lighting</h3>
            </a>
            <a href="parts/brake.php" class="category-card">
                <div class="category-image">
                    <img src="images/categories/brake.jpg" alt="Brake" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h3>Brake</h3>
            </a>
            <a href="products.php?category=plastics" class="category-card">
                <div class="category-image">
                    <img src="images/categories/plastics.webp" alt="Plastics" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h3>Plastics</h3>
            </a>
            <a href="parts/tuningkits.php" class="category-card">
                <div class="category-image">
                    <img src="images/categories/tuningkit.webp" alt="Tuning Kits" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h3>Tuning Kits</h3>
            </a>
            <a href="parts/chassis.php" class="category-card">
                <div class="category-image">
                    <img src="images/categories/suspension.webp" alt="Chassis" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h3>Chassis</h3>
            </a>
            <a href="parts/customizing.php" class="category-card">
                <div class="category-image">
                    <img src="images/categories/tuning.webp" alt="Customizing" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h3>Customizing</h3>
            </a>
            <a href="parts/wheels.php" class="category-card">
                <div class="category-image">
                    <img src="images/categories/tires.webp" alt="Wheels" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h3>Wheels</h3>
            </a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
