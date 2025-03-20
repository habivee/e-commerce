<?php
session_start();
include 'db.php'; // Include your database connection

// Get product ID and quantity from the form
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];
$user_id = $_SESSION['user_id']; // Assuming user is logged in and user ID is in session

// Query to get product details from the database
$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

// Check if cart exists in session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Check if the product is already in the session cart
if (isset($_SESSION['cart'][$product_id])) {
    $_SESSION['cart'][$product_id]['quantity'] += $quantity; // Increase quantity
} else {
    $_SESSION['cart'][$product_id] = [
        'name' => $product['name'],
        'price' => $product['price'],
        'quantity' => $quantity,
        'image' => $product['image']
    ];
}

// Check if product already exists in the database cart for persistent storage
$query = "SELECT * FROM cart_items WHERE user_id = ? AND product_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('ii', $user_id, $product_id);
$stmt->execute();
$cart_result = $stmt->get_result();

if ($cart_result->num_rows > 0) {
    // Update quantity in the database if the product is already in the cart
    $update_query = "UPDATE cart_items SET quantity = quantity + ? WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param('iii', $quantity, $user_id, $product_id);
    $stmt->execute();
} else {
    // Insert a new product into the cart table if it doesn't exist
    $insert_query = "INSERT INTO cart_items (user_id, product_id, quantity) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param('iii', $user_id, $product_id, $quantity);
    $stmt->execute();
}

// Optionally save the cart to a cookie (for backup, if needed)
setcookie('cart', serialize($_SESSION['cart']), time() + (86400 * 30), '/'); // expires in 30 days

// Redirect to cart page or wherever needed
header('Location: cart.php');
exit;
?>
