<?php
include 'db.php'; // Database connection

// Get category from URL (ensure you're sanitizing it)
$category = isset($_GET['category']) ? $_GET['category'] : '';

// Query products from the database based on category
$sql = "SELECT * FROM products WHERE category = '$category'"; 
$result = mysqli_query($conn, $sql);

// Check if any products are found
if (mysqli_num_rows($result) > 0) {
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $products = [];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucfirst($category); ?> Products</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Add styles here to make products display nicely */
        .product-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        .product-card {
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .product-card img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .product-card h3 {
            margin-top: 10px;
            font-size: 18px;
        }
        .product-card p {
            font-size: 16px;
            color: #333;
            margin: 10px 0;
        }
        .product-card .add-to-cart {
            padding: 10px;
            background: #ff6f61;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .product-card .add-to-cart:hover {
            background: #e65c50;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">GadgetStore</div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="categories.php">Categories</a></li>
                <li><a href="cart.php">Cart (0)</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section class="product-section">
        <h2><?php echo ucfirst($category); ?> Collection</h2>
        <?php if (count($products) > 0): ?>
            <div class="product-container">
                <?php foreach ($products as $product): ?>
                    <div class="product-card">
                        <img src="images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                        <h3><?php echo $product['name']; ?></h3>
                        <p>$<?php echo $product['price']; ?></p>
                        <form method="POST" action="add_to_cart.php">
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            <input type="number" name="quantity" value="1" min="1" max="10">
                            <button type="submit" class="add-to-cart">Add to Cart</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No products found in this category.</p>
        <?php endif; ?>
    </section>

    <footer>
        <p>&copy; 2025 GadgetStore. All Rights Reserved.</p>
    </footer>
</body>
</html>
