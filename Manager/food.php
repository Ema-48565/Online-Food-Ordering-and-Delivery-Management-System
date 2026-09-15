<?php
require_once "db.php";

$message = "";

/* Add new food */
if (isset($_POST['add_food'])) {
    $name = trim($_POST['food_name']);
    $category = trim($_POST['category']);
    $price = (float)$_POST['price'];
    $status = $_POST['status'];

    if ($name !== "" && $category !== "" && $price >= 0) {
        $stmt = $conn->prepare("INSERT INTO food_items (food_name, category, price, status) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssds", $name, $category, $price, $status);
        $stmt->execute();
        $stmt->close();
        header("Location: food.php?msg=added");
        exit;
    }
}

/* Delete food */
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM food_items WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: food.php?msg=deleted");
    exit;
}

/* Update food */
if (isset($_POST['update_food'])) {
    $id = (int)$_POST['id'];
    $name = trim($_POST['food_name']);
    $category = trim($_POST['category']);
    $price = (float)$_POST['price'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE food_items SET food_name=?, category=?, price=?, status=? WHERE id=?");
    $stmt->bind_param("ssdsi", $name, $category, $price, $status, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: food.php?msg=updated");
    exit;
}

if (isset($_GET['msg'])) {
    $message = ucfirst($_GET['msg']) . " successfully.";
}

$editFood = null;
if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $stmt = $conn->prepare("SELECT * FROM food_items WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $editFood = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}

$foods = $conn->query("SELECT * FROM food_items ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Food Items</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="layout">
    <aside class="sidebar">
        <div class="logo">LOGO</div>
        <nav>
            <a href="dashboard.php">⌂ <span>Dashboard</span></a>
            <a class="active" href="food.php">▣ <span>Manage Food</span></a>
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
            <h1>2. Manage Food Items</h1>

            <?php if ($message): ?>
                <div class="message"><?= htmlspecialchars($message) ?></div>
            <?php endif; ?>

            <?php if ($editFood): ?>
            <div class="form-panel">
                <h2>Edit Food</h2>
                <form method="POST" class="food-form">
                    <input type="hidden" name="id" value="<?= $editFood['id'] ?>">
                    <input type="text" name="food_name" value="<?= htmlspecialchars($editFood['food_name']) ?>" placeholder="Food Name" required>
                    <input type="text" name="category" value="<?= htmlspecialchars($editFood['category']) ?>" placeholder="Category" required>
                    <input type="number" name="price" value="<?= $editFood['price'] ?>" step="0.01" min="0" placeholder="Price" required>
                    <select name="status">
                        <option <?= $editFood['status']=='Active'?'selected':'' ?>>Active</option>
                        <option <?= $editFood['status']=='Inactive'?'selected':'' ?>>Inactive</option>
                    </select>
                    <button class="btn primary" name="update_food">Update Food</button>
                    <a class="btn" href="food.php">Cancel</a>
                </form>
            </div>
            <?php else: ?>
            <div class="panel">
                <div class="panel-title">
                    <h2>Manage Food Items</h2>
                    <button class="btn primary" onclick="document.getElementById('addBox').style.display='block'">＋ Add New Food</button>
                </div>

                <div id="addBox" class="add-box">
                    <form method="POST" class="food-form">
                        <input type="text" name="food_name" placeholder="Food Name" required>
                        <input type="text" name="category" placeholder="Category" required>
                        <input type="number" name="price" placeholder="Price" step="0.01" min="0" required>
                        <select name="status">
                            <option>Active</option>
                            <option>Inactive</option>
                        </select>
                        <button class="btn primary" name="add_food">Save Food</button>
                        <button type="button" class="btn" onclick="document.getElementById('addBox').style.display='none'">Cancel</button>
                    </form>
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
                        <?php if ($foods && $foods->num_rows > 0): ?>
                            <?php while ($food = $foods->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($food['food_name']) ?></td>
                                <td><?= htmlspecialchars($food['category']) ?></td>
                                <td>$<?= number_format($food['price'], 2) ?></td>
                                <td><span class="badge <?= strtolower($food['status']) ?>"><?= htmlspecialchars($food['status']) ?></span></td>
                                <td>
                                    <a class="action edit" href="food.php?edit=<?= $food['id'] ?>">Edit</a>
                                    <a class="action delete" href="food.php?delete=<?= $food['id'] ?>" onclick="return confirm('Delete this food item?')">Delete</a>
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
            <?php endif; ?>
        </section>
    </main>
</div>
</body>
</html>