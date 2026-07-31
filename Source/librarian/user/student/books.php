<?php 
     session_start();
    if (!isset($_SESSION["student"])) {
        ?>
            <script type="text/javascript">
                window.location="login.php";
            </script>
        <?php
    }
    $page = 'books';
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
							<span class="disabled">books</span>
						</div>
					</div>
				</div>
				<div class="books">
					<form action="" method="post" name="form1">
						<table class="table ">
							<tr>
								<td>
									<input type="text" name="search" class="form-control" placeholder="Enter book name">
								</td>
								<td>
									 <input type="submit" name="submit1" class="btn btn-info" value="Search Book">
								</td>
                                <td colspan="3">
                                    <div class="form-group row align-items-center">
                                    <label for="category" class="col-sm-3 col-form-label font-weight-bold">Filter by Category:</label>
                                        <div class="col-sm-5">
                                        <select name="category" id="category" class="form-control">
                                            <option value="All">All Categories</option>
                                        <?php
                                        $cat_res = mysqli_query($link, "SELECT DISTINCT books_category FROM add_book");
                                        while ($cat_row = mysqli_fetch_array($cat_res)) {
                                            $selected = (isset($_POST['category']) && $_POST['category'] == $cat_row["books_category"]) ? "selected" : "";
                                            echo "<option value='" . $cat_row["books_category"] . "' $selected>" . $cat_row["books_category"] . "</option>";
                                        }
                                        ?>
                                        </select>
                                        </div>
                                        <input type="submit" name="filter" class="btn btn-info" value="Filter">
                                    </div>
                                </td>
							</tr>
						</table>
                    </form>
                    <?php
                    $whereClauses = array(); 

                    $whereClauses[] = "books_availability = 'Available'";

                    if (isset($_POST['submit1']) && !empty($_POST['search'])) {
                       $search = mysqli_real_escape_string($link, $_POST['search']);
                       $whereClauses[] = "books_name LIKE '{$search}%'";
                    }

                    if (isset($_POST['filter']) && isset($_POST['category']) && $_POST['category'] != "All") {
                       $category = mysqli_real_escape_string($link, $_POST['category']);
                       $whereClauses[] = "books_category = '{$category}'";
                    }

                    // Combine all where clauses
                    $whereSql = implode(' AND ', $whereClauses);

                    // Build final query
                    $query = "SELECT * FROM add_book WHERE $whereSql";

                    // Execute the query
                    $res = mysqli_query($link, $query);

                        // Display books
                        $i = 0;
                        echo "<table class='table control-books'><tr>";
                        while ($row = mysqli_fetch_array($res)) {
                        $i++;
                        echo "<td>";
                        echo '<a href="../../' . $row["books_file"] . '" target="_blank"><img src="../../' . $row["books_image"] . '" alt=""></a>';
                        echo "<br><br><b>" . $row["books_name"] . "</b><br>";
                        echo "<b>Available: " . $row["books_availability"] . "</b><br>";
                        echo "<b>Category: " . $row["books_category"] . "</b>";
                        echo "</td>";

                            if ($i % 4 == 0) {
                                echo "</tr><tr>";
                                // $i = 0;
                            }
                        }
                        echo "</tr></table>";
                     ?>
				</div>
			</div>					
		</div>
	</div>
	<?php 
		include 'inc/footer.php';
	 ?>
 <script>
    $(document).ready(function () {
    $('#dtBasicExample').DataTable();
    $('.dataTables_length').addClass('bs-select');
    });
  </script>