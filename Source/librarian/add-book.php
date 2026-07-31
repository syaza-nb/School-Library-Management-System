<?php 
     session_start();
    if (!isset($_SESSION["username"])) {
        ?>
            <script type="text/javascript">
                window.location="login.php";
            </script>
        <?php
    }
    include 'inc/header.php';
    include 'inc/connection.php';
    include 'log_activity.php';
 ?>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Target all links that are meant to toggle submenus
    const toggles = document.querySelectorAll(".sidebar-menu ul li > a");

    toggles.forEach(function (toggle) {
        toggle.addEventListener("click", function (e) {
            // Prevent default link behavior if submenu exists
            const submenu = this.parentElement.querySelector("ul");
            if (submenu) {
                e.preventDefault();
                submenu.style.display = submenu.style.display === "block" ? "none" : "block";
            }
        });
    });
});
</script>

<!-- dashboard area -->
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
                            <span class="disabled">Add Book</span>
                        </div>
                    </div>
                </div>

            <!-- Centered Form -->
            <div class="d-flex justify-content-center mt-4">
                <div class="card p-4 shadow" style="max-width: 600px; width: 100%;">
                    <form action="" method="post" enctype="multipart/form-data">
                        <h4 class="text-center mb-4">Add New Book</h4>
                        <div class="form-group">
                            <input type="text" class="form-control" name="booksname" placeholder="Book Name" required>
                        </div>
                        <div class="form-group">
                            Book Image:
                            <input type="file" class="form-control" name="f1" required>
                        </div>
                        <div class="form-group">
                            Book File (PDF, etc.):
                            <input type="file" class="form-control" name="file" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="bauthorname" placeholder="Author Name" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="bpubname" placeholder="Publication Name" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="bpurcdate" placeholder="Purchase Date" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="bprice" placeholder="Book Price" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="bquantity" placeholder="Quantity" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="bavailability" placeholder="Availability" required>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="bcategory" required>
                                <option value="" disabled selected>Select Book Category</option>
                                <option value="Science fiction">Science Fiction</option>
                                <option value="History">History</option>
                                <option value="Linguistics">Linguistics</option>
                                <option value="Romance Novel">Novel</option>
                                <option value="Mystery">Mystery</option>
                                <option value="Technology">Technology</option>
                            </select>
                        </div>
                        <div class="text-center">
                            <input type="submit" name="submit" class="btn btn btn-success" value="Add Book">
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Centered Form -->
        </div>
    </div>
</div>

<?php
if (isset($_POST["submit"])) {
    $image_name = $_FILES['f1']['name'];
    $file_name = $_FILES['file']['name'];

    $temp = explode(".", $image_name);
    $temp2 = explode(".", $file_name);

    $newfilename = round(microtime(true)) . '.' . end($temp);
    $newfilename2 = round(microtime(true)) . '.' . end($temp2);

    $imagepath = "books-image/" . $newfilename;
    $filepath = "books-file/" . $newfilename2;

    move_uploaded_file($_FILES["f1"]["tmp_name"], $imagepath);
    move_uploaded_file($_FILES["file"]["tmp_name"], $filepath);

    mysqli_query($link, "INSERT INTO add_book VALUES (
        '',
        '$_POST[booksname]',
        '$imagepath',
        '$_POST[bauthorname]',
        '$_POST[bpubname]',
        '$_POST[bpurcdate]',
        '$_POST[bprice]',
        '$_POST[bquantity]',
        '$_POST[bavailability]',
        '$_POST[bcategory]',
        '$_SESSION[username]',
        '$filepath'
    )");
}
?>

<!-- <?php include 'inc/footer.php'; ?> -->
