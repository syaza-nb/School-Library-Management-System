<?php
session_start();
if (!isset($_SESSION["username"])) {
    echo '<script type="text/javascript">window.location="login.php";</script>';
    exit();
}
include 'inc/header.php';
include 'inc/connection.php';
include 'inc/function.php';
?>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const toggles = document.querySelectorAll(".sidebar-menu ul li > a");
    toggles.forEach(function (toggle) {
        toggle.addEventListener("click", function (e) {
            const submenu = this.parentElement.querySelector("ul");
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
                            <p><span>dashboard</span>Control panel</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="right text-right">
                            <a href="dashboard.php"><i class="fas fa-home"></i>home</a>
                            <span class="disabled">Add student</span>
                        </div>
                    </div>
                </div>

        <div class="card shadow-lg rounded p-4 bg-white">
            <h4 class="text-center text-dark mb-4">Student Registration Form</h4>

            <!-- Feedback Messages -->
            <?php if (isset($s_msg)) echo '<div class="alert alert-success">'.$s_msg.'</div>'; ?>
            <?php if (isset($error_m)) echo '<div class="alert alert-danger">'.$error_m.'</div>'; ?>

            <form method="post" action="">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name"><strong>Name</strong> <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="username"><strong>Username</strong> <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" />
                        <?php
                            if (isset($error_ua)) echo "<small class='text-danger'>{$error_ua}</small>";
                            if (isset($error_uname)) echo "<small class='text-danger'>{$error_uname}</small>";
                        ?>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="password"><strong>Password</strong> <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email"><strong>Email</strong> <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" />
                        <?php
                            if (isset($e_msg)) echo "<small class='text-danger'>{$e_msg}</small>";
                            if (isset($error_email)) echo "<small class='text-danger'>{$error_email}</small>";
                        ?>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="phone"><strong>Phone No</strong> <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone No" />
                        <?php if (isset($error_phone)) echo "<small class='text-danger'>{$error_phone}</small>"; ?>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="address"><strong>Address</strong> <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="address" name="address" placeholder="Your address" rows="2"></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="sem"><strong>Semester</strong> <span class="text-danger">*</span></label>
                        <select class="form-control" id="sem" name="sem">
                            <option disabled selected>Select semester</option>
                            <option>1st</option>
                            <option>2nd</option>
                            <option>3rd</option>
                            <option>4th</option>
                            <option>5th</option>
                            <option>6th</option>
                            <option>7th</option>
                            <option>8th</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="dept"><strong>Department</strong> <span class="text-danger">*</span></label>
                        <select class="form-control" id="dept" name="dept">
                            <option disabled selected>Select department</option>
                            <option>CSE</option>
                            <option>EEE</option>
                            <option>ECE</option>
                            <option>BBA</option>
                            <option>Others</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="session"><strong>Session</strong> <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="session" name="session" placeholder="14/15" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="regno"><strong>Registration No</strong> <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="regno" name="regno" placeholder="Registration No" />
                    <?php if (isset($error_reg)) echo "<small class='text-danger'>{$error_reg}</small>"; ?>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" name="submit" class="btn btn-success px-5 py-2">
                        <i class="fas fa-user-plus"></i> Add Student
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="gap-40"></div>

<!-- <?php include 'inc/footer.php'; ?> -->
