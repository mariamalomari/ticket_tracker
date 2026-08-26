<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Ticket</title>
    <!-- bootstrap css file -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous" defer></script>
    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <!--css-->
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const ticketCreationForm = document.getElementById('ticketEditingForm');

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
            <a href="../public/dashboard.php" style="color: #300028;">Dashboard</a>
            <a href="../public/allTickets.php" style="color: #300028;">All Tickets</a>
            <a href="../public/myTickets.php" style="color: #300028;">My Tickets</a>
        </div>
        <div class="main-content">
            <br>
            <a href="../public/allTickets.php" class="btn btn-secondary bi-arrow-return-left"> Back</a>
            <br>
            <br>
            <h2>Edit Ticket</h2>
            <br>
                <div class="col-md-6">
                <!-- client-side input validation  -->
                <div id="jsError" class="alert alert-danger py-2 d-none"></div>

                <?php if ($messageOutput): ?>
                    <div class="alert alert-<?php echo $color ?>"><?php echo $messageOutput ?></div>
                <?php endif; ?>
                <form action="../public/editTicket.php" method="POST" id="ticketEditingForm">
                    <input type="hidden" name="ticket_id" value="<?php echo $ticketInfo['id']?>">
                    <label class="form-label">Project: </label>
                    <select name="project_id" class="form-select" required>
                        <?php 
                            foreach ($allProjectNames as $project):
                        ?>
                        <option value="<?php echo $project['id']?>" <?php if ($ticketInfo["project_id"] == $project['id']): echo "selected"; endif ?>>
                            <?php echo $project['name']?>
                        </option>
                        <?php endforeach; ?>
                    </select>

                    <label class="form-label">Title: </label>
                    <input name="title" type="text" class="form-control" value="<?php echo htmlspecialchars($ticketInfo["title"]) ?>" required>
                    <label class="form-label">Description: </label>
                    <textarea name="description" class="form-control" required><?php echo htmlspecialchars($ticketInfo["description"]) ?></textarea>
                    <label class="form-label">Category: </label>
                    <select name="category" class="form-select" required>
                        <option value="Frontend" <?php if ($ticketInfo["category"] == "Frontend"): echo "selected"; endif ?>>Frontend</option>
                        <option value="Backend" <?php if ($ticketInfo["category"] == "Backend"): echo "selected"; endif ?>>Backend</option>
                        <option value="Database" <?php if ($ticketInfo["category"] == "Database"): echo "selected"; endif ?>>Database</option>
                    </select>
                    <label class="form-label">Priority: </label>
                    <select name="priority" class="form-select" required>
                        <option value="Low" <?php if ($ticketInfo["priority"] == "Low"): echo "selected"; endif ?>>Low</option>
                        <option value="Medium" <?php if ($ticketInfo["priority"] == "Medium"): echo "selected"; endif ?>>Medium</option>
                        <option value="High" <?php if ($ticketInfo["priority"] == "High"): echo "selected"; endif ?>>High</option>
                    </select>
                    <label class="form-label">Status: </label>
                    <select name="status" class="form-select">
                        <option value="Open" <?php if ($ticketInfo["status"] == "Open"): echo "selected"; endif ?>>Open</option>
                        <option value="In progress" <?php if ($ticketInfo["status"] == "In progress"): echo "selected"; endif ?>>In progress</option>
                        <option value="Closed" <?php if ($ticketInfo["status"] == "Closed"): echo "selected"; endif ?>>Closed</option>
                    </select>
                    <br>
                    <button type="submit" class="btn btn-danger">Save</button>
                    <a href="../public/allTickets.php" class="btn btn-secondary">Cancel</a>
                </form>

            </div>

        </div>
    </div>


</body>
</html>

