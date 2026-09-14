<?php
include "../model/foodmenu.php";
session_start();

if (empty($_SESSION["isLoggedIn"])) {
    Header("Location: login.php");
}

$menu = new FoodMenu();
$foods = $menu->getAllFoods();
$restaurants = $menu->getAllRestaurants();

$searchKeyword = $_GET["q"] ?? "";
$searchResults = $searchKeyword ? $menu->searchFoods($searchKeyword) : [];

$cartCount = isset($_SESSION["cart"]) ? array_sum($_SESSION["cart"]) : 0;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Customer Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">

    <div class="topbar">
        <span class="logo">LOGO</span>
        <form method="get" action="customer_home.php">
            <input type="text" name="q" placeholder="Search" value="<?php echo htmlspecialchars($searchKeyword); ?>">
        </form>
        <a href="food_details_cart.php" class="link">Cart (<?php echo $cartCount; ?>)</a>
        <a href="../controller/logout.php" class="link">Profile</a>
    </div>

    <?php if ($searchResults): ?>
        <div class="section-title">Search Results</div>
        <div class="card-grid">
            <?php foreach ($searchResults as $food): ?>
                <div class="card">
                    <div class="name"><?php echo $food["name"]; ?></div>
                    <div class="price">$<?php echo $food["price"]; ?></div>
                    <a href="food_details_cart.php?id=<?php echo $food["id"]; ?>">View</a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="section-title">Categories <a href="#">View All</a></div>
    <div class="pill-row">
        <div class="pill active">All</div>
        <div class="pill">Pizza</div>
        <div class="pill">Burger</div>
        <div class="pill">Biryani</div>
        <div class="pill">Drinks</div>
        <div class="pill">Dessert</div>
    </div>

    <div class="section-title">Popular Restaurants <a href="#">View All</a></div>
    <div class="card-grid">
        <?php foreach ($restaurants as $r): ?>
            <div class="card">
                <div class="name"><?php echo $r["name"]; ?></div>
                <div class="meta"><?php echo $r["rating"]; ?> ★ · <?php echo $r["delivery_time"]; ?></div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="section-title">Popular Foods <a href="#">View All</a></div>
    <div class="card-grid">
        <?php foreach ($foods as $food): ?>
            <div class="card">
                <div class="name"><?php echo $food["name"]; ?></div>
                <div class="meta"><?php echo $food["restaurant"]; ?></div>
                <div class="price">$<?php echo $food["price"]; ?></div>
                <a href="food_details_cart.php?id=<?php echo $food["id"]; ?>">View</a>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="bottom-nav">
        <span>Categories</span>
        <span>Orders</span>
        <a href="food_details_cart.php">Cart (<?php echo $cartCount; ?>)</a>
        <a href="../controller/logout.php">Profile</a>
    </div>

</div>
</body>
</html>