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
    $price = $_POST["books_price"];
    $quantity = $_POST["books_quantity"];
    $availability = $_POST["books_availability"];
    $category = $_POST["books_category"];

    $query = "UPDATE add_book SET books_price='$price', books_quantity='$quantity', books_availability='$availability', books_category='$category' WHERE id=$id";
    if (mysqli_query($link, $query)) {
        echo "<script>alert('Book updated successfully'); window.location='display-books.php';</script>";
    } else {
        echo "<div class='alert alert-danger'>Failed to update book: " . mysqli_error($link) . "</div>";
    }
}

// Fetch book data
$res = mysqli_query($link, "SELECT * FROM add_book WHERE id=$id");
$row = mysqli_fetch_assoc($res);
if (!$row) {
    echo "Book not found.";
    exit();
}
?>

<div class="container mt-5">
    <h3>Edit Book</h3>
    <form method="post">
        <div class="form-group">
            <label>Books Price</label>
            <input type="number" name="books_price" class="form-control" value="<?php echo $row["books_price"]; ?>" required>
        </div>
        <div class="form-group">
            <label>Books Quantity</label>
            <input type="number" name="books_quantity" class="form-control" value="<?php echo $row["books_quantity"]; ?>" required>
        </div>
        <div class="form-group">
            <label>Books Availability</label>
            <select name="books_availability" class="form-control" required>
                <option value="available" <?php if ($row["books_availability"] == "available") echo "selected"; ?>>Available</option>
                <option value="not available" <?php if ($row["books_availability"] == "not available") echo "selected"; ?>>Not Available</option>
            </select>
        </div>
        <div class="form-group">
            <label>Books Category</label>
            <select name="books_category" class="form-control" required>
                <option value="Science fiction" <?php if ($row["books_category"] == "category") echo "selected"; ?>>Science fiction</option>
                <option value="History" <?php if ($row["books_category"] == "category") echo "selected"; ?>>History</option>
                <option value="Linguistics" <?php if ($row["books_category"] == "category") echo "selected"; ?>>Linguistics</option>
                <option value="Romance Novel" <?php if ($row["books_category"] == "category") echo "selected"; ?>>Romance Novel</option>
                <option value="Mystery" <?php if ($row["books_category"] == "category") echo "selected"; ?>>Mystery</option>
                <option value="Technology" <?php if ($row["books_category"] == "category") echo "selected"; ?>>Technology</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update Book</button>
        <a href="display-books.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php include 'inc/footer.php'; ?>
