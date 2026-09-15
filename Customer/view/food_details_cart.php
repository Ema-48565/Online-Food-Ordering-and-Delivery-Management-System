<?php
include "../model/foodmenu.php";
session_start();

$menu = new FoodMenu();

$food_id = $_GET["id"] ?? null;
$food = $food_id ? $menu->getFoodById($food_id) : null;
$suggestions = $food_id ? $menu->getSuggestedFoods($food_id) : [];

$cartItems = [];
$subtotal = 0;
if (!empty($_SESSION["cart"])) {
    foreach ($_SESSION["cart"] as $id => $qty) {
        $item = $menu->getFoodById($id);
        if ($item) {
            $item["qty"] = $qty;
            $item["line_total"] = $item["price"] * $qty;
            $subtotal += $item["line_total"];
            $cartItems[] = $item;
        }
    }
}
$delivery_fee = 2.00;
$total = $subtotal + $delivery_fee;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Food Details + Cart</title>
    <link rel="stylesheet" href="style_2.css">
</head>
<body>
<div class="container">

    <div class="topbar">
        <a href="customer_home.php" class="link">&larr; Back</a>
        <span class="logo" style="flex:1;text-align:center;">Food Details + Cart</span>
        <span class="link">Cart (<?php echo count($cartItems); ?>)</span>
    </div>

    <div class="two-col">
        <div class="left">
            <?php if ($food): ?>
                <div class="food-img-box">Image</div>
                <h2><?php echo $food["name"]; ?></h2>
                <p class="price" style="font-size:18px;">$<?php echo $food["price"]; ?></p>
                <p><?php echo $food["description"]; ?></p>

                <form action="../controller/addtocart.php" method="post">
                    <input type="hidden" name="food_id" value="<?php echo $food["id"]; ?>">
                    <label>Quantity</label>
                    <div class="qty-box">
                        <button type="button" onclick="changeQty(-1)" style="width:32px;height:32px;border-radius:50%;">−</button>
                        <input type="number" id="qtyInput" name="qty" value="1" min="1">
                        <button type="button" onclick="changeQty(1)" style="width:32px;height:32px;border-radius:50%;">+</button>
                    </div>
                    <button type="submit" class="btn-primary">Add to Cart</button>
                </form>

                <?php if ($suggestions): ?>
                    <h3 style="margin-top:25px;">You may also like</h3>
                    <div class="card-grid">
                        <?php foreach ($suggestions as $s): ?>
                            <div class="card">
                                <div class="name"><?php echo $s["name"]; ?></div>
                                <div class="price">$<?php echo $s["price"]; ?></div>
                                <form action="../controller/addtocart.php" method="post">
                                    <input type="hidden" name="food_id" value="<?php echo $s["id"]; ?>">
                                    <input type="hidden" name="qty" value="1">
                                    <button type="submit">Add</button>
                                </form>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

            <?php else: ?>
                <p>No food selected. <a href="customer_home.php">Go back home</a>.</p>
            <?php endif; ?>
        </div>

        <div class="right">
            <h3>Cart Summary (<?php echo count($cartItems); ?> items)</h3>
            <?php if (empty($cartItems)): ?>
                <p>Your cart is empty.</p>
            <?php else: ?>
                <?php foreach ($cartItems as $item): ?>
                    <div class="cart-line">
                        <span><?php echo $item["name"]; ?><br><small>x<?php echo $item["qty"]; ?></small></span>
                        <span>
                            $<?php echo number_format($item["line_total"], 2); ?>
                            <a class="remove" href="../controller/removefromcart.php?food_id=<?php echo $item["id"]; ?>">Remove</a>
                        </span>
                    </div>
                <?php endforeach; ?>

                <div class="cart-line"><span>Subtotal</span><span>$<?php echo number_format($subtotal, 2); ?></span></div>
                <div class="cart-line"><span>Delivery Fee</span><span>$<?php echo number_format($delivery_fee, 2); ?></span></div>
                <div class="cart-line"><strong>Total</strong><strong>$<?php echo number_format($total, 2); ?></strong></div>

                <a href="checkout.php" class="btn-primary" style="display:block;text-align:center;margin-top:12px;">Proceed to Checkout</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="bottom-nav">
        <a href="customer_home.php">Categories</a>
        <span>Orders</span>
        <span>Cart (<?php echo count($cartItems); ?>)</span>
        <span>Profile</span>
    </div>

</div>

<script>
function changeQty(delta) {
    var input = document.getElementById("qtyInput");
    var newVal = parseInt(input.value) + delta;
    if (newVal < 1) newVal = 1;
    input.value = newVal;
}
</script>
</body>
</html>