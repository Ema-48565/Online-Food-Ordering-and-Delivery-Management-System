<?php
include "../model/databaseconnection.php";
session_start();

$database = new DatabaseConnection();
$connection = $database->openConnection();

$order_id = $_GET["order_id"] ?? null;
$order = $order_id ? $database->getOrderStatus($connection, $order_id) : null;

$statusSteps = ["Order Placed", "Confirmed", "On the Way", "Delivered"];
$currentStepIndex = $order ? array_search($order["status"], $statusSteps) : -1;
if ($order && $currentStepIndex === false) { $currentStepIndex = 0; }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Order Status</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">

    <div class="topbar">
        <a href="customer_home.php" class="link">&larr; Back</a>
        <span class="logo" style="flex:1;text-align:center;">Order Status</span>
        <span class="link">Support</span>
    </div>

    <?php if ($order): ?>
        <h3>3. Order Status (Order #<?php echo $order["id"]; ?>)</h3>
        <div class="status-track">
            <?php foreach ($statusSteps as $i => $step): ?>
                <div class="status-step <?php echo $i <= $currentStepIndex ? 'done' : ''; ?>">
                    <div class="dot"></div>
                    <?php echo $step; ?>
                    <div class="sub"><?php echo $i <= $currentStepIndex ? '' : 'Pending'; ?></div>
                </div>
            <?php endforeach; ?>
        </div>

        <h3>Order Summary</h3>
        <div class="cart-line"><span>Customer</span><span><?php echo $order["customer_name"]; ?></span></div>
        <div class="cart-line"><span>Address</span><span><?php echo $order["address"]; ?></span></div>
        <div class="cart-line"><strong>Total</strong><strong>$<?php echo number_format($order["amount"], 2); ?></strong></div>

        <a href="customer_home.php" class="btn-primary" style="display:inline-block;margin-top:15px;">Back to Home</a>
    <?php else: ?>
        <p>Order not found.</p>
    <?php endif; ?>

</div>
</body>
</html>