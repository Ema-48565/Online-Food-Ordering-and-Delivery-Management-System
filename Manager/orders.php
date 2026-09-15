<?php
require_once "db.php";

/* Change order status */
if (isset($_POST['change_status'])) {
    $id = (int)$_POST['id'];
    $status = $_POST['status'];

    $allowed = ['Pending', 'Preparing', 'Ready', 'Completed'];
    if (in_array($status, $allowed, true)) {
        $stmt = $conn->prepare("UPDATE orders SET status=? WHERE id=?");
        $stmt->bind_param("si", $status, $id);
        $stmt->execute();
        $stmt->close();
    }
    header("Location: orders.php");
    exit;
}

$filter = $_GET['status'] ?? 'All';
$allowed = ['All', 'Pending', 'Preparing', 'Ready', 'Completed'];

if (!in_array($filter, $allowed, true)) {
    $filter = 'All';
}

if ($filter === 'All') {
    $orders = $conn->query("SELECT * FROM orders ORDER BY id DESC");
} else {
    $stmt = $conn->prepare("SELECT * FROM orders WHERE status=? ORDER BY id DESC");
    $stmt->bind_param("s", $filter);
    $stmt->execute();
    $orders = $stmt->get_result();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="layout">
    <aside class="sidebar">
        <div class="logo">LOGO</div>
        <nav>
            <a href="dashboard.php">⌂ <span>Dashboard</span></a>
            <a href="food.php">▣ <span>Manage Food</span></a>
            <a class="active" href="orders.php">▤ <span>Orders</span></a>
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

            <div class="tabs">
                <?php foreach ($allowed as $status): ?>
                    <a class="<?= $filter === $status ? 'selected' : '' ?>" href="orders.php?status=<?= urlencode($status) ?>">
                        <?= htmlspecialchars($status) ?>
                    </a>
                <?php endforeach; ?>
            </div>

            <div class="panel">
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
                        <?php if ($orders && $orders->num_rows > 0): ?>
                            <?php while ($order = $orders->fetch_assoc()): ?>
                            <tr>
                                <td>#<?= htmlspecialchars($order['order_code']) ?></td>
                                <td><?= htmlspecialchars($order['customer']) ?></td>
                                <td><?= (int)$order['items_count'] ?> item<?= $order['items_count'] == 1 ? '' : 's' ?></td>
                                <td>$<?= number_format($order['amount'], 2) ?></td>
                                <td>
                                    <span class="badge <?= strtolower($order['status']) ?>">
                                        <?= htmlspecialchars($order['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <form method="POST" class="status-form">
                                        <input type="hidden" name="id" value="<?= $order['id'] ?>">
                                        <select name="status">
                                            <?php foreach (['Pending','Preparing','Ready','Completed'] as $s): ?>
                                                <option <?= $order['status']===$s?'selected':'' ?>><?= $s ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <button class="action view" name="change_status">Update</button>
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