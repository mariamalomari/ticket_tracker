    <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #300028;"> <!-- horizontal navbar that becomes vertica on small screens-->
        <div class="container-fluid"> <!-- container for paddings -->
            <a class="navbar-brand" href="../public/dashboard.php">Ticket Tracker</a>   
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>  
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav">
                    <!--Projects Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" href="#">Projects</a> <!-- dropdown button -->
                        <ul class="dropdown-menu">
                            <a class="dropdown-item text-decoration-none" href="../public/allTickets.php">All Projects</a>
                            <?php 
                                foreach ($allProjectNames as $project):
                            ?>
                            <a class="dropdown-item text-decoration-none" href="../public/allTickets.php?project_id=<?php echo htmlspecialchars($project['id']) ?>"><?php echo htmlspecialchars($project['name'])?></a>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <!--Search-->
                    <li class="nav-item">
                        <form action="../public/allTickets.php" method="GET" class="input-group">
                            <input class="form-control" type="search" placeholder="Search for a ticket" name="search">
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

        </div>
    </nav>

