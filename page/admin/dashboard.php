<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: adminlogin.php');
    exit;
}
require_once '../includes/config.php';
require_once '../includes/db.php';

// Fetch some stats for dashboard (example: total orders, total customers, total products)
try {
    $totalOrders = $db->query("SELECT COUNT(*) FROM orders")->fetchColumn();
    $totalCustomers = $db->query("SELECT COUNT(*) FROM users")->fetchColumn();
    $totalProducts = $db->query("SELECT COUNT(*) FROM products")->fetchColumn();
} catch (PDOException $e) {
    $totalOrders = $totalCustomers = $totalProducts = 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
    <style>
        /* Reset and base */
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: #f0f2f5;
            color: #333;
        }
        a {
            text-decoration: none;
            color: inherit;
        }
        /* Header */
        header {
            background-color: #003366;
            color: #fff;
            padding: 20px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }
        header h1 {
            font-weight: 600;
            font-size: 1.8rem;
            margin: 0;
        }
        .logout-button {
            background-color: #d52b1e;
            border: none;
            color: white;
            padding: 10px 20px;
            font-weight: 600;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .logout-button:hover {
            background-color: #a82014;
        }
        /* Navigation */
        nav {
            background-color: #002244;
            display: flex;
            gap: 20px;
            padding: 15px 40px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        nav a {
            color: #fff;
            font-weight: 600;
            padding: 10px 15px;
            border-radius: 6px;
            transition: background-color 0.3s ease;
        }
        nav a:hover,
        nav a.active {
            background-color: #004080;
        }
        /* Main content */
        main {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }
        main h2 {
            font-weight: 600;
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: #003366;
        }
        .welcome {
            font-size: 1.2rem;
            margin-bottom: 40px;
            color: #555;
        }
        /* Stats cards */
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 30px;
            margin-bottom: 50px;
        }
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.15);
        }
        .stat-card h3 {
            font-size: 2.5rem;
            margin: 0 0 10px;
            color: #d52b1e;
            font-weight: 700;
        }
        .stat-card p {
            font-size: 1rem;
            color: #666;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        /* Overview section */
        section.overview {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            color: #444;
            line-height: 1.6;
            font-size: 1rem;
        }
        /* Footer */
        footer {
            text-align: center;
            padding: 20px 0;
            color: #777;
            font-size: 0.9rem;
            margin-top: 80px;
        }
        /* Responsive */
        @media (max-width: 600px) {
            header, nav {
                padding: 15px 20px;
            }
            main {
                margin: 20px auto;
            }
            .stat-card h3 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <form method="POST" action="logout.php" style="margin:0;">
            <button type="submit" class="logout-button">Logout</button>
        </form>
    </header>
    <nav>
        <a href="dashboard.php" class="active">Dashboard</a>
        <a href="orders.php">Pasūtijumi</a>
        <a href="customers.php">Klienti</a>
        <a href="admins.php">All Admins</a>
        <a href="categories.php">Kategorijas</a>
        <a href="products.php">Produkti</a>
    </nav>
    <main>
        <div class="welcome">Welcome, <?php echo htmlspecialchars($_SESSION['admin_username']); ?>!</div>
        <div class="stats">
            <div class="stat-card">
                <h3><?php echo $totalOrders; ?></h3>
                <p>Total Orders</p>
            </div>
            <div class="stat-card">
                <h3><?php echo $totalCustomers; ?></h3>
                <p>Total Customers</p>
            </div>
            <div class="stat-card">
                <h3><?php echo $totalProducts; ?></h3>
                <p>Total Products</p>
            </div>
        </div>
        <section class="overview">
            <h2>Dashboard Overview</h2>
            <p>This dashboard provides a quick overview of your store's performance. Use the navigation links above to manage orders, customers, and admins.</p>
        </section>
    </main>
    <footer>
        &copy; <?php echo date('Y'); ?> Yamaha Rox. All rights reserved.
    </footer>
</body>
</html>
