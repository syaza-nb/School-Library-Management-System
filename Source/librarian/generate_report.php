<?php
session_start();

if (!isset($_SESSION["username"])) {
    echo "<script>window.location='login.php';</script>";
    exit();
}

$page = 'reports';
include 'inc/connection.php';
include 'log_activity.php';

logActivity($link, 'VIEW_REPORT_PAGE', 'Visited Generate Report Page');

?>
<?php

if(isset($_GET['export']) && $_GET['export'] == "excel")
{
    include 'inc/connection.php';

    $type = $_GET['report_type'];

    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=".$type."_report.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    // BOOK REPORT
    if($type == "books")
    {
        echo "
        <table border='1'>
            <tr>
                <th>Book Name</th>
                <th>Author</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Availability</th>

            </tr>
        ";

        $res = mysqli_query($link,"SELECT * FROM add_book");

        while($row = mysqli_fetch_assoc($res))
        {
            echo "
            <tr>
                <td>".$row['books_name']."</td>
                <td>".$row['books_author_name']."</td>
                <td>".$row['books_category']."</td>
                <td>".$row['books_quantity']."</td>
                <td>".$row['books_availability']."</td>
            </tr>
            ";
        }

        echo "</table>";
    }

    // ISSUED BOOK REPORT
    elseif($type == "issued")
    {
        echo "
        <table border='1'>
            <tr>
                <th>Username</th>
                <th>Book</th>
                <th>Issue Date</th>
                <th>Return Date</th>
            </tr>
        ";

        $res = mysqli_query($link,"SELECT * FROM issue_book");

        while($row = mysqli_fetch_assoc($res))
        {
            echo "
            <tr>
                <td>".$row['username']."</td>
                <td>".$row['booksname']."</td>
                <td>".$row['booksissuedate']."</td>
                <td>".$row['return_date']."</td>
            </tr>
            ";
        }

        echo "</table>";
    }

    // FINE REPORT
    elseif($type == "fine")
    {
        echo "
        <table border='1'>
            <tr>
                <th>Username</th>
                <th>Book</th>
                <th>Fine</th>
            </tr>
        ";

        $res = mysqli_query($link,"SELECT * FROM finezone");

        while($row = mysqli_fetch_assoc($res))
        {
            echo "
            <tr>
                <td>".$row['username']."</td>
                <td>".$row['booksname']."</td>
                <td>".$row['fine']."</td>
            </tr>
            ";
        }

        echo "</table>";
    }

    // ACTIVITY LOG REPORT
    elseif($type == "activity")
    {
        echo "
        <table border='1'>
            <tr>
                <th>User</th>
                <th>Action</th>
                <th>Description</th>
                <th>Date</th>
            </tr>
        ";

        $res = mysqli_query($link,"SELECT * FROM activity_logs");

        while($row = mysqli_fetch_assoc($res))
        {
            echo "
            <tr>
                <td>".$row['username']."</td>
                <td>".$row['action']."</td>
                <td>".$row['description']."</td>
                <td>".$row['activity_time']."</td>
            </tr>
            ";
        }

        echo "</table>";
    }

    exit();
}
include 'inc/header.php';


?>

<style>

.report-container{
    padding:20px;
}

.report-title{
    margin-bottom:25px;
}

.report-title h2{
    font-weight:bold;
    color:#333;
}

.report-card-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
    margin-bottom:30px;
}

.report-card{
    padding:25px;
    border-radius:12px;
    color:white;
    text-align:center;
    box-shadow:0 3px 10px rgba(0,0,0,0.1);
}

.card-blue{
    background:#03A9F4;
}

.card-green{
    background:#4CAF50;
}

.card-red{
    background:#F44336;
}

.card-orange{
    background:#FF9800;
}

.report-card i{
    font-size:35px;
    margin-bottom:10px;
}

.report-card h3{
    font-size:30px;
}

.report-box{
    background:white;
    padding:25px;
    border-radius:12px;
    box-shadow:0 2px 10px rgba(0,0,0,0.1);
    margin-bottom:30px;
}

.btn-generate{
    background:#073f5f;
    color:white;
    border:none;
    padding:10px 20px;
    border-radius:5px;
}

.btn-generate:hover{
    background:#0b5c87;
}

.table th{
    background:#073f5f;
    color:white;
}

</style>

