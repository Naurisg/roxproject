<?php
session_start();
require_once 'includes/config.php'; // Ensure config.php is included for DB_PATH

try {
    $db = new PDO('sqlite:' . DB_PATH);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>

<?php include 'includes/header.php'; ?>

<!-- Featured Merch Categories -->
<section class="featured-categories">
    <div class="container">
        <h2 class="section-title">Shop Merch by Category</h2>
        <div class="category-grid">
            <a href="merch/hoodies.php" class="category-card">
                <div class="category-image">
                    <img src="images/categories/merch_placeholder.jpg" alt="Hoodies" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h3>Hoodies</h3>
            </a>
            <a href="merch/tshirts.php" class="category-card">
                <div class="category-image">
                    <img src="images/categories/merch_placeholder.jpg" alt="T-Shirts" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h3>T-Shirts</h3>
            </a>
            <a href="merch/caps.php" class="category-card">
                <div class="category-image">
                    <img src="images/categories/merch_placeholder.jpg" alt="Caps" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h3>Caps</h3>
            </a>
            <a href="merch/keychains.php" class="category-card">
                <div class="category-image">
                    <img src="images/categories/merch_placeholder.jpg" alt="Keychains" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h3>Keychains</h3>
            </a>
            <a href="merch/mugs.php" class="category-card">
                <div class="category-image">
                    <img src="images/categories/merch_placeholder.jpg" alt="Mugs" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h3>Mugs</h3>
            </a>
            <a href="merch/stickers.php" class="category-card">
                <div class="category-image">
                    <img src="images/categories/merch_placeholder.jpg" alt="Stickers" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h3>Stickers</h3>
            </a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
