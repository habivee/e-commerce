<?php
session_start();

$products = [
    ['id' => 17, 'name' => 'Apple AirPods Pro', 'price' => 799.99, 'image' => 'images/accessories1.jpg'],
    ['id' => 18, 'name' => 'Apple AirPods Max ', 'price' => 999.99, 'image' => 'images/accessories2.jpg'],
    ['id' => 19, 'name' => 'Apple Watch Series 8" 3K OLED', 'price' => 1299.99, 'image' => 'images/accessories3.jpg'],
    ['id' => 20, 'name' => 'Nintendo Handheld Console', 'price' => 799.99, 'image' => 'images/accessories4.jpg'],
    ['id' => 21, 'name' => 'Apple Magsafe Wireless Power Bank', 'price' => 999.99, 'image' => 'images/accessories5.jpg'],
    ['id' => 22, 'name' => 'Tuelaly Mini Fan Kawaiis', 'price' => 1299.99, 'image' => 'images/accessories6.jpg'],
    ['id' => 23, 'name' => 'Carregador p/ Iphone 14 USB-C', 'price' => 799.99, 'image' => 'images/accessories7.jpg'],
    ['id' => 24, 'name' => 'Instax Mini 9', 'price' => 999.99, 'image' => 'images/accessories8.jpg'],
];

// Initialize cart if not already
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Add to Cart functionality
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Check if product is already in the cart
    $product_exists = false;
    foreach ($_SESSION['cart'] as &$cart_item) {
        if ($cart_item['id'] == $product_id) {
            $cart_item['quantity'] += $quantity;  // Update the quantity if already in the cart
            $product_exists = true;
            break;
        }
    }

    // If product is not in the cart, add it
    if (!$product_exists) {
        foreach ($products as $product) {
            if ($product['id'] == $product_id) {
                $_SESSION['cart'][] = [
                    'id' => $product['id'],
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'quantity' => $quantity,
                ];
                break;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accessories Collection</title>
    <style>
           body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            color: #333;
        }

        header {
            background-color: #333;
            color: white;
            padding: 15px 0;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        header .logo {
            font-size: 2rem;
            font-weight: bold;
        }

        nav ul {
            list-style: none;
            padding: 0;
            text-align: center;
            margin-top: 10px;
        }

        nav ul li {
            display: inline;
            margin: 0 20px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 1.1em;
            padding: 5px 10px;
        }

        .product-section {
            padding: 40px 20px;
            background-color: #fff;
            text-align: center;
        }

        h2 {
            font-size: 2.5rem;
            margin-bottom: 30px;
            color: #333;
        }

        /* Center Navbar */
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
    position: relative;
    margin: 0 20px; /* Adjust spacing */
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

/* Center Dropdown */
.dropdown {
    text-align: center;
}
/* Dropdown Menu */
.dropdown-menu {
    display: none;
    position: absolute;
    background-color: white;
    color: black;
    top: 100%;
    left: 0;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    min-width: 180px;
    transition: all 0.3s ease-in-out;
    opacity: 0;
    visibility: hidden;
}

.dropdown.active .dropdown-menu {
    display: block;
    opacity: 1;
    visibility: visible;
}

.dropdown-menu li {
    display: block;
}

.dropdown-menu a {
    color: #222;
    display: block;
    padding: 12px;
    transition: background 0.3s;
}

.dropdown-menu a:hover {
    background: #e67e22;
    color: white;
}

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 30px;
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .product-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        }

        .product-image {
    width: 100%;
    height: 300px; /* Set a fixed height for all images */
    object-fit: cover; /* Ensures the image fills the container without distorting */
    border-bottom: 1px solid #ddd;
}


        .product-info {
            padding: 20px;
        }

        .product-info h3 {
            font-size: 1.3rem;
            margin: 10px 0;
            color: #333;
        }

        .product-info .price {
            font-size: 1.2rem;
            font-weight: bold;
            color: #e67e22;
            margin-bottom: 15px;
        }

        .quantity-input {
            width: 60px;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-right: 10px;
            font-size: 1rem;
        }

        .add-to-cart-button {
            padding: 12px 20px;
            background-color: #e67e22;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .add-to-cart-button:hover {
            background-color: #d35400;
            transform: translateY(-2px);
        }

        footer {
            background-color: #333;
            color: white;
            padding: 20px 0;
            text-align: center;
            margin-top: 40px;
        }

        footer p {
            font-size: 1rem;
            margin: 0;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .product-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }

            .product-info h3 {
                font-size: 1.1rem;
            }

            .product-info .price {
                font-size: 1.1rem;
            }

            .quantity-input {
                width: 50px;
            }

            .add-to-cart-button {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
<header>
    <div class="logo">Hightech Store</div>
    <nav>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li class="dropdown">
                <a href="#" class="category-toggle">Categories ▼</a>
                <ul class="dropdown-menu">
                    <li><a href="smartphones.php">Smartphones</a></li>
                    <li><a href="laptop.php">Laptops</a></li>
                </ul>
            </li>
            <li><a href="cart.php">Cart (<?php echo count($_SESSION['cart']); ?>)</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

    <section class="product-section">
        <h2>Accessories Collection</h2>
        <div class="product-grid">
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <!-- Check if the image exists before trying to display -->
                    <?php if (file_exists($product['image'])): ?>
                        <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="product-image">
                    <?php else: ?>
                        <img src="images/default.jpg" alt="Default image" class="product-image">
                    <?php endif; ?>
                    <div class="product-info">
                        <h3><?php echo $product['name']; ?></h3>
                        <p class="price">$<?php echo number_format($product['price'], 2); ?></p>
                        <form action="accessories.php" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            <label for="quantity_<?php echo $product['id']; ?>">Quantity:</label>
                            <input type="number" id="quantity_<?php echo $product['id']; ?>" name="quantity" value="1" min="1" class="quantity-input">
                            <button type="submit" name="add_to_cart" class="add-to-cart-button">Add to Cart</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <script>
document.addEventListener("DOMContentLoaded", function () {
    const categoryToggle = document.querySelector(".category-toggle");
    const dropdown = document.querySelector(".dropdown");

    categoryToggle.addEventListener("click", function (event) {
        event.preventDefault();
        dropdown.classList.toggle("active");
    });

    // Close dropdown if clicked outside
    document.addEventListener("click", function (event) {
        if (!categoryToggle.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.classList.remove("active");
        }
    });
});
</script>

    <footer>
        <p>&copy; 2025 Hightech Store. All Rights Reserved.</p>
    </footer>
</body>
</html>
