<?php 
$pageTitle = "View Project";
$activePage = "projects"; //for sidebar
require_once 'partials/header.php';
require_once 'partials/navbar.php'; 
?>


    <div class="main-body">
        <!--sidebar-->
        <?php require_once 'partials/sidebar.php'; ?>
        <div class="main-content">
            <br>
            <a href="../public/allProjects.php" class="btn btn-info bi-arrow-return-left"> Back</a>
            <br><br>
            <h2>View Project</h2>

            <div class="card rounded-3 shadow mx-auto p-4 m-5  me-5">
                <br>
                <small class="text-muted fw-bold">Name: </small>
                <h3 class="card-title fw-bold "><?php echo htmlspecialchars($projectInfo["name"]) ?></h3>
                <br>
                <div class="row text-center">
                    <div class="col-md-3">
                        <div>
                            <p class="label text-muted">CREATED BY </p>
                            <h4 class="fw-medium"><?php echo htmlspecialchars($projectInfo['created_by'])?></h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div>
                            <p class="label text-muted ">CREATED AT </p>
                            <h4 class="fw-medium"><?php echo htmlspecialchars($projectInfo['created_at'])?></h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div>
                            <p class="label text-muted ">UPDATED AT </p>
                            <h4 class="fw-medium"><?php echo htmlspecialchars($projectInfo['updated_at'])?></h4>
                        </div>
                    </div>


                </div>

                <div class="m-4">
                    <p class="label text-muted">DESCRIPTION</p>
                    <div class="border rounded-3 p-3 m-3"><?php echo nl2br(htmlspecialchars($projectInfo["description"])) ?></div>
                </div>
            </div>

        </div>
    </div>


</body>
</html>

