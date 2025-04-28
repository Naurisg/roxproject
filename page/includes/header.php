<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Oswald:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="top-bar-left">
                <span><i class="fas fa-phone-alt"></i> +1 (555) 123-4567</span>
                <span><i class="fas fa-envelope"></i> yamaha.rox.crew@gmail.com</span>
            </div>
            <div class="top-bar-right">
                <span>Free shipping on orders over $99</span>
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <a href="login.php" class="btn">Login</a>
                <?php else: ?>
                    <span>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                    <a href="logout.php" class="btn">Logout</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Header -->
    <header class="main-header">
        <div class="container">
            <div class="logo">
                <h1>YAMAHA ROX</h1>
                <p>Premium Parts & Accessories</p>
            </div>
            
            <div class="search-cart">
                <div class="search-box">
                    <input type="text" placeholder="Search for merch...">
                    <button><i class="fas fa-search"></i></button>
                </div>
                <div class="cart">
                    <a href="cart.php">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="cart-count"><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?></span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Navigation -->
    <nav class="main-nav">
        <div class="container">
            <ul>
                <?php
                $current_page = basename($_SERVER['PHP_SELF']);
                ?>
                <li><a href="index.php" <?php if ($current_page == 'index.php') echo 'class="active"'; ?>>Home</a></li>
                <li><a href="product.php" <?php if ($current_page == 'product.php' || $current_page == 'products.php') echo 'class="active"'; ?>>Parts</a></li>
                <li><a href="usedparts.php" <?php if ($current_page == 'usedparts.php') echo 'class="active"'; ?>>Used Parts</a></li>
                <li><a href="merch.php" <?php if ($current_page == 'merch.php') echo 'class="active"'; ?>>Merch</a></li>
                <li><a href="decals.php" <?php if ($current_page == 'decals.php') echo 'class="active"'; ?>>Decals</a></li>
                <li><a href="3dparts.php" <?php if ($current_page == '3dparts.php') echo 'class="active"'; ?>>3D Parts</a></li>
                <li><a href="about.php" <?php if ($current_page == 'about.php') echo 'class="active"'; ?>>About Us</a></li>
                <li><a href="contact.php" <?php if ($current_page == 'contact.php') echo 'class="active"'; ?>>Contact</a></li>
            </ul>
        </div>
    </nav>
