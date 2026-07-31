<?php
session_start();
if (!isset($_SESSION["username"])) {
    echo "<script>window.location='login.php';</script>";
}
$page = 'helpdesk';
include 'inc/connection.php';

// Handle admin response
$response_msg = '';
if (isset($_POST['respond'])) {
    $ticket_id = $_POST['ticket_id'];
    $response = mysqli_real_escape_string($link, $_POST['response']);
    $status = $_POST['status'];

    if (mysqli_query($link, "UPDATE helpdesk_tickets SET response='$response', status='$status' WHERE id=$ticket_id")) {
        $response_msg = "<div class='alert alert-success'>✅ Response submitted successfully.</div>";
    } else {
        $response_msg = "<div class='alert alert-danger'>❌ Error submitting response.</div>";
    }
}

include 'inc/header.php';
?>

<!--dashboard area-->
    <div class="dashboard-content">
        <div class="dashboard-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="left">
                            <p><span>dashboard</span>Control panel</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="right text-right">
                            <a href="dashboard.php"><i class="fas fa-home"></i>home</a>
                            <span class="disabled">Helpdesk</span>
                        </div>
                    </div>
                </div>

            <?= $response_msg ?>

            <div class="card shadow-sm border-0">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">🎫 Admin - Help Desk Tickets</h5>
                </div>
                <div class="card-body" style="overflow-x: auto; max-height: 600px;">
                    <table class="table table-hover table-bordered table-striped small">
                        <thead class="thead-light">
                            <tr>
                                <th>Student</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Status</th>
                                <th>Response</th>
                                <th style="min-width: 220px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $res = mysqli_query($link, "SELECT * FROM helpdesk_tickets ORDER BY id DESC");
                        if (mysqli_num_rows($res) == 0) {
                            echo "<tr><td colspan='6' class='text-center text-muted'>No tickets found.</td></tr>";
                        }
                        while ($row = mysqli_fetch_assoc($res)) {
                        ?>
                            <tr>
                                <td><?= htmlspecialchars($row['username']) ?></td>
                                <td><?= htmlspecialchars($row['subject']) ?></td>
                                <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
                                <td>
                                    <span class="badge badge-<?= $row['status'] == 'Closed' ? 'success' : 'warning' ?>">
                                        <?= $row['status'] ?>
                                    </span>
                                </td>
                                <td><?= $row['response'] ? nl2br(htmlspecialchars($row['response'])) : '<em class="text-muted">Pending</em>' ?></td>
                                <td>
                                    <form method="post">
                                        <input type="hidden" name="ticket_id" value="<?= $row['id'] ?>">
                                        <textarea name="response" class="form-control form-control-sm mb-2" rows="2" placeholder="Type your response..."><?= htmlspecialchars($row['response'] ?? '') ?></textarea>
                                        <select name="status" class="form-control form-control-sm mb-2">
                                            <option value="Open" <?= $row['status'] == 'Open' ? 'selected' : '' ?>>Open</option>
                                            <option value="Closed" <?= $row['status'] == 'Closed' ? 'selected' : '' ?>>Closed</option>
                                        </select>
                                        <button type="submit" name="respond" class="btn btn-sm btn-success">Submit</button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-muted text-center small">
                    Showing the latest helpdesk submissions from students.
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>
