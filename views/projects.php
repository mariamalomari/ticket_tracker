<?php 
$pageTitle = "Projects";
$activePage = "projects"; //for sidebar
require_once 'partials/header.php';
require_once 'partials/navbar.php'; 
?>


    <div class="main-body">
        <!--sidebar-->
        <?php require_once 'partials/sidebar.php'; ?>

        <div class="main-content">
            <br>

            <?php if ($messageOutput): ?>
                <div class="alert alert-<?php echo htmlspecialchars($color) ?>"><?php echo htmlspecialchars($messageOutput)?></div>
            <?php endif; ?>

            <br>
            <?php if ($_SESSION['is_admin'] == true): ?>
            <div class="col-md-6">
                <h2>Create a New Project: </h2>

                <!-- client-side input validation  -->
                <div id="jsError" class="alert alert-danger py-2 d-none"></div>

                <form action="../public/projects.php" method="POST" id="projectCreationForm">
                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'] ?? ''); ?>">

                    <label class="form-label">Name: </label>
                    <input name="name" type="text" class="form-control" required>
                    <label class="form-label">Description: </label>
                    <textarea name="description" class="form-control" required></textarea>
                    <br>
                    <button type="submit" class="btn btn-secondary">Submit</button>
                </form>

            </div>
            <?php endif; ?>
            <br>

            <h2>All Projects</h2>

            <table class="table mt-5">
                <tr>
                    <th>Project Name</th>
                    <th>Description</th>
                    <th>Created By</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
                <?php
                    foreach ($projects as $project):
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($project["name"]) ?></td>
                    <td><?php echo htmlspecialchars($project["description"]) ?></td>
                    <td><?php echo htmlspecialchars($project["created_by"]) ?></td>
                    <td><?php echo htmlspecialchars($project["created_at"]) ?></td>
                    <!-- Delete Actions -->
                    <td>
                        <a href="../public/viewProject.php?id=<?php echo htmlspecialchars($project["id"]) ?>" type="button" class="bi-eye-fill btn btn-light"></a>
                        <!-- can only edit and delete if they have admin rights -->
                        <?php if ($_SESSION['is_admin'] == true): ?>
                        <a href="../public/editProject.php?id=<?php echo htmlspecialchars($project["id"]) ?>" class="bi-pencil-square btn btn-dark"></a>
                        <button class="bi-trash-fill btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal<?php echo htmlspecialchars($project['id'] )?>" ></button>
                        <!-- Delete Confirmation Modal -->
                        <div class="modal" id="deleteConfirmationModal<?php echo htmlspecialchars($project["id"]) ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Project Deletion Confirmation</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete project <?php echo htmlspecialchars($project['id']) ?>? This action cannot be reversed.
                                    </div>
                                    <div class="modal-footer">
                                        <form action="../public/projects.php" method="POST">
                                            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?? ''; ?>">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="projectIdToDelete" value="<?php echo htmlspecialchars($project["id"]) ?>">
                                            <button type="submit" class="btn btn-light">Yes</button>
                                        </form>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                    </td>
                </tr>
                <?php endforeach; ?>

            </table>
        </div>
    </div>


</body>
</html>

