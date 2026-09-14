<?php
include "../model/foodmenu.php";
session_start();

$menu = new FoodMenu();

$checkoutError = $_SESSION["checkoutError"] ?? "";
unset($_SESSION["checkoutError"]);

$subtotal = 0;
$cartItems = [];
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
    <title>Checkout / Order Status</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">

    <div class="topbar">
        <a href="food_details_cart.php" class="link">&larr; Back</a>
        <span class="logo" style="flex:1;text-align:center;">Checkout / Order Status</span>
        <span class="link">Support</span>
    </div>

    <?php if ($checkoutError): ?>
        <p class="error-text"><?php echo $checkoutError; ?></p>
    <?php endif; ?>

    <form action="../controller/placeorder.php" method="post">
        <div class="two-col">
            <div class="left">
                <h3>1. Delivery Address</h3>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" placeholder="Enter your full name" required>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" placeholder="House/Street, Area, City" required>
                </div>
                <div class="form-group">
                    <label>Landmark (Optional)</label>
                    <input type="text" name="landmark" placeholder="Enter landmark">
                </div>
                <div class="form-group">
                    <label>Delivery Instructions (Optional)</label>
                    <textarea name="instructions" rows="2" placeholder="e.g. Ring the bell, leave at door"></textarea>
                </div>

                <h3>2. Payment Method</h3>
                <div class="payment-options">
                    <label><input type="radio" name="payment_method" value="Cash on Delivery" checked> Cash on Delivery</label>
                    <label><input type="radio" name="payment_method" value="bKash"> bKash</label>
                    <label><input type="radio" name="payment_method" value="Credit/Debit Card"> Credit / Debit Card</label>
                </div>
            </div>

            <div class="right">
                <h3>Order Summary</h3>
                <?php foreach ($cartItems as $item): ?>
                    <div class="cart-line">
                        <span><?php echo $item["name"]; ?> x<?php echo $item["qty"]; ?></span>
                        <span>$<?php echo number_format($item["line_total"], 2); ?></span>
                    </div>
                <?php endforeach; ?>
                <div class="cart-line"><span>Subtotal</span><span>$<?php echo number_format($subtotal, 2); ?></span></div>
                <div class="cart-line"><span>Delivery Fee</span><span>$<?php echo number_format($delivery_fee, 2); ?></span></div>
                <div class="cart-line"><strong>Total</strong><strong>$<?php echo number_format($total, 2); ?></strong></div>

                <button type="submit" class="btn-primary" style="width:100%;margin-top:12px;">Place Order</button>
                <p style="font-size:11px;color:#999;margin-top:8px;">By placing this order, you agree to our Terms & Conditions.</p>
            </div>
        </div>
    </form>

</div>
</body>
</html>