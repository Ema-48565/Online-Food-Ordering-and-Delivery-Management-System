<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Orders</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
<div class="layout">
    <aside class="sidebar">
        <div class="logo">LOGO</div>
        <nav>
            <a href="DashboardController.php">⌂ <span>Dashboard</span></a>
            <a href="FoodController.php">▣ <span>Manage Food</span></a>
            <a class="active" href="OrderController.php">▤ <span>Orders</span></a>
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
            <h1>3. Manage Orders</h1>

            <div class="panel">
                <div class="panel-title" style="margin-bottom: 15px;">
                    <div style="display: flex; gap: 10px;">
                        <a href="OrderController.php?status=All">All</a>
                        <a href="OrderController.php?status=Pending">Pending</a>
                        <a href="OrderController.php?status=Preparing">Preparing</a>
                        <a href="OrderController.php?status=Ready">Ready</a>
                        <a href="OrderController.php?status=Completed">Completed</a>
                    </div>
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
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (isset($orders) && $orders && $orders->num_rows > 0): ?>
                            <?php while ($row = $orders->fetch_assoc()): 
                                $orderId = isset($row['order_code']) ? $row['order_code'] : (isset($row['id']) ? $row['id'] : '100');
                                $customer = isset($row['customer']) ? $row['customer'] : (isset($row['name']) ? $row['name'] : 'Customer');
                                $items = isset($row['items_count']) ? $row['items_count'] : 1;
                                $amount = isset($row['amount']) ? $row['amount'] : 0;
                                $status = isset($row['status']) ? $row['status'] : 'Pending';
                                $currentId = isset($row['id']) ? $row['id'] : 0;
                            ?>
                            <tr>
                                <td>#<?= htmlspecialchars($orderId) ?></td>
                                <td><?= htmlspecialchars($customer) ?></td>
                                <td><?= (int)$items ?> item</td>
                                <td>$<?= number_format($amount, 2) ?></td>
                                <td><span class="badge <?= strtolower($status) ?>"><?= htmlspecialchars($status) ?></span></td>
                                <td>
                                    <form action="OrderController.php?action=update" method="POST" style="display: flex; gap: 5px;">
                                        <input type="hidden" name="order_id" value="<?= $currentId ?>">
                                        <select name="status" style="padding: 3px;">
                                            <option value="Pending" <?= $status == 'Pending' ? 'selected' : '' ?>>Pending</option>
                                            <option value="Preparing" <?= $status == 'Preparing' ? 'selected' : '' ?>>Preparing</option>
                                            <option value="Ready" <?= $status == 'Ready' ? 'selected' : '' ?>>Ready</option>
                                            <option value="Completed" <?= $status == 'Completed' ? 'selected' : '' ?>>Completed</option>
                                        </select>
                                        <button type="submit" class="btn-primary" style="padding: 3px 8px; font-size: 12px;">Update</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="6" class="empty">No orders found.</td></tr>
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