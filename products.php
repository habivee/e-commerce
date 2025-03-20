<?php
include 'config.php'; // Ensure your database connection is included

$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : 1; // Default category
$query = $conn->prepare("SELECT * FROM products WHERE category_id = ?");
$query->bind_param("i", $category_id);
$query->execute();
$result = $query->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .products-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
            max-width: 1200px;
            margin: auto;
        }
        .product-card {
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease-in-out;
        }
        .product-card:hover {
            transform: scale(1.05);
        }
        .product-card img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .product-card h3 {
            font-size: 18px;
            margin: 10px 0;
        }
        .product-card p {
            font-size: 16px;
            color: #ff6f61;
            font-weight: bold;
        }
        .product-card button {
            padding: 10px;
            background: #333;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .product-card button:hover {
            background: #555;
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

<section class="products-container">
    <?php while ($row = $result->fetch_assoc()) : ?>
        <div class="product-card">
            <img src="images/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
            <h3><?php echo $row['name']; ?></h3>
            <p>$<?php echo number_format($row['price'], 2); ?></p>
            <button>Add to Cart</button>
        </div>
    <?php endwhile; ?>
</section>

<footer>
    <p>&copy; 2025 GadgetStore. All Rights Reserved.</p>
</footer>

</body>
</html>

