<?php 
session_start();
if (!isset($_SESSION["student"])) {
    echo "<script>window.location='login.php';</script>";
    exit();
}

$page = 'rbook';
include 'inc/header.php';
include 'inc/connection.php';

// Fetch user info
$userQuery = mysqli_query($link, "SELECT * FROM std_registration WHERE username = '{$_SESSION['student']}'");
$userData = mysqli_fetch_assoc($userQuery);

$name = $userData['name'];
$username = $userData['username'];
$email = $userData['email'];
$utype = $userData['utype'];

$message = "";

// Form handling
if (isset($_POST["submit"])) {
    $bname = trim($_POST['bname']);
    $burl = trim($_POST['burl']);

    if ($bname === "" || $burl === "") {
        $message = "<div class='alert alert-danger'><strong>Error:</strong> All fields are required.</div>";
    } else {
        $stmt = $link->prepare("INSERT INTO request_books VALUES (NULL, ?, ?, ?, ?, ?, ?, 'no')");
        $stmt->bind_param("ssssss", $name, $username, $email, $utype, $bname, $burl);
        if ($stmt->execute()) {
            $message = "<div class='alert alert-success'><strong>Success:</strong> Book request submitted.</div>";
        } else {
            $message = "<div class='alert alert-danger'><strong>Error:</strong> Could not submit your request.</div>";
        }
        $stmt->close();
    }
}
?>

<!--dashboard area-->
<div class="dashboard-content">
    <div class="dashboard-header">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="left">
                        <p><span>dashboard</span>User panel</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right text-right">
                        <a href="dashboard.php"><i class="fas fa-home"></i>home</a>
                        <span class="disabled">request book</span>
                    </div>
                </div>
            </div>

        <!-- Form Card -->
        <div class="card shadow-sm">
            <div class="card-body">
                <?= $message ?>

                <form action="" method="POST">
                    <div class="form-group">
                        <label>Your Name</label>
                        <input type="text" class="form-control" value="<?= htmlspecialchars($name) ?>" disabled>
                    </div>

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" value="<?= htmlspecialchars($username) ?>" disabled>
                    </div>

                    <div class="form-group">
                        <label>User Type</label>
                        <input type="text" class="form-control" value="<?= htmlspecialchars($utype) ?>" disabled>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" value="<?= htmlspecialchars($email) ?>" disabled>
                    </div>

                    <div class="form-group">
                        <label>Book Name</label>
                        <input type="text" class="form-control" name="bname" placeholder="Enter book name" required>
                    </div>

                    <div class="form-group">
                        <label>Book URL</label>
                        <input type="url" class="form-control" name="burl" placeholder="Enter book source URL" required>
                    </div>

                    <button type="submit" name="submit" class="btn btn-success">
                        <i class="fas fa-paper-plane"></i> Send Request
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- <?php include 'inc/footer.php'; ?> -->
