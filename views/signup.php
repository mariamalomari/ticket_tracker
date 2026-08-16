<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
    <?php if ($message != null): ?>
    <p style="color: red"><?php echo $message //message is defined in controller in method showSignupPage which redirects to this page?></p>
    <?php endif; ?>
    <form action="../public/signup.php" method="POST">
        <label>Email: </label>    
        <input type="text" name="email" required>
        <label>Password: </label>    
        <input type="password" name="password" required>
        <label>Repeat Password: </label>    
        <input type="password" name="repeatedPassword" required>
        <button>Register</button>
    </form>
</body>
</html>