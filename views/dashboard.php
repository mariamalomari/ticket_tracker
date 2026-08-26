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
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const ticketCreationForm = document.getElementById('ticketCreationForm');

            ticketCreationForm.addEventListener("submit", function (evt) {
                //cheking that none of the inputs were just spaces
                const form = evt.target;
                const errorDiv = document.getElementById('jsError')
                if (form.title.value.trim() == "") {
                    evt.preventDefault();
                    errorDiv.textContent = "Please enter a title."
                    errorDiv.classList.remove('d-none');
                    return;

                } else if (form.description.value.trim() == "") {
                    evt.preventDefault();
                    errorDiv.textContent = "Please enter a description."
                    errorDiv.classList.remove('d-none');
                    return;
                } 
            })
        })
    </script>
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
                <div class="row text-center">
                    <div class="col-md-4">
                        <div>
                            <h2 class="number fw-bold"><?php echo $openTicketsNumber ?? 0 ?></h2>
                            <p class="label">OPEN TICKETS</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div>
                            <h2 class="number fw-bold"><?php echo $myTicketsNumber ?? 0?></h2>
                            <p class="label">MY ACTIVE TICKETS</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div>
                            <h2 class="number fw-bold"><?php echo $highPriorityTicketsNumber  ?? 0 ?></h2>
                            <p class="label">HIGH PRIORITY TICKETS</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Creating a New Ticket -->
            <div class="col-md-6">
                <h2>Create a New Ticket: </h2>

                <!-- client-side input validation  -->
                <div id="jsError" class="alert alert-danger py-2 d-none"></div>

                <?php if ($messageOutput): ?>
                    <div class="alert alert-<?php echo $color ?>"><?php echo $messageOutput ?></div>
                <?php endif; ?>
                <form action="../public/dashboard.php" method="POST" id="ticketCreationForm">
                    <label class="form-label">Project: </label>
                    <select name="project_id" class="form-select" required>
                        <?php 
                            foreach ($allProjectNames as $project):
                        ?>
                        <option value="<?php echo $project['id']?>"><?php echo $project['name']?></option>
                        <?php endforeach; ?>
                    </select>

                    <label class="form-label">Title: </label>
                    <input name="title" type="text" class="form-control" required>
                    <label class="form-label">Description: </label>
                    <textarea name="description" class="form-control" required></textarea>
                    <label class="form-label">Category: </label>
                    <select name="category" class="form-select" required>
                        <option>Frontend</option>
                        <option>Backend</option>
                        <option>Database</option>
                    </select>
                    <label class="form-label">Priority: </label>
                    <select name="priority" class="form-select" required>
                        <option>Low</option>
                        <option>Medium</option>
                        <option>High</option>
                    </select>
                    <label class="form-label">Status: </label>
                    <select name="status" class="form-select">
                        <option>Open</option>
                        <option>In progress</option>
                        <option>Closed</option>
                    </select>
                    <br>
                    <button type="submit" class="btn btn-secondary">Submit</button>
                </form>

            </div>
        </div>
    </div>


</body>
</html>

