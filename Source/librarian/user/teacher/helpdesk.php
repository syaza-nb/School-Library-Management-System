<?php
session_start();
if (!isset($_SESSION["teacher"])) {
    echo '<script type="text/javascript">window.location="login.php";</script>';
    exit();
}

$page = 'helpdesk';
include 'inc/connection.php';
include 'inc/header.php';

$successMessage = "";

// Handle form submission
if (isset($_POST['submit'])) {
    $username = $_SESSION['teacher'];
    $subject = mysqli_real_escape_string($link, $_POST['subject']);
    $message = mysqli_real_escape_string($link, $_POST['message']);

    mysqli_query($link, "INSERT INTO helpdesk_tickets (username, subject, message) VALUES ('$username', '$subject', '$message')");
    $successMessage = "<div class='alert alert-success'>Ticket submitted successfully.</div>";
}
?>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Target all links that are meant to toggle submenus
    const toggles = document.querySelectorAll(".sidebar-menu ul li > a");

    toggles.forEach(function (toggle) {
        toggle.addEventListener("click", function (e) {
            // Prevent default link behavior if submenu exists
            const submenu = this.parentElement.querySelector("ul");s
            if (submenu) {
                e.preventDefault();
                submenu.style.display = submenu.style.display === "block" ? "none" : "block";
            }
        });
    });
});
</script>
<!--dashboard area-->
<div class="dashboard-content">
    <div class="dashboard-header">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="left">
                        <p><span>dashboard</span>Teacher panel</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right text-right">
                        <a href="dashboard.php"><i class="fas fa-home"></i>home</a>
                        <span class="disabled">helpdesk</span>
                    </div>
                </div>
            </div>

            <!-- Ticket Submission Form -->
            <div class="card-body" style="max-height: 550px; overflow-y: auto;">
            <div class="card shadow-sm rounded mb-4">
                <div class="card-header bg-success text-white">
                    <strong>Submit a Ticket</strong>
                </div>
                <div class="card-body">
                    <?php if (!empty($successMessage)) echo $successMessage; ?>

                    <form method="post">
                        <div class="form-group">
                            <label for="subject"><strong>Subject</strong> <span class="text-danger">*</span></label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter ticket subject" required>
                        </div>
                        <div class="form-group">
                            <label for="message"><strong>Message</strong> <span class="text-danger">*</span></label>
                            <textarea name="message" id="message" class="form-control" rows="4" placeholder="Describe your issue" required></textarea>
                        </div>
                        <div class="text-right">
                            <button type="submit" name="submit" class="btn btn-success px-4">
                                <i class="fas fa-paper-plane"></i> Submit Ticket
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Ticket History -->
            <div class="card shadow-sm rounded">
                <div class="card-header bg-info text-white">
                    <strong>Your Previous Tickets</strong>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Status</th>
                                <th>Response</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $res = mysqli_query($link, "SELECT * FROM helpdesk_tickets WHERE username = '{$_SESSION['teacher']}' ORDER BY id DESC");
                        if (mysqli_num_rows($res) > 0) {
                            while ($row = mysqli_fetch_assoc($res)) {
                                $statusBadge = $row['status'] === 'Resolved'
                                    ? "<span class='badge badge-success'>Resolved</span>"
                                    : "<span class='badge badge-warning'>Pending</span>";
                                $response = !empty($row['response'])
                                    ? nl2br(htmlentities($row['response']))
                                    : "<em class='text-muted'>Awaiting response</em>";
                                echo "<tr>
                                    <td>" . htmlentities($row['subject']) . "</td>
                                    <td>" . htmlentities($row['message']) . "</td>
                                    <td>{$statusBadge}</td>
                                    <td>{$response}</td>
                                    <td>" . date("d M Y, h:i A", strtotime($row['created_at'])) . "</td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center text-muted'>No tickets submitted yet.</td></tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        </div>
    </div>
</div>

<!-- <?php include 'inc/footer.php'; ?> -->