<div class="report-container">

    <div class="report-title">
        <h2><i class="fas fa-chart-bar"></i> Generate Reports</h2>
    </div>

    <!-- SUMMARY CARDS -->

    <div class="report-card-grid">

        <div class="report-card card-blue">
            <i class="fas fa-book"></i>

            <?php
            $book = mysqli_num_rows(mysqli_query($link,"SELECT * FROM add_book"));
            ?>

            <h3><?php echo $book; ?></h3>
            <p>Total Books</p>
        </div>

        <div class="report-card card-green">
            <i class="fas fa-users"></i>

            <?php
            $student = mysqli_num_rows(mysqli_query($link,"SELECT * FROM std_registration"));
            ?>

            <h3><?php echo $student; ?></h3>
            <p>Total Students</p>
        </div>

        <div class="report-card card-red">
            <i class="fas fa-exchange-alt"></i>

            <?php
            $issue = mysqli_num_rows(mysqli_query($link,"SELECT * FROM issue_book"));
            ?>

            <h3><?php echo $issue; ?></h3>
            <p>Issued Books</p>
        </div>

        <div class="report-card card-orange">
            <i class="fas fa-dollar-sign"></i>

            <?php
            $fine = mysqli_query($link,"SELECT SUM(fine) as totalFine FROM finezone");
            $fineRow = mysqli_fetch_assoc($fine);
            ?>

            <h3>RM <?php echo $fineRow['totalFine'] ?? 0; ?></h3>
            <p>Total Fine</p>
        </div>

    </div>

    <!-- REPORT GENERATOR -->

    <div class="report-box">

        <h4><i class="fas fa-file-alt"></i> Generate Custom Report</h4>
        <hr>

        <form method="GET">

            <div class="row">

                <div class="col-md-4">
                    <label>Report Type</label>

                    <select name="report_type" class="form-control" required>
                        <option value="">Select Report</option>
                        <option value="books">Books Report</option>
                        <option value="issued">Issued Books Report</option>
                        <option value="fine">Fine Report</option>
                        <option value="activity">Activity Logs Report</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label>From Date</label>
                    <input type="date" name="from" class="form-control">
                </div>

                <div class="col-md-3">
                    <label>To Date</label>
                    <input type="date" name="to" class="form-control">
                </div>

                <div class="col-md-2">
                    <label>&nbsp;</label><br>

                    <button type="submit" class="btn-generate">
                        Generate
                    </button>
                </div>

            </div>

        </form>

    </div>

    <!-- REPORT RESULT -->

    <div class="report-box">

        <div class="d-flex justify-content-between align-items-center">
            <h4><i class="fas fa-table"></i> Report Result</h4>

            <div>
                <button onclick="window.print()" class="btn btn-primary">
                    <i class="fas fa-print"></i> Print
                </button>

                <?php if(isset($_GET['report_type'])) { ?>

                    <a href="?report_type=<?php echo $_GET['report_type']; ?>&export=excel"
                     class="btn btn-success">

                     <i class="fas fa-file-excel"></i> Export Excel
                 </a>

             <?php } ?>

         </div>

     </div>

        <hr>

        <?php

        if(isset($_GET['report_type']))
        {
            $type = $_GET['report_type'];

            // LOG ACTIVITY
            logActivity(
                $link,
                'GENERATE_REPORT',
                'Generated '.$type.' report'
            );

            // BOOK REPORT
            if($type == "books")
            {
                $res = mysqli_query($link,"SELECT * FROM add_book");

                echo "
                <table class='table table-bordered table-hover'>
                    <tr>
                        <th>Book Name</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Availability</th>
                    </tr>
                ";

                while($row = mysqli_fetch_assoc($res))
                {
                    echo "
                    <tr>
                        <td>".$row['books_name']."</td>
                        <td>".$row['books_author_name']."</td>
                        <td>".$row['books_category']."</td>
                        <td>".$row['books_quantity']."</td>
                        <td>".$row['books_availability']."</td>
                    </tr>
                    ";
                }

                echo "</table>";
            }

            // ISSUED REPORT
            elseif($type == "issued")
            {
                $res = mysqli_query($link,"SELECT * FROM issue_book");

                echo "
                <table class='table table-bordered table-hover'>
                    <tr>
                        <th>Student</th>
                        <th>Book</th>
                        <th>Issue Date</th>
                        <th>Return Date</th>
                    </tr>
                ";

                while($row = mysqli_fetch_assoc($res))
                {
                    echo "
                    <tr>
                        <td>".$row['username']."</td>
                        <td>".$row['booksname']."</td>
                        <td>".$row['booksissuedate']."</td>
                        <td>".$row['return_date']."</td>
                    </tr>
                    ";
                }

                echo "</table>";
            }

            // FINE REPORT
            elseif($type == "fine")
            {
                $res = mysqli_query($link,"SELECT * FROM finezone");

                echo "
                <table class='table table-bordered table-hover'>
                    <tr>
                        <th>User</th>
                        <th>Book</th>
                        <th>Fine</th>
                    </tr>
                ";

                while($row = mysqli_fetch_assoc($res))
                {
                    echo "
                    <tr>
                        <td>".$row['username']."</td>
                        <td>".$row['booksname']."</td>
                        <td>RM ".$row['fine']."</td>
                    </tr>
                    ";
                }

                echo "</table>";
            }

            // ACTIVITY LOG REPORT
            elseif($type == "activity")
            {
                $res = mysqli_query($link,"SELECT * FROM activity_logs ORDER BY id DESC");

                echo "
                <table class='table table-bordered table-hover'>
                    <tr>
                        <th>User</th>
                        <th>Action</th>
                        <th>Description</th>
                        <th>Date</th>
                    </tr>
                ";

                while($row = mysqli_fetch_assoc($res))
                {
                    echo "
                    <tr>
                        <td>".$row['username']."</td>
                        <td>".$row['action']."</td>
                        <td>".$row['description']."</td>
                        <td>".$row['activity_time']."</td>
                    </tr>
                    ";
                }

                echo "</table>";
            }
        }

        ?>

    </div>

</div>

<?php include 'inc/footer.php'; ?>

