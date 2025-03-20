<?php
include("db.php");

// Define error messages
$password_error = "";
$username_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Check if username or email already exists
    $check_query = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $result = mysqli_query($conn, $check_query);
    
    if (mysqli_num_rows($result) > 0) {
        $username_error = "Username or Email already taken. Please choose another.";
    } elseif (strlen($password) < 6) {
        $password_error = "Password must be at least 6 characters long.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash password

        // Insert user into database
        $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Registration successful! Please log in.'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Error: Unable to register.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <small style="color: red;"> <?php echo $username_error; ?> </small>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <small style="color: red;"> <?php echo $password_error; ?> </small>
            <button type="submit">Register</button>
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </form>
    </div>
</body>
</html>
