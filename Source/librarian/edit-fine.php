<?php
session_start();
if (!isset($_SESSION["username"])) {
    echo "<script>window.location='login.php';</script>";
    exit();
}
include 'inc/header.php';
include 'inc/connection.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "Invalid Book ID.";
    exit();
}

// Handle update
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fine = $_POST["fine"];


    $query = "UPDATE finezone SET fine='$fine' WHERE id=$id";
    if (mysqli_query($link, $query)) {
        echo "<script>alert('Amount updated successfully'); window.location='fine.php';</script>";
    } else {
        echo "<div class='alert alert-danger'>Failed to update user fine: " . mysqli_error($link) . "</div>";
    }
}

// Fetch fine data
$res = mysqli_query($link, "SELECT * FROM finezone WHERE id=$id");
$row = mysqli_fetch_assoc($res);
if (!$row) {
    echo "User not found.";
    exit();
}
?>

<div class="container mt-5">
    <h3>Edit Amount</h3>
    <form method="post">
        <div class="form-group">
            <label>Amount(RM):</label>
            <input type="number" name="fine" class="form-control" value="<?php echo $row["fine"]; ?>" required>
        </div>
        
        <button type="submit" class="btn btn-success">Update Amount</button>
        <a href="fine.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php include 'inc/footer.php'; ?>
