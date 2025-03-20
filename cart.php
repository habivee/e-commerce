
<?php
session_start();
include("db.php");

// Check if cart is stored in session
if (isset($_SESSION['cart'])) {
    // If session cart exists, save it to cookie
    setcookie('cart', serialize($_SESSION['cart']), time() + (86400 * 30), '/'); // expires in 30 days
}


if (!isset($_SESSION['user_id'])) {
    // Redirect to login if the user is not logged in
    header("Location: login.php");
    exit();
}


// Ensure 'cart' is initialized as an empty array if not already set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: white;
            padding: 15px 0;
            text-align: center;
        }

        header .logo {
            font-size: 1.5em;
            font-weight: bold;
        }

        /* Navbar styling */
nav {
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #333;
    padding: 15px 0;
}

.nav-links {
    display: flex;
    justify-content: center;
    align-items: center;
    list-style: none;
    padding: 0;
    margin: 0;
}

.nav-links li {
    position: relative; /* For dropdown positioning */
    margin: 0 15px;
}

.nav-links a {
    color: white;
    text-decoration: none;
    font-size: 1rem;
    padding: 10px;
}

.nav-links a:hover {
    color: #e67e22;
}

/* Dropdown styling */
.category-dropdown:hover .dropdown-content {
    display: block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #333;
    min-width: 160px;
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
    z-index: 1;
}

.dropdown-content a {
    color: white;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {
    background-color: #e67e22;
}

/* For mobile */
@media (max-width: 768px) {
    .nav-links {
        flex-direction: column;
    }

    .nav-links li {
        margin: 10px 0;
    }
}
        nav ul {
            list-style: none;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin: 0 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 1em;
        }

        .cart-section {
            width: 80%;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .cart-section h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #333;
            color: white;
        }

        .total {
            text-align: right;
            margin-top: 20px;
            font-size: 1.2em;
            font-weight: bold;
        }

        .btn-proceed {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.1em;
            display: block;
            margin: 20px auto;
        }

        .btn-proceed:hover {
            background-color: #45a049;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 15px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        footer p {
            margin: 0;
        }
        .all {
            color: white;
        }

        .empty-cart-message {
            text-align: center;
            font-size: 1.2em;
            color: #333;
        }
    </style>
</head>
<body>
<header>
    <div class="logo">Hightech Store</div>
    <nav>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li class="category-dropdown">
                <a href="#">Categories</a>
                <ul class="dropdown-content">
                    <li><a href="laptop.php">Laptops</a></li>
                    <li><a href="smartphones.php">Smartphones</a></li>
                    <li><a href="accessories.php">Accessories</a></li>
                </ul>
            </li>
            <li><a href="cart.php">Cart (<?php echo count($_SESSION['cart']); ?>)</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

    <section class="cart-section">
        <h2>Your Cart</h2>
        <?php if (!empty($_SESSION['cart'])): ?>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; ?>
                    <?php foreach ($_SESSION['cart'] as $key => $item): ?>
                        <tr>
                            <td><?php echo $item['name']; ?></td>
                            <td>$<?php echo number_format($item['price'], 2); ?></td>
                            <td>
                                <form action="update_cart.php" method="POST">
                                    <input type="hidden" name="cart_item_id" value="<?php echo $key; ?>">
                                    <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" max="10">
                                    <button type="submit">Update</button>
                                </form>
                            </td>
                            <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                            <td>
                                <form action="remove_from_cart.php" method="POST">
                                    <input type="hidden" name="cart_item_id" value="<?php echo $key; ?>">
                                    <button type="submit" style="background-color: red; color: white; padding: 5px 10px;">Remove</button>
                                </form>
                            </td>
                        </tr>
                        <?php $total += $item['price'] * $item['quantity']; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="total">Total: $<?php echo number_format($total, 2); ?></div>
            <a href="checkout.php"><button class="btn-proceed">Proceed to Checkout</button></a>
        <?php else: ?>
            <p class="empty-cart-message">Your cart is empty.</p>
        <?php endif; ?>
    </section>

    <footer>
        <p class="all">&copy; 2025 Hightech Store. All Rights Reserved.</p>
    </footer>
</body>
</html>
