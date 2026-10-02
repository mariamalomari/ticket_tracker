<?php 
$pageTitle = "Dashboard";
$activePage = "dashboard"; //for sidebar
require_once 'partials/header.php';
require_once 'partials/navbar.php'; 
?>


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



    <div class="main-body">
        <!--sidebar-->
        <?php require_once 'partials/sidebar.php'; ?>

        <div class="main-content">
            <div class="card p-5 m-5 border shadow">
                <div class="row text-center">
                    <div class="col-md-4">
                        <div>
                            <h2 class="number fw-bold"><?php echo htmlspecialchars($openTicketsNumber ?? 0) ?></h2>
                            <p class="label">OPEN TICKETS</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div>
                            <h2 class="number fw-bold"><?php echo htmlspecialchars($myTicketsNumber ?? 0)?></h2>
                            <p class="label">MY ACTIVE TICKETS</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div>
                            <h2 class="number fw-bold"><?php echo htmlspecialchars($highPriorityTicketsNumber ?? 0) ?></h2>
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
                    <div class="alert alert-<?php echo htmlspecialchars($color) ?>"><?php echo htmlspecialchars($messageOutput) ?></div>
                <?php endif; ?>
                <form action="../public/dashboard.php" method="POST" id="ticketCreationForm">
                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'] ?? ''); ?>">
                    <label class="form-label">Project: </label>
                    <select name="project_id" class="form-select" required>
                        <?php 
                            foreach ($allProjectNames as $project):
                        ?>
                        <option value="<?php echo htmlspecialchars($project['id'])?>"><?php echo htmlspecialchars($project['name'])?></option>
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

