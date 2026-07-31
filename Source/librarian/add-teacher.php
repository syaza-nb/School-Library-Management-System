<?php
session_start();
if (!isset($_SESSION["username"])) {
    echo "<script>window.location='login.php';</script>";
}

include 'inc/header.php';
include 'inc/connection.php';
include 'inc/tfunction.php';
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
                            <span class="disabled">Add teacher</span>
                        </div>
                    </div>
                </div>

        <div class="card shadow-lg rounded p-4 bg-white">
            <h4 class="text-center text-dark mb-4">Teacher Registration Form</h4>

            <?php if (isset($error_m)) echo "<div class='alert alert-danger'>$error_m</div>"; ?>

            <form method="post">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label><strong>Name</strong> <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" placeholder="Full Name">
                    </div>
                    <div class="form-group col-md-6">
                        <label><strong>Username</strong> <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="username" placeholder="Username">
                        <?php if (isset($error_ua)) echo "<small class='text-danger'>$error_ua</small>"; ?>
                        <?php if (isset($error_uname)) echo "<small class='text-danger'>$error_uname</small>"; ?>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label><strong>Password</strong> <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <div class="form-group col-md-6">
                        <label><strong>Lecturer / Dept</strong> <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="lecturer" placeholder="e.g. Computer Science">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label><strong>Email</strong> <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" placeholder="Email">
                        <?php if (isset($e_msg)) echo "<small class='text-danger'>$e_msg</small>"; ?>
                        <?php if (isset($error_email)) echo "<small class='text-danger'>$error_email</small>"; ?>
                    </div>
                    <div class="form-group col-md-6">
                        <label><strong>Phone No</strong> <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="phone" placeholder="Phone Number">
                        <?php if (isset($error_phone)) echo "<small class='text-danger'>$error_phone</small>"; ?>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label><strong>ID No</strong> <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="idno" placeholder="ID Number">
                        <?php if (isset($error_id)) echo "<small class='text-danger'>$error_id</small>"; ?>
                    </div>
                    <div class="form-group col-md-6">
                        <label><strong>Address</strong> <span class="text-danger">*</span></label>
                        <textarea name="address" class="form-control" rows="2" placeholder="Your Address"></textarea>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" name="submit" class="btn btn-success px-5 py-2">
                        <i class="fas fa-user-plus"></i> Register Teacher
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="gap-40"></div>

<?php include 'inc/footer.php'; ?>
