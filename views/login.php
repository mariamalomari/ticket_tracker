<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- bootstrap css file -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous" defer></script>
    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <!--css-->
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body class="d-flex justify-content-center align-items-center min-vh-100" style="background-color: #fffbfd;">
    <div class="container p-5 border rounded-3 container-lg mx-auto shadow" style="max-width: 500px; background-color: #ffffff;">
        <h2 class="text-center fw-bold mb-3" style="color: #300028;">Login</h2>
        <form action="../public/login.php" method="POST">
            <div class="mb-3">
                <label class="form-label" style="color: #300028;">Email: </label>    
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label" style="color: #300028;">Password: </label>    
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 mt-2 mb-3" style="background-color: #300028; border-color: #300028;">Login</button>
        </form>
        <?php if ($message): ?>
        <div class="alert alert-danger py-2">
                <?php echo htmlspecialchars($message) ?>
        </div>
        <?php endif; ?>
        <div class="text-center">
            <label style="color: #300028;">Not a User?</label>
            <br>
            <a href="signup.php" class="text-decoration-none fw-bold" style="color: #300028;">Sign Up</a>
        </div>
    </div>
</body>
</html>