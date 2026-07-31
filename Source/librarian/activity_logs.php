<?php
session_start();
if (!isset($_SESSION["username"])) {
    echo "<script>window.location='login.php';</script>";
    exit();
}

$page = 'activity_logs';
include 'inc/header.php';
include 'inc/connection.php';
?>

<style>
    .activity-container {
        padding: 20px;
    }

    .activity-title {
        margin-bottom: 20px;
    }

    .activity-title h2 {
        font-weight: bold;
        color: #333;
    }

    .filter-box {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .table-box {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    table {
        width: 100%;
    }

    table th {
        background: #03A9F4;
        color: white;
        padding: 12px;
        text-align: center;
    }

    table td {
        padding: 10px;
        text-align: center;
        vertical-align: middle;
    }

    .badge-login {
        background: #4CAF50;
        color: white;
        padding: 5px 10px;
        border-radius: 20px;
    }

    .badge-borrow {
        background: #FF9800;
        color: white;
        padding: 5px 10px;
        border-radius: 20px;
    }

    .badge-return {
        background: #2196F3;
        color: white;
        padding: 5px 10px;
        border-radius: 20px;
    }

    .badge-report {
        background: #9C27B0;
        color: white;
        padding: 5px 10px;
        border-radius: 20px;
    }

    .btn-filter {
        background: #03A9F4;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
    }

    .btn-filter:hover {
        background: #0288D1;
    }
</style>

<div class="activity-container">

    <div class="activity-title">
        <h2><i class="fas fa-history"></i> Activity Logs</h2>
    </div>

    <!-- Filter Section -->
    <div class="filter-box">
        <form method="GET">

            <div class="row">

                <div class="col-md-3">
                    <label>User</label>
                    <input type="text" name="user" class="form-control" placeholder="Search user">
                </div>

                <div class="col-md-3">
                    <label>Action</label>
                    <select name="action" class="form-control">
                        <option value="">All Actions</option>
                        <option value="LOGIN">Login</option>
                        <option value="BORROW_BOOK">Borrow Book</option>
                        <option value="RETURN_BOOK">Return Book</option>
                        <option value="GENERATE_REPORT">Generate Report</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Date</label>
                    <input type="date" name="date" class="form-control">
                </div>

                <div class="col-md-3">
                    <label>&nbsp;</label><br>
                    <button type="submit" class="btn-filter">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </div>

            </div>

        </form>
    </div>

    <!-- Activity Table -->
    <div class="table-box">

        <table class="table table-bordered table-hover">

            <thead>
                <tr>
                    <th>No.</th>
                    <th>Date & Time</th>
                    <th>User</th>
                    <th>Role</th>
                    <th>Action</th>
                    <th>Description</th>
                    <th>IP Address</th>
                </tr>
            </thead>

            <tbody>

                <?php
                $res = mysqli_query($link, "SELECT * FROM activity_logs ORDER BY id DESC");

                $count = 1;

                while($row = mysqli_fetch_assoc($res))
                {
                ?>

                <tr>

                    <td><?php echo $count; ?></td>

                    <td>
                        <?php echo $row['activity_time']; ?>
                    </td>

                    <td>
                        <?php echo $row['username']; ?>
                    </td>

                    <td>
                        <?php echo $row['role']; ?>
                    </td>

                    <td>

                        <?php
                        if($row['action'] == "LOGIN")
                        {
                            echo "<span class='badge-login'>LOGIN</span>";
                        }
                        elseif($row['action'] == "BORROW_BOOK")
                        {
                            echo "<span class='badge-borrow'>BORROW BOOK</span>";
                        }
                        elseif($row['action'] == "RETURN_BOOK")
                        {
                            echo "<span class='badge-return'>RETURN BOOK</span>";
                        }
                        else
                        {
                            echo "<span class='badge-report'>REPORT</span>";
                        }
                        ?>

                    </td>

                    <td>
                        <?php echo $row['description']; ?>
                    </td>

                    <td>
                        <?php echo $row['ip_address']; ?>
                    </td>

                </tr>

                <?php
                    $count++;
                }
                ?>

            </tbody>

        </table>

    </div>

</div>

<?php include 'inc/footer.php'; ?>
```
