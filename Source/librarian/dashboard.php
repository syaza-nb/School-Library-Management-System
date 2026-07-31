<?php 
session_start();
if (!isset($_SESSION["username"])) {
    echo "<script>window.location='login.php';</script>";
    exit();
}
$page = 'home';
include 'inc/header.php';
include 'inc/connection.php';
?>

<!-- Dashboard Content -->
<style>
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        margin-top: 30px;
    }

    .dashboard-box {
        padding: 30px 20px;
        color: white;
        border-radius: 12px;
        text-align: center;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .dashboard-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.15);
    }

    .box {
        background-color: #03A9F4;
    }

    .box2 {
        background-color: #4CAF50;
    }

    .box3 {
        background-color: #F44336;
    }

    .box4 {
        background-color: #FFA000;
    }

    .dashboard-box .icon {
        font-size: 40px;
        margin-bottom: 10px;
    }

    .dashboard-box h3 {
        font-size: 28px;
        margin-bottom: 5px;
    }

    .dashboard-box h4 a {
        color: white;
        text-decoration: none;
        font-size: 18px;
    }

    .dashboard-box h4 a:hover {
        text-decoration: underline;
    }
</style>

<div class="dashboard-content">
    <div class="dashboard-header">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="left">
                        <p><span>Dashboard</span> Control panel</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right text-right">
                        <a href="dashboard.php"><i class="fas fa-home"></i> Home</a>
                        <span class="disabled"> Dashboard</span>
                    </div>
                </div>
            </div>

            <div class="dashboard-grid">
                <?php
                // Box data
                $boxes = [
                    [
                        'icon' => 'fa fa-users',
                        'count' => mysqli_num_rows(mysqli_query($link, "SELECT * FROM std_registration")) 
                                 + mysqli_num_rows(mysqli_query($link, "SELECT * FROM t_registration")),
                        'label' => 'Members',
                        'link' => 'all_user.php',
                        'box_class' => 'box'
                    ],
                    [
                        'icon' => 'fa fa-rocket',
                        'count' => mysqli_num_rows(mysqli_query($link, "SELECT * FROM issue_book")) 
                                 + mysqli_num_rows(mysqli_query($link, "SELECT * FROM t_issuebook")),
                        'label' => 'Issued Books',
                        'link' => 'issued-books.php',
                        'box_class' => 'box2'
                    ],
                    [
                        'icon' => 'fa fa-book',
                        'count' => mysqli_num_rows(mysqli_query($link, "SELECT * FROM add_book")),
                        'label' => 'Books',
                        'link' => 'display-books.php',
                        'box_class' => 'box3'
                    ],
                    [
                        'icon' => 'fas fa-dollar-sign',
                        'count' => mysqli_num_rows(mysqli_query($link, "SELECT fine FROM finezone")) * 50,
                        'label' => 'Fine',
                        'link' => 'fine.php',
                        'box_class' => 'box4'
                    ],
                    [
                        'icon' => 'fas fa-book',
                        'label' => 'Manage Book',
                        'link' => 'display-books.php',
                        'box_class' => 'box3',
                        'count' => null
                    ],
                    [
                        'icon' => 'fas fa-user',
                        'label' => 'Manage User',
                        'link' => 'add-student.php',
                        'box_class' => 'box4',
                        'count' => null
                    ],
                    [
                        'icon' => 'fab fa-staylinked',
                        'label' => 'Status',
                        'link' => 'status.php',
                        'box_class' => 'box',
                        'count' => null
                    ],
                    [
                        'icon' => 'fas fa-book',
                        'label' => 'Requested Books',
                        'link' => 'requested-books.php',
                        'box_class' => 'box2',
                        'count' => null
                    ],
                    [
                        'icon' => 'fas fa-info',
                        'label' => 'Helpdesk',
                        'link' => 'admin_helpdesk.php',
                        'box_class' => 'box4',
                        'count' => null
                    ],
                    [
                        'icon' => 'fas fa-history',
                        'label' => 'Activity Logs',
                        'link' => 'activity_logs.php',
                        'box_class' => 'box',
                        'count' => null
                    ],
                    [
                        'icon' => 'fas fa-chart-bar',
                        'label' => 'Generate Reports',
                        'link' => 'generate_report.php',
                        'box_class' => 'box2',
                        'count' => null
                    ],

                ];

                foreach ($boxes as $box) {
                ?>
                    <div class="dashboard-box <?php echo $box['box_class']; ?>">
                        <div class="icon"><i class="<?php echo $box['icon']; ?>"></i></div>
                        <?php if (!is_null($box['count'])) { ?>
                            <h3><span class="counter"><?php echo $box['count']; ?></span></h3>
                        <?php } ?>
                        <h4>
                            <a href="<?php echo $box['link']; ?>">
                                <?php echo $box['label']; ?>
                            </a>
                        </h4>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>
