<?php 
$pageTitle = "Edit Project";
$activePage = "projects"; //for sidebar
require_once 'partials/header.php';
require_once 'partials/navbar.php'; 
?>




    <div class="main-body">
        <!--sidebar-->
        <?php require_once 'partials/sidebar.php'; ?>
        <div class="main-content">
            <br>
            <a href="../public/projects.php" class="btn btn-secondary bi-arrow-return-left"> Back</a>
            <br>
            <br>
            <h2>Edit Project</h2>
            <br>
                <div class="col-md-6">
                <!-- client-side input validation  -->
                <div id="jsError" class="alert alert-danger py-2 d-none"></div>

                <?php if ($messageOutput): ?>
                    <div class="alert alert-<?php echo htmlspecialchars($color) ?>"><?php echo htmlspecialchars($messageOutput) ?></div>
                <?php endif; ?>
                <form action="../public/editProject.php" method="POST" id="projectEditingForm">
                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'] ?? ''); ?>">
                    <input type="hidden" name="project_id" value="<?php echo htmlspecialchars($projectInfo['id'])?>">
                    <label class="form-label">Name: </label>
                    <input name="name" type="text" class="form-control" value="<?php echo htmlspecialchars($projectInfo["name"]) ?>" required>
                    <label class="form-label">Description: </label>
                    <textarea name="description" class="form-control" required><?php echo htmlspecialchars($projectInfo["description"]) ?></textarea>
                    <br>
                    <button type="submit" class="btn btn-danger">Save</button>
                    <a href="../public/projects.php" class="btn btn-secondary">Cancel</a>
                </form>

            </div>

        </div>
    </div>


</body>
</html>

