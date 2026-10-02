<?php 
$pageTitle = "My Tickets";
$activePage = "myTickets"; //for sidebar
require_once 'partials/header.php';
require_once 'partials/navbar.php'; 
?>

    <div class="main-body">
        <!--sidebar-->
        <?php require_once 'partials/sidebar.php'; ?>
        <div class="main-content">
            <br>

            <?php if ($messageOutput): ?>
                <div class="alert alert-<?php echo htmlspecialchars($color) ?>"><?php echo htmlspecialchars($messageOutput) ?></div>
            <?php endif; ?>
            
            <h2>My Tickets</h2>
            <br>
            <form action="myTickets.php" method="GET" class="row">

                <div class="col-md-3">
                    <input class="form-control" type="search" placeholder="Search for a title/description" name="title" value="<?php echo htmlspecialchars($_GET["title"] ?? ''); ?>">
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
                <?php if (!empty($tickets)): ?>
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
                            <a href="viewTicket.php?id=<?php echo htmlspecialchars($ticket["id"]) ?>" type="button" class="bi-eye-fill btn btn-light"></a>
                            <a href="editTicket.php?id=<?php echo htmlspecialchars($ticket["id"]) ?>" class="bi-pencil-square btn btn-dark"></a>
                            <button class="bi-trash-fill btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal<?php echo htmlspecialchars($ticket['id']) ?>" ></button>
                            <!-- Delete Confirmation Modal -->
                            <div class="modal" id="deleteConfirmationModal<?php echo htmlspecialchars($ticket["id"]) ?>">
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
                                            <form action="myTickets.php" method="POST">
                                                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'] ?? ''); ?>">
                                                <input type="hidden" name="action" value="delete">
                                                <input type="hidden" name="ticketIdToDelete" value="<?php echo htmlspecialchars($ticket["id"]) ?>">
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
                <?php endif; ?>
            </table>
        </div>
    </div>


</body>
</html>

