<?php
require_once "../session_config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="/public/login.php" method="POST">
        <label>Email: </label>    
        <input type="text" name="email" required>
        <label>Password: </label>    
        <input type="password" name="password" required>
        <button type="submit">Login</button>
    </form>
    <?php if ($message): ?>
    <p style="color: red">Username or password is incorrect.</p>
    <?php endif; ?>
    <Label>Not a User?</Label>
    <a href="signup.php">Sign Up</a>
</body>
</html>