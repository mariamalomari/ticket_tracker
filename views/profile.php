<?php 
$pageTitle = "Profile";
$activePage = "dashboard"; //for sidebar
require_once 'partials/header.php';
require_once 'partials/navbar.php'; 
?>


    <div class="main-body">
        <!--sidebar-->
        <?php require_once 'partials/sidebar.php'; ?>
        <div class="main-content">
            <div class="card p-5 m-5 border shadow">
                <h2>Email: </h2>
                <p>
                    <?php echo htmlspecialchars($user_email) ?>
                </p>
            </div>
        </div>
    </div>


</body>
</html>

