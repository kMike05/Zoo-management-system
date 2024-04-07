<?php
include('config1.php');

// Fetch species data based on animals
$sql = "SELECT DISTINCT Animal_species FROM tbl_animal";
$res = mysqli_query($conn, $sql);

// Store species and their corresponding total counts in an array
$speciesCounts = array();
while ($row = mysqli_fetch_assoc($res)) {
    $species = $row['Animal_species'];
    $sql = "SELECT SUM(Animal_count) AS total_count FROM tbl_animal WHERE Animal_species = '$species'";
    $result = mysqli_query($conn, $sql);
    $totalCount = mysqli_fetch_assoc($result)['total_count'];
    $speciesCounts[$species] = $totalCount;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="admin.css">
	<style>
		.btn-view{
			background-color: #2ed573; /* Blue color */
    color: #fff; /* White text */
    padding: 5px 10px;
    border: none;
    cursor: pointer;
    border-radius: 3px;
    transition: background-color 0.3s ease;
		}
	</style>


	<title>Admin</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">Admin</span>
		</a>
		<ul class="side-menu top">
			<li>
				<a href="index.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li >
				<a href="#">
					<i class='bx bxs-shopping-bag-alt' ></i>
					<span class="text">Events</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">Tickets</span>
				</a>
			</li>
			<li class="active">
				<a href="manage-animal.php" >
                <i class='bx bxl-baidu'></i>
					<span class="text">Animals</span>
				</a>
			</li>
			<li>
				<a href="manage-admin.php">
					<i class='bx bxs-group' ></i>
					<span class="text">Team</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="#">
					<i class='bx bxs-cog' ></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<li>
				<a href="logout.php" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<a href="#" class="nav-link">Categories</a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a>
		</nav>
		<!-- NAVBAR -->

        <!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Animals</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Animals</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="index.php">Home</a>
						</li>
					</ul>
                    <?php
                        if(isset($_SESSION['add_species'])){ 
							echo $_SESSION['add_species']; //Displaying Session Message
                        	unset($_SESSION['add_species']); //Removing Session Message

						}
                        if(isset($_SESSION['delete_species'])){ 
							echo $_SESSION['delete_species']; //Displaying Session Message
                        	unset($_SESSION['delete_species']); //Removing Session Message

						}
                        ?>
				</div>
                <div class="table-data">
				<div class="order">
                <div class="head">
						<h3> Species</h3><br/>
						
						<a href="<?php echo SITEURL;?>HallerAdmin/manage-animal.php? " class="btn-primary">View Animals</a>
					</div>
					<div class="search-container">
                <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search... ">
				
            </div>
					<table>
						<thead>
							<tr>
								<th> Species_Name</th>
								<th>Animal_count</th>
								<!--<th>Actions</th>-->
							</tr>
						</thead>
						<tbody>
							
						<?php
                    // Iterate through each species
                    foreach ($speciesCounts as $species => $totalCount) {
                        ?>
                        <tr>
                            <td><?php echo $species; ?></td>
                            <td><?php echo $totalCount; ?></td>
                       
                        </tr>
                        <?php
                    }
                    ?>
							
						</tbody>
					</table>
				</div><script src="script.js"></script>
				<link rel="stylesheet" type="text/css" href="css/main.css">
				<style>
					.success{
   						 color: #2ed573;
						}
					.error{
   						 color: #eb4d4b;
						}
						#content main .table-data .order table tr td .btn-pass {
    background-color: #2ed573; /* Blue color */
    color: #fff; /* White text */
    padding: 5px 10px;
    border: none;
    cursor: pointer;
    border-radius: 3px;
    transition: background-color 0.3s ease;
}

#content main .table-data .order table tr td .btn-pass:hover {
    background-color: #7bed9f; /* Lighter shade of blue on hover */
}
.search-container input[type=text] {
    padding: 10px;
    margin-top: 10px;
    margin-bottom: 10px;
    width: 30%;
    border: 1px solid #ccc;
    border-radius: 50px;
    box-sizing: border-box;
    font-size: 16px;
    background-color: white;
    padding-left: 40px; /* Add some padding to the left */
}

.search-container input[type=text]:focus {
    outline: none;
    border-color: #719ECE;
    box-shadow: 0 0 8px 0 #719ECE;
}

				</style>
				<script defer src="/script.js"></script>
				<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this species?");
    }
</script>
<script>
function searchTable() {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.querySelector(".table-data table");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those that don't match the search query
    for (i = 0; i < tr.length; i++) {
        var found = false; // Flag to determine if the search term is found in any column
        // Skip the header row
        if (i !== 0) {
            // Loop through all columns of each row
            for (var j = 0; j < tr[i].cells.length; j++) {
                td = tr[i].cells[j];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        // If the search term is found in any column, show the row
                        tr[i].style.display = "";
                        found = true;
                        break; // No need to check other columns once found
                    }
                }
            }
            // If the search term is not found in any column, hide the row
            if (!found) {
                tr[i].style.display = "none";
            }
        }
    }
}
</script>
</body>
</html>
