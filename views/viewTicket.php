<?php 
$pageTitle = "View Tickets";
$activePage = "myTickets"; //for sidebar
require_once 'partials/header.php';
require_once 'partials/navbar.php'; 
?>


    <div class="main-body">
        <!--sidebar-->
        <?php require_once 'partials/sidebar.php'; ?>
        <div class="main-content">
            <br>
            <a href="../public/allTickets.php" class="btn btn-info bi-arrow-return-left"> Back</a>
            <br><br>
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
                            <h4 class="number fw-medium"><?php echo htmlspecialchars($ticketInfo['project_name'])?></h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div>
                            <p class="label text-muted">CATEGORY </p>
                            <h4 class="fw-medium"><?php echo htmlspecialchars($ticketInfo['category'])?></h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div>
                            <p class="label text-muted">CREATED BY </p>
                            <h4 class="fw-medium"><?php echo htmlspecialchars($ticketInfo['created_by'])?></h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div>
                            <p class="label text-muted ">CREATED AT </p>
                            <h4 class="fw-medium"><?php echo htmlspecialchars($ticketInfo['created_at'])?></h4>
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

