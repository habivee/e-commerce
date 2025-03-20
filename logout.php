<?php
session_start();
session_destroy();  // Destroy session
setcookie('cart', '', time() - 3600, '/');  // Delete the cart cookie by setting its expiration time in the past
header("Location: login.php");
exit();
?>