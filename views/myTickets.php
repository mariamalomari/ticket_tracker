<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Tickets</title>
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
                    <form action="../public/myTickets.php" method="GET" class="input-group"> 
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
            <a href="../public/dashboard.php" style="color: #300028;">Dashboard</a>
            <a href="../public/allTickets.php" style="color: #300028;">All Tickets</a>
            <a href="../public/myTickets.php" style="color: #300028;" class="active">My Tickets</a>
        </div>
        <div class="main-content">
            <br>

            <?php if ($messageOutput): ?>
                <div class="alert alert-<?php echo $color ?>"><?php echo $messageOutput ?></div>
            <?php endif; ?>
            
            <h2>My Tickets</h2>
            <br>
            <form action="../public/myTickets.php" method="GET" class="row">
                <div class="col-md-3">
                    <input class="form-control" type="search" placeholder="Search for a title" name="titleSearch">
                </div>
                <div class="col-md-3">
                    <select name="category" class="form-select">
                        <option value="">All Categories</option>
                        <option value="Frontend" <?php if (isset($_GET["category"]) && $_GET["category"] == "Frontend"): echo "selected"; endif ?>>Frontend</option>
                        <option value="Backend" <?php if (isset($_GET["category"]) && $_GET["category"] == "Backend"): echo "selected"; endif ?>>Backend</option>
                        <option value="Database" <?php if (isset($_GET["category"]) && $_GET["category"] == "Database"): echo "selected"; endif ?>>Database</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="Open" <?php if (isset($_GET["status"]) && $_GET["status"] == "Open"): echo "selected"; endif ?>>Open</option>
                        <option value="In progress" <?php if (isset($_GET["status"]) && $_GET["status"] == "In progress"): echo "selected"; endif ?>>In progress</option>
                        <option value="Closed" <?php if (isset($_GET["status"]) && $_GET["status"] == "Closed"): echo "selected"; endif ?>>Closed</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="priority" class="form-select">
                        <option value="">All Priorities</option>
                        <option value="Low" <?php if (isset($_GET["priority"]) && $_GET["priority"] == "Low"): echo "selected"; endif ?>>Low</option>
                        <option value="Medium" <?php if (isset($_GET["priority"]) && $_GET["priority"] == "Medium"): echo "selected"; endif ?>>Medium</option>
                        <option value="High" <?php if (isset($_GET["priority"]) && $_GET["priority"] == "High"): echo "selected"; endif ?>>High</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-secondary">Search</button>
                </div>
            </form>
            <table class="table mt-5">
                <tr>
                    <th>Project</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
                <?php
                    foreach ($tickets as $ticket):
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($ticket["project_name"]) ?></td>
                    <td><?php echo htmlspecialchars($ticket["title"]) ?></td>
                    <td><?php echo htmlspecialchars($ticket["category"]) ?></td>
                    <td><?php echo htmlspecialchars($ticket["description"]) ?></td>
                    <td><?php echo htmlspecialchars($ticket["status"]) ?></td>
                    <td><?php echo htmlspecialchars($ticket["priority"]) ?></td>
                    <td><?php echo htmlspecialchars($ticket["created_at"]) ?></td>
                    <!-- Delete Actions -->
                    <td>
                        <a href="../public/viewTicket.php?id=<?php echo $ticket["id"] ?>" type="button" class="bi-eye-fill btn btn-light"></a>
                        <a href="../public/editTicket.php?id=<?php echo $ticket["id"] ?>" class="bi-pencil-square btn btn-dark"></a>
                        <button class="bi-trash-fill btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal<?php echo $ticket['id'] ?>" ></button>
                        <!-- Delete Confirmation Modal -->
                        <div class="modal" id="deleteConfirmationModal<?php echo $ticket['id'] ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Ticket Deletion Confirmation</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete ticket <?php echo htmlspecialchars($ticket['id']) ?>? This action cannot be reversed.
                                    </div>
                                    <div class="modal-footer">
                                        <form action="../public/myTickets.php" method="POST">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="ticketIdToDelete" value="<?php echo $ticket['id'] ?>">
                                            <button type="submit" class="btn btn-light">Yes</button>
                                        </form>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>
                <?php endforeach; ?>

            </table>
        </div>
    </div>


</body>
</html>

