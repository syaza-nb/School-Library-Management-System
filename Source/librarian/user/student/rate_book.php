<?php
session_start();
if (!isset($_SESSION["student"])) {
    echo '<script>window.location="login.php";</script>';
    exit();
}

$page = 'bookr&c';
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
                        <p><span>dashboard</span>User panel</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right text-right">
                        <a href="dashboard.php"><i class="fas fa-home"></i>home</a>
                        <span class="disabled">book rating</span>
                    </div>
                </div>
            </div>

        <!-- Book Rating Section -->
        <div class="row" style="max-height: 550px; overflow-y: auto;">
            <div class="col-md-12">
                <?php
                $res = mysqli_query($link, "SELECT * FROM issue_book WHERE username='{$_SESSION['student']}' ORDER BY id DESC");

                if (mysqli_num_rows($res) > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                ?>
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                            <span><?= htmlspecialchars($row['booksname']) ?></span>
                            <small>Issued: <?= date("d M Y", strtotime($row['booksissuedate'])) ?></small>
                        </div>
                        <div class="card-body">
                            <form onsubmit="handleRatingSubmit(event, <?= $row['id'] ?>)">
                                <input type="hidden" name="book_id" value="<?= $row['id'] ?>">

                                <div class="form-group">
                                    <label>Rating (1-5):</label>
                                    <select name="rating" class="form-control w-25">
                                        <option value="">Select</option>
                                        <?php
                                        for ($i = 1; $i <= 5; $i++) {
                                            $selected = ($row['rating'] == $i) ? "selected" : "";
                                            echo "<option value='$i' $selected>$i Star</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Comment:</label>
                                    <textarea name="comment" class="form-control" rows="3" placeholder="Write your thoughts..."><?= htmlspecialchars($row['comment'] ?? '') ?></textarea>
                                </div>

                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-paper-plane"></i> Submit
                                </button>
                                <div class="response mt-2" id="response-<?= $row['id'] ?>"></div>
                            </form>
                        </div>
                    </div>
                <?php
                    }
                } else {
                    echo "<div class='alert alert-info text-center'>
                            <i class='fas fa-info-circle'></i> You have no issued books to rate.
                          </div>";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<!-- <?php include 'inc/footer.php'; ?> -->

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
function handleRatingSubmit(event, bookId) {
    event.preventDefault();

    const form = event.target;
    const rating = parseInt(form.querySelector('[name="rating"]').value);
    const comment = form.querySelector('[name="comment"]').value.trim();
    const responseDiv = document.getElementById(`response-${bookId}`);

    if (rating >= 1 && rating <= 5) {
        // Simulate save
        console.log(`Book ID: ${bookId}, Rating: ${rating}, Comment: ${comment}`);
        responseDiv.innerHTML = `<div class='alert alert-success'>Rating and comment submitted successfully!</div>`;
    } else {
        responseDiv.innerHTML = `<div class='alert alert-danger'>Please select a valid rating between 1 and 5.</div>`;
    }
}
</script>
