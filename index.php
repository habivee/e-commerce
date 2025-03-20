<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HighTech Store</title>

    <link rel="stylesheet" href="css/style.css">
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
        }

       /* General Styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}
/* General Styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

/* Header */
header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #222;
    padding: 15px 20px;
    color: white;
    position: sticky;
    top: 0;
    width: 100%;
    z-index: 1000;
}

.logo {
    font-size: 1.8rem;
    font-weight: bold;
}

/* Navigation Menu */
.nav-links {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
}

.nav-links li {
    position: relative;
    margin: 0 15px;
}

.nav-links a {
    color: white;
    text-decoration: none;
    font-size: 1rem;
    padding: 10px;
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

/* Responsive Menu */
.menu-toggle {
    display: none;
    font-size: 1.8rem;
    cursor: pointer;
}

/* Mobile View */
@media (max-width: 768px) {
    .nav-links {
        display: none;
        flex-direction: column;
        width: 100%;
        position: absolute;
        top: 60px;
        left: 0;
        background: #222;
        padding: 10px;
    }

    .nav-links li {
        text-align: center;
        margin: 10px 0;
    }

    .menu-toggle {
        display: block;
    }

    .nav-links.active {
        display: flex;
    }

    .dropdown-menu {
        position: static;
        display: none;
        opacity: 1;
        visibility: visible;
        background: #333;
        text-align: center;
        width: 100%;
    }

    .dropdown-menu a {
        color: white;
    }

    .dropdown.active .dropdown-menu {
        display: block;
    }
}

        /* Hero Section */
        .hero {
            text-align: center;
            padding: 100px 20px;
            background: url('images/hero-bg.jpg') no-repeat center/cover;
            color: white;
        }

        .hero h1 {
            font-size: 50px;
            margin-bottom: 10px;
        }

        .hero p {
            font-size: 20px;
        }


        /* Category Section */
        .category-section {
            text-align: center;
            padding: 50px 20px;
            background: white;
        }

        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .category {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .category img {
        width: 100%; /* Make sure it scales within the container */
        height: 450px; /* Fixed height for consistency */
        object-fit: cover; /* Ensures the image fills the space while maintaining proportions */
        border-radius: 10px;
        }


        .category h3 {
            margin: 10px 0;
        }

        .category a {
            display: inline-block;
            padding: 10px;
            background-color: #e65c50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .category a:hover {
            background: #555;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 20px;
            background-color:white;
            color: white;
            margin-top: 50px;
        }

    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <header>
    <div class="logo">HighTech Store</div>
    <div class="menu-toggle">&#9776;</div>
    <nav>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li class="dropdown">
                <a href="#" class="category-toggle">Categories ▼</a>
                <ul class="dropdown-menu">
                    <li><a href="smartphones.php">Smartphones</a></li>
                    <li><a href="laptop.php">Laptops</a></li>
                    <li><a href="accessories.php">Accessories</a></li>
                   
                </ul>
            </li>
            <li><a href="cart.php">Cart</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>



    <!-- Hero Section -->
    <section class="hero">
        <h1>Welcome to Hightech Store</h1>
        <p>Find the best deals on the latest gadgets</p> 
    </section>

    <!-- Category Listings -->
    <section class="category-section">
        <h2>Shop by Category</h2>
        <div class="category-grid">
            <div class="category">
                <img src="images/laptops.jpg" alt="Laptops">
                <h3>Laptops</h3>
                <a href="laptop.php">View Products</a>
            </div>
            <div class="category">
                <img src="images/smartphone.jpg" alt="Smartphones">
                <h3>Smartphones</h3>
                <a href="smartphones.php">View Products</a>
            </div>
            <div class="category">
                <img src="images/accessories.jpg" alt="Accessories">
                <h3>Accessories</h3>
                <a href="accessories.php">View Products</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
    <div class="footer-bottom">
        <p>&copy; 2025 HighTech Store. All Rights Reserved.</p>
    </div>
    </footer>

    <script>
       document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.querySelector(".menu-toggle");
    const navLinks = document.querySelector(".nav-links");
    const categoryToggle = document.querySelector(".category-toggle");
    const dropdown = document.querySelector(".dropdown");
    const dropdownMenu = document.querySelector(".dropdown-menu");

    // Toggle mobile menu
    menuToggle.addEventListener("click", function () {
        navLinks.classList.toggle("active");
    });

    // Toggle dropdown menu for categories
    categoryToggle.addEventListener("click", function (event) {
        event.preventDefault();
        dropdown.classList.toggle("active");
    });

    // Close dropdown if clicked outside
    document.addEventListener("click", function (event) {
        if (!categoryToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdown.classList.remove("active");
        }
    });
});

        
    </script>

</body>
</html>
