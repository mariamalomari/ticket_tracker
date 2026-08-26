<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Ticket</title>
    <!-- bootstrap css file -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous" defer></script>
    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
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
            <a href="../public/dashboard.php">Dashboard</a>
            <a href="../public/allTickets.php">All Tickets</a>
            <a href="../public/myTickets.php">My Tickets</a>
        </div>
        <div class="main-content">
            <a href="../public/allTickets.php" class="btn btn-info bi-arrow-return-left"> Back</a>
            <h2>View Ticket</h2>

            <div class="card rounded-3 shadow mx-auto p-4 m-5  me-5">
                <br>
                <small class="text-muted fw-bold">Title: </small>
                <h3 class="card-title fw-bold "><?php echo htmlspecialchars($ticketInfo["title"]) ?></h3>
                <br>
                <div class="row text-center">
                    <div class="col-md-3">
                        <div>
                            <p class="label text-muted">PROJECT </p>
                            <h4 class="number fw-medium"><?php echo $ticketInfo['project_name']?></h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div>
                            <p class="label text-muted">CATEGORY </p>
                            <h4 class="fw-medium"><?php echo $ticketInfo['category']?></h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div>
                            <p class="label text-muted">CREATED BY </p>
                            <h4 class="fw-medium"><?php echo $ticketInfo['created_by']?></h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div>
                            <p class="label text-muted ">CREATED AT </p>
                            <h4 class="fw-medium"><?php echo $ticketInfo['created_at']?></h4>
                        </div>
                    </div>

                </div>

                <div class="m-4">
                    <p class="label text-muted">DESCRIPTION</p>
                    <div class="border rounded-3 p-3 m-3"><?php echo nl2br(htmlspecialchars($ticketInfo["description"])) ?></div>
                </div>
            </div>

        </div>
    </div>


</body>
</html>

