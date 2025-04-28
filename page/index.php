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

// Get featured products from database
$featured_products = [];
try {
    $stmt = $db->query("SELECT * FROM products WHERE featured = 1 LIMIT 4");
    $featured_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    // Handle error or leave featured products empty
}
?>

<?php include 'includes/header.php'; ?>

<!-- Hero Banner -->
<section class="hero" style="position: relative; overflow: hidden;">
    <img src="images/wallpaper.jpg" alt="Hero Banner" style="width: 100%; height: 100%; display: block; object-fit: cover;">
    <div class="hero-content" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white; text-align: center; text-shadow: 0 0 10px rgba(0,0,0,0.7);">
        <h2>Premium Yamaha Scooter Parts</h2>
        <p>High-performance components for your Aerox and other Yamaha models</p>
        <a href="product.php" class="btn">Shop Now</a>
    </div>
</section>

<!-- Featured Categories -->
<section class="featured-categories">
    <div class="container">
        <h2 class="section-title">Shop by Category</h2>
        <div class="category-grid">
            <a href="products.php?category=aerox" class="category-card">
                <div class="category-image" style="background-image: url('images/aerox-category.jpg');"></div>
                <h3>Aerox Parts</h3>
            </a>
            <a href="products.php?category=helmets" class="category-card">
                <div class="category-image" style="background-image: url('images/helmets-category.jpg');"></div>
                <h3>Helmets</h3>
            </a>
            <a href="products.php?category=goggles" class="category-card">
                <div class="category-image" style="background-image: url('images/goggles-category.jpg');"></div>
                <h3>Goggles</h3>
            </a>
            <a href="products.php?category=merch" class="category-card">
                <div class="category-image" style="background-image: url('images/merch-category.jpg');"></div>
                <h3>Merchandise</h3>
            </a>
        </div>
    </div>
</section>

<!-- Featured Products -->
<section class="featured-products">
    <div class="container">
        <h2 class="section-title">Featured Products</h2>
        <div class="product-grid">
            <?php if (!empty($featured_products)): ?>
                <?php foreach ($featured_products as $product): ?>
                    <div class="product-card">
                        <div class="product-badge">Hot</div>
                        <div class="product-image" style="background-image: url('<?php echo htmlspecialchars($product['image_url']); ?>');">
                            <div class="product-actions">
                                <button class="quick-view" data-id="<?php echo $product['id']; ?>"><i class="fas fa-eye"></i></button>
                                <button class="add-wishlist" data-id="<?php echo $product['id']; ?>"><i class="far fa-heart"></i></button>
                            </div>
                        </div>
                        <div class="product-info">
                            <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                            <div class="product-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span>(24)</span>
                            </div>
                            <div class="product-price">
                                $<?php echo number_format($product['price'], 2); ?>
                                <?php if ($product['original_price'] > $product['price']): ?>
                                    <span class="original-price">$<?php echo number_format($product['original_price'], 2); ?></span>
                                <?php endif; ?>
                            </div>
                            <button class="add-to-cart" data-id="<?php echo $product['id']; ?>">Add to Cart</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-products">No featured products found. Check back soon!</p>
            <?php endif; ?>
        </div>
        <div class="view-all">
            <a href="products.php" class="btn">View All Products</a>
        </div>
    </div>
</section>

<!-- Promo Banner -->
<section class="promo-banner">
    <div class="container">
        <div class="promo-content">
            <h3>Limited Time Offer</h3>
            <h2>20% OFF All Aerox Performance Parts</h2>
            <p>Use code: AEROX20 at checkout</p>
            <a href="products.php?category=aerox" class="btn">Shop Now</a>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="why-choose-us">
    <div class="container">
        <h2 class="section-title">Why Choose Yamaha Rox</h2>
        <div class="features-grid">
            <div class="feature">
                <i class="fas fa-shield-alt"></i>
                <h3>Quality Guarantee</h3>
                <p>All our parts are OEM or premium aftermarket with warranty</p>
            </div>
            <div class="feature">
                <i class="fas fa-truck"></i>
                <h3>Fast Shipping</h3>
                <p>Orders shipped within 24 hours with tracking</p>
            </div>
            <div class="feature">
                <i class="fas fa-headset"></i>
                <h3>Expert Support</h3>
                <p>Our team knows Yamaha scooters inside out</p>
            </div>
            <div class="feature">
                <i class="fas fa-undo"></i>
                <h3>Easy Returns</h3>
                <p>30-day return policy on unused items</p>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter -->
<section class="newsletter">
    <div class="container">
        <div class="newsletter-content">
            <h2>Stay Updated</h2>
            <p>Subscribe to our newsletter for exclusive deals and new arrivals</p>
            <form action="subscribe.php" method="POST">
                <input type="email" name="email" placeholder="Your email address" required>
                <button type="submit" class="btn">Subscribe</button>
            </form>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
