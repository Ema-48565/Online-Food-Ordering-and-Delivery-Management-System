<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Food Items</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
<div class="layout">
    <aside class="sidebar">
        <div class="logo">LOGO</div>
        <nav>
            <a href="DashboardController.php">⌂ <span>Dashboard</span></a>
            <a class="active" href="FoodController.php">▣ <span>Manage Food</span></a>
            <a href="OrderController.php">▤ <span>Orders</span></a>
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
            <h1>2. Manage Food Items</h1>

            <div class="panel">
                <div class="panel-title">
                    <h2>Manage Food Items</h2>
                </div>

                <div class="form-container" style="margin-bottom: 20px;">
                    <button class="btn-primary" style="margin-bottom: 15px;">+ Add New Food</button>
                    <!-- Simple Add/Edit Form mock if needed -->
                </div>

                <div class="table-wrap">
                    <table>
                        <thead>
                        <tr>
                            <th>Food Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (isset($foods) && $foods && $foods->num_rows > 0): ?>
                            <?php while ($row = $foods->fetch_assoc()): 
                                $foodName = isset($row['food_name']) ? $row['food_name'] : (isset($row['name']) ? $row['name'] : 'Item');
                                $category = isset($row['category']) ? $row['category'] : 'General';
                                $price = isset($row['price']) ? $row['price'] : 0;
                                $status = isset($row['status']) ? $row['status'] : 'Active';
                                $foodId = isset($row['id']) ? $row['id'] : 0;
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($foodName) ?></td>
                                <td><?= htmlspecialchars($category) ?></td>
                                <td>$<?= number_format($price, 2) ?></td>
                                <td><span class="badge <?= strtolower($status) ?>"><?= htmlspecialchars($status) ?></span></td>
                                <td>
                                    <a href="FoodController.php?action=edit&id=<?= $foodId ?>" style="color: blue; margin-right: 10px;">Edit</a>
                                    <a href="FoodController.php?action=delete&id=<?= $foodId ?>" style="color: red;" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="5" class="empty">No food items found.</td></tr>
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