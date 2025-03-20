<?php
session_start();
include("db.php");

$login_error = "";



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_input = mysqli_real_escape_string($conn, $_POST['user_input']);
    $password = $_POST['password'];

    // Check if input is a username or email
    $query = "SELECT * FROM users WHERE username = '$user_input' OR email = '$user_input'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header("Location: index.php"); // Redirect to homepage
            exit();
        } else {
            $login_error = "Incorrect password.";
        }
    } else {
        $login_error = "Incorrect username or email.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Login </h2>
        <form method="POST">
            <input type="text" name="user_input" placeholder="Username or Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <small style="color: red;"><?php echo $login_error; ?></small>
            <button type="submit">Login</button>
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </form>
    </div>
</body>
</html>
