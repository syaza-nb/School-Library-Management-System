<?php 
    session_start();
    if (!isset($_SESSION["username"])) {
        echo "<script>window.location='login.php';</script>";
    }
    include 'inc/header.php';
    include 'inc/connection.php';
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
                            <span class="disabled">Send to teacher</span>
                        </div>
                    </div>
                </div>

        <!-- Centered Card -->
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-lg border-info">
                    <div class="card-header bg-info text-white text-center">
                        <h5 class="mb-0">🧑‍🏫 Send Message to Teacher</h5>
                    </div>
                    <div class="card-body bg-light">

                        <?php
                            date_default_timezone_set("Asia/Dhaka");
                            $time = date("Y-m-d h:i:sa");

                            if (isset($_POST["submit"])) {
                                $title = $_POST["title"];
                                $msg = $_POST["msg"];
                                $rusername = $_POST["rusername"];

                                if ($title == "" || $msg == "") {
                                    echo "<div class='alert alert-danger'>❌ <strong>Error:</strong> Fields must not be empty.</div>";
                                } else {
                                    $sql = mysqli_query($link, "INSERT INTO message VALUES('', '$_SESSION[username]', '$rusername', '$title', '$msg', 'n', '$time')");
                                    if ($sql) {
                                        echo "<div class='alert alert-success'>✅ <strong>Success:</strong> Message sent successfully.</div>";
                                    } else {
                                        echo "<div class='alert alert-warning'>⚠️ <strong>Warning:</strong> Message could not be sent.</div>";
                                    }
                                }
                            }
                        ?>

                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label><strong class="text-info">Send To</strong></label>
                                <select name="rusername" class="form-control border-info">
                                    <?php 
                                        $res = mysqli_query($link, "SELECT * FROM t_registration");
                                        while ($row = mysqli_fetch_array($res)) {
                                            echo "<option value='{$row["username"]}'>{$row["username"]} ({$row["idno"]})</option>";
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label><strong class="text-info">Title</strong></label>
                                <input type="text" name="title" class="form-control border-info" placeholder="Enter message title">
                            </div>

                            <div class="form-group">
                                <label><strong class="text-info">Message</strong></label>
                                <textarea name="msg" class="form-control border-info" placeholder="Write your message..." rows="4"></textarea>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" name="submit" class="btn btn-gradient px-4 py-2 font-weight-bold" style="background: #00bcd4; color: white;">📩 Send Message</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center text-muted small">
                        This message will be sent to the selected teacher securely.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>
<?php include 'inc/footer.php'; ?>
