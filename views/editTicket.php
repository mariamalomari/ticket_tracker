<?php 
$pageTitle = "Edit Ticket";
$activePage = "myTickets"; //for sidebar
require_once 'partials/header.php';
require_once 'partials/navbar.php'; 
?>




    <div class="main-body">
        <!--sidebar-->
        <?php require_once 'partials/sidebar.php'; ?>
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
                    <div class="alert alert-<?php echo htmlspecialchars($color) ?>"><?php echo htmlspecialchars($messageOutput) ?></div>
                <?php endif; ?>
                <form action="../public/editTicket.php" method="POST" id="ticketEditingForm">
                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'] ?? ''); ?>">
                    <input type="hidden" name="ticket_id" value="<?php echo htmlspecialchars($ticketInfo['id'])?>">
                    <label class="form-label">Project: </label>
                    <select name="project_id" class="form-select" required>
                        <?php 
                            foreach ($allProjectNames as $project):
                        ?>
                        <option value="<?php echo htmlspecialchars($project['id'])?>" <?php if ($ticketInfo["project_id"] == $project['id']): echo "selected"; endif ?>>
                            <?php echo htmlspecialchars($project['name'])?>
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

