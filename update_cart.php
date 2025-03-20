<?php
session_start();

// Check if the cart is initialized
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle updating the cart
if (isset($_POST['cart_item_id']) && isset($_POST['quantity'])) {
    $cart_item_id = $_POST['cart_item_id'];
    $quantity = $_POST['quantity'];

    // Update the quantity if valid
    if ($quantity > 0) {
        $_SESSION['cart'][$cart_item_id]['quantity'] = $quantity;
    }
}

// Redirect back to the cart page
header('Location: cart.php');
exit;
?>
