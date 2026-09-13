<?php
require_once "db.php";

$totalOrders = 0;
$todayRevenue = 0;
$pendingOrders = 0;
$completedOrders = 0;

$result = $conn->query("SELECT COUNT(*) AS total FROM orders");
if ($result) $totalOrders = $result->fetch_assoc()['total'];

$result = $conn->query("SELECT COALESCE(SUM(amount),0) AS revenue FROM orders WHERE DATE(created_at) = CURDATE()");
if ($result) $todayRevenue = $result->fetch_assoc()['revenue'];

$result = $conn->query("SELECT COUNT(*) AS total FROM orders WHERE status = 'Pending'");
if ($result) $pendingOrders = $result->fetch_assoc()['total'];

$result = $conn->query("SELECT COUNT(*) AS total FROM orders WHERE status = 'Completed'");
if ($result) $completedOrders = $result->fetch_assoc()['total'];

$recent = $conn->query("SELECT * FROM orders ORDER BY id DESC LIMIT 10");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="layout">
    <aside class="sidebar">
        <div class="logo">LOGO</div>
        <nav>
            <a class="active" href="dashboard.php">⌂ <span>Dashboard</span></a>
            <a href="food.php">▣ <span>Manage Food</span></a>
            <a href="orders.php">▤ <span>Orders</span></a>
            <a href="#">♙ <span>Customers</span></a>
            <a href="#">♙ <span>Profile</span></a>
            <a href="#">↪ <span>Logout</span></a>
        </nav>
    </aside>

    <main class="main">
        <header class="topbar">
            <div class="top-logo">LOGO</div>
            <div class="manager">♙ &nbsp; Manager ▾</div>
        </header>

        <section class="content">
            <h1>1. Manager Dashboard</h1>

            <div class="stats">
                <div class="stat-card">
                    <div class="stat-icon">▣</div>
                    <div><small>Total Orders</small><strong><?= $totalOrders ?></strong></div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">$</div>
                    <div><small>Today's Revenue</small><strong>$<?= number_format($todayRevenue, 2) ?></strong></div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">◷</div>
                    <div><small>Pending Orders</small><strong><?= $pendingOrders ?></strong></div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">✓</div>
                    <div><small>Completed Orders</small><strong><?= $completedOrders ?></strong></div>
                </div>
            </div>

            <div class="panel">
                <div class="panel-title">
                    <h2>Recent Orders</h2>
                    <span class="grid-icon">▦</span>
                </div>
                <div class="table-wrap">
                    <table>
                        <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Items</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($recent && $recent->num_rows > 0): ?>
                            <?php while ($row = $recent->fetch_assoc()): ?>
                            <tr>
                                <td>#<?= htmlspecialchars($row['order_code']) ?></td>
                                <td><?= htmlspecialchars($row['customer']) ?></td>
                                <td><?= (int)$row['items_count'] ?> item<?= $row['items_count'] == 1 ? '' : 's' ?></td>
                                <td>$<?= number_format($row['amount'], 2) ?></td>
                                <td><span class="badge <?= strtolower($row['status']) ?>"><?= htmlspecialchars($row['status']) ?></span></td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="5" class="empty">No orders found.</td></tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
</div>
</body>
</html>