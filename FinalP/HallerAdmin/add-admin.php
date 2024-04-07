<?php

include('config1.php');

// Handle form submission
if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Plain password

    // Hash the password securely using bcrypt
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $user_type = $_POST['user_type'];

    // Your database insertion code here
    // Make sure to handle success or failure accordingly
    $sql = "INSERT INTO tbl_admin SET
        name='$name',
        email='$email',
        password='$hashed_password',
        user_type='$user_type'";
        
    $res = mysqli_query($conn, $sql);

    if($res == TRUE) {
        $_SESSION['add'] = "<div class='success'>Admin added successfully!!</div>";
        
        //REDIRECT
        header('location:' . SITEURL . 'HallerAdmin/manage-admin.php');
        exit(); // Exit after redirection
    } else {
        echo "<div class='error'>Failed to add Admin. Try again later!!</div>";
    }
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
    <link rel="stylesheet"  href="main.css">
	<style>
        .error-border {
            border: 1px solid red !important;
        }
        .error-message {
            color: red;
            margin-top: 5px;
        }
    </style>
	<script defer src="/script.js"></script>

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
			<li>
				<a href="event.php">
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
			<li>
				<a href="manage-species.php">
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
			<a href="signout.php" class="logout">
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
        <div class="form-container">
        <h2>Add Admin</h2>
		
        <form id="admin-form" action="" method="POST" onsubmit="return validateForm()">
		<?php
if(isset($_SESSION['add']))
{
echo $_SESSION['add']; //Displaying Session Message
unset($_SESSION['add']); //Removing Session Message
}
?>
<script>
function validateNameInput(input) {
    // Remove non-alphabetic characters from the input value
    input.value = input.value.replace(/[^a-zA-Z]/g, '');
}

</script>
         <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" placeholder="Enter full name" oninput="validateNameInput(this)" required>
            <div id="nameError" class="error-message"></div> <!-- Error message placeholder -->
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter password" required>
            <div id="passwordError" class="error-message"></div> <!-- Error message placeholder -->
        </div>
        <div style="display: none;">
            <label for="user_type">user_type</label>
            <select name="user_type" placeholder="user_type">
                <option value="admin">admin</option>
            </select>
        </div>
        <button type="submit" name="submit" class="btn-primary">Add Admin</button>
    </form>
</div>

    <!-- End Form -->
	<script src="script.js"></script>
	<script>
function validateForm() {
    var name = document.getElementById("name").value.trim();
    var password = document.getElementById("password").value.trim();

    var nameRegex = /^[a-zA-Z\s]+$/;
    var passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;

    var errors = [];

    if (!nameRegex.test(name)) {
        errors.push("Name should contain only letters.");
        document.getElementById("name").classList.add('error-border');
        document.getElementById("nameError").innerText = "Name should contain only letters.";
    } else {
        document.getElementById("name").classList.remove('error-border');
        document.getElementById("nameError").innerText = "";
    }

    if (!passwordRegex.test(password)) {
        errors.push("Password must contain at least 8 characters including at least one uppercase letter, one lowercase letter, one number, and one special character.");
        document.getElementById("password").classList.add('error-border');
        document.getElementById("passwordError").innerText = "Password must contain at least 8 characters including at least one uppercase letter, one lowercase letter, one number, and one special character.";
    } else {
        document.getElementById("password").classList.remove('error-border');
        document.getElementById("passwordError").innerText = "";
    }

    if (errors.length > 0) {
        return false;
    }

    return true;
}
</script>

</body>
</html>
    
	

           