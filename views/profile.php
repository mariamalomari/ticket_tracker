<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- bootstrap css file -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous" defer></script>
    <!--css-->
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <!--navbar-->
    <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #300028;"> <!-- horizontal navbar that becomes vertica on small screens-->
        <div class="container-fluid"> <!-- container for paddings -->
            <a class="navbar-brand" href="#">Ticket Tracker</a>     
            <ul class="navbar-nav">
                <!--Projects Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" href="#">Projects</a> <!-- dropdown button -->
                    <ul class="dropdown-menu">
                        <a class="dropdown-item text-decoration-none" href="../public/allTickets.php">All Projects</a>
                        <?php 
                            foreach ($allProjectNames as $project):
                        ?>
                        <a class="dropdown-item text-decoration-none" href="../public/allTickets.php?project_id=<?php echo $project['id'] ?>"><?php echo $project['name']?></a>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <!--Search-->
                <li class="nav-item">
                    <form action="../public/allTickets.php" method="GET" class="input-group">
                        <input class="form-control" type="search" placeholder="Search" name="search">
                        <button type="submit" class="btn btn-secondary">Submit</button>
                    </form>
                </li>
                <!--Profile Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" href="#">Profile</a> <!-- dropdown button -->
                    <ul class="dropdown-menu">
                        <a class="dropdown-item" href="../public/profile.php">Profile</a>
                        <a class="dropdown-item" href="../public/logout.php">Logout</a>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>


    <div class="main-body">
        <!--sidebar-->
        <div class="sidebar">
            <a href="../public/dashboard.php" style="color: #300028;" class="active">Dashboard</a>
            <a href="../public/allTickets.php" style="color: #300028;">All Tickets</a>
            <a href="../public/myTickets.php" style="color: #300028;">My Tickets</a>
        </div>
        <div class="main-content">
            <div class="card p-5 m-5 border shadow">
                <h2>Email: </h2>
                <p>
                    <?php echo $user_email ?>
                </p>
            </div>
        </div>
    </div>


</body>
</html>

