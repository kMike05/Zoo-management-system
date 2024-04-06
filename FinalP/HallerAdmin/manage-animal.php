<?php
include('config1.php');
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
				<a href="manage-species.php" >
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
						<h3>Manage animals</h3><br/>
						<a href="add-animal.php " class="btn-primary">Add animal</a>
					</div>
					<table>
						<thead>
							<tr>
							    <th> ID</th>
								<th> animal_Name</th>
								<th>Animal_species</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$sql="SELECT * FROM tbl_animal";

							$res=mysqli_query($conn,$sql);
							if($res==TRUE){
								$count=mysqli_num_rows($res);
								$sn=1;
								if($count>0){
									while($rows=mysqli_fetch_assoc($res)){
										$id=$rows['id'];
										$name=$rows['animal_name'];
										$count=$rows['Animal_count'];
										?>
										<tr>
											
										<td>
									<?=$sn++?>
								</td>
										<td>
									<p><?=$name?></p>
								</td>
								<td><?=$count?></td>
								<td>
                                <a href="<?php echo SITEURL;?>HallerAdmin/manage-animal.php?id=<?php echo $id;?>" class="btn-pass">View Species</a>
									<a href="<?php echo SITEURL;?>HallerAdmin/update-animal.php?id=<?php echo $id;?>" class="btn-sec">Update animal</a>
									<a href="<?php echo SITEURL;?>HallerAdmin/delete-animal.php?id=<?php echo $id;?>" class="btn-delete">Delete animal</a>
                                </span></td>
							</tr>
										<?php

									}

								}else
								{
									echo "<div class='error'>no records found!!</div>";

								}
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

				</style>
				<script defer src="/script.js"></script>
</body>
</html>
