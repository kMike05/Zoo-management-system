<?php
include('dashboard.php');
include('config1.php');
session_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if admin_id is set in session
if (!isset($_SESSION['admin_id'])) {
    // Handle the case where admin_id is not set, e.g., redirect to login page
    header('Location: Admin-login.php');
    exit();
}

if(isset($_POST['submit'])){
    $id = $_SESSION['admin_id']; // Use the admin_id from the session instead of form input
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    // Check if a new admin picture is uploaded
    if ($_FILES['admin_pic']['error'] === 0) {
        $admin_pic = $_FILES['admin_pic']['name'];
        $tmp_name = $_FILES['admin_pic']['tmp_name'];
        $folder = 'img/' . $admin_pic;

        // Move the uploaded file to the destination folder
        if(move_uploaded_file($tmp_name, $folder)) {
            echo "<h2>File uploaded successfully</h2>";
        } else {
            echo "<h2>File not uploaded</h2>";
        }
    } else {
        // No new admin picture uploaded, retain the original one
        $admin_pic = $_POST['old_admin_pic'];
    }

    // Update the admin information in the database
    $sql = "UPDATE tbl_admin SET
        name='$name',
        email='$email',
        role='$role',
        admin_pic='$admin_pic'
        WHERE id='$id'";

    $res = mysqli_query($conn, $sql);

    if($res == TRUE){
        $_SESSION['update'] = "<div class='success'>Profile updated successfully!!</div>";
        header('location:'.SITEURL.'HallerAdmin/profile.php'); // Redirect to profile page
    } else {
        $_SESSION['update'] = "<div class='error'>Failed to update profile. Try again later!!</div>";
        header('location:'.SITEURL.'HallerAdmin/profile.php'); // Redirect to profile page
    }
}

// Prefill the form with logged-in user's information
$id = $_SESSION['admin_id']; // Use the admin_id from the session
$sql = "SELECT * FROM tbl_admin WHERE id=$id";
$res = mysqli_query($conn, $sql);

if($res == true){
    $count = mysqli_num_rows($res);

    if($count == 1){
        $row = mysqli_fetch_assoc($res);
        $name = $row['name'];
        $email = $row['email'];
        $role = $row['role'];
        $admin_pic = $row['admin_pic'];
    } else {
        header('location:'.SITEURL.'HallerAdmin/profile.php'); // Redirect to profile page
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
	<script defer src="/script.js"></script>

	<title>Admin</title>
</head>
<body>
        <div class="form-container">
        <h2>Update Profile</h2>
        <?php
        $id=$_SESSION['admin_id']; // Use the admin_id from the session
        
        $sql="SELECT * FROM tbl_admin WHERE id=$id";
        $res=mysqli_query($conn, $sql);

        if($res==true){
            $count= mysqli_num_rows($res);

            if($count==1){
                //echo "Admin Available";
                $row=mysqli_fetch_assoc($res);

                $name=$row['name'];
                $email=$row['email'];
                $role=$row['role'];
                $admin_pic=$row['admin_pic'];


            }else{
                header('location:'.SITEURL.'HallerAdmin/profile.php'); // Redirect to profile page
            }
        }

        ?>
        <form id="admin-form" action="" enctype="multipart/form-data" method="POST">
        <?php
if(isset($_SESSION['update']))
{
echo $_SESSION['update']; //Display Session Message
unset($_SESSION['update']); //Remove Session Message
}
?>
            <div class="form-group">
                
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="Enter full name" value="<?php echo $name;?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter email" value="<?php echo $email;?>">
            </div>
            <div class="form-group">
            <select name="role" required class="form-select">
        <option value="" disabled>Select role</option>
        <option value="Zookeeper" <?php if($role == "Zookeeper") echo "selected"; ?>>Zookeeper</option>
        <option value="Veterinary" <?php if($role == "Veterinary") echo "selected"; ?>>Veterinary</option>
    </select>
            </div>
		        <div class="form-group">
                <label for="count">Admin Photo</label>
                <input type="file" id="animal_pic" name="admin_pic" min="1" placeholder="admin_pic">
            </div>
            <input type="hidden" name="old_admin_pic" value="<?php echo $admin_pic; ?>">
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <button type="submit" name="submit" class="btn-primary">Update Admin</button>
        
        </form>
    </div>

    <!-- End Form -->
	<script src="script.js"></script>
    <style>
/* CSS styles for the select element */
.form-select {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    box-sizing: border-box;
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 18px 18px;
    cursor: pointer;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}

/* CSS styles for select options */
.form-select option {
    padding: 10px;
    background-color: #ffffff;
    color: #000000;
}


</style>

</body>
</html>
