<?php
session_start();

// Check if the cart is initialized
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle removing an item from the cart
if (isset($_POST['cart_item_id'])) {
    $cart_item_id = $_POST['cart_item_id'];

    // Remove the item from the cart
    unset($_SESSION['cart'][$cart_item_id]);
}

// Redirect back to the cart page
header('Location: cart.php');
exit;
?>
