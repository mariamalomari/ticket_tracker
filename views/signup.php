<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <!-- bootstrap css file -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous" defer></script>
    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <!--css-->
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script>
        document.addEventListener("submit", function (evt) {
            const form = evt.target;
            const errorDiv = document.getElementById('jsError')
            //checking if passwords match
            if (form.password && form.repeatedPassword) {
                if (form.password.value !== form.repeatedPassword.value) {
                    evt.preventDefault(); //prevents default action of post submission
                    errorDiv.textContent = "Passwords do not match.";
                    errorDiv.classList.remove('d-none');
                    return;
                }
            } else {
                //checking for minimum length
                if (form.password.value.length < 8) {
                    evt.preventDefault(); //prevents default action of post submission
                    errorDiv.textContent = "Password must be at least 8 letters.";
                    errorDiv.classList.remove('d-none');
                    return;
                } else if (form.password.value.trim() == "") { //if user inputted a password of just spaces 
                    evt.preventDefault(); //prevents default action of post submission
                    errorDiv.textContent = "Password must be at least 8 letters, include a lowercase, uppercase letter and a number.";
                    errorDiv.classList.remove('d-none');
                    return;
                } 
            }
        });
    </script>
</head>
<body class="d-flex justify-content-center align-items-center min-vh-100" style="background-color: #fffbfd;">
    <div class="container p-5 border rounded-3 container-lg mx-auto shadow" style="max-width: 500px; background-color: #ffffff;">
        <h2 class="text-center fw-bold mb-3" style="color: #300028;">Sign Up</h2>
        <form action="../public/signup.php" method="POST">
            <div class="mb-3">
                <label class="form-label" style="color: #300028;">Email: </label>    
                <input type="email" name="email" class="form-control" required>
            </div>    
            <div class="mb-3">
                <label class="form-label" style="color: #300028;">Password: </label>    
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label" style="color: #300028;">Repeat Password: </label>    
                <input type="password" name="repeatedPassword" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 mt-2 mb-3" style="background-color: #300028; border-color: #300028;">Register</button>
        </form>

    <!-- client-side password input validation  -->
        <div id="jsError" class="alert alert-danger py-2 d-none"></div>

        <!-- server side validation -->
        <?php if ($message): ?>
        <div class="alert alert-danger py-2">
                <?php echo htmlspecialchars($message) ?>
        </div>
        <?php endif; ?>
        <div class="text-center">
            <label style="color: #300028;">Already a User?</label>
            <br>
            <a href="../public/login.php" class="text-decoration-none fw-bold" style="color: #300028;">Login</a>
        </div>
    </div>
</body>
</html>