<?php
include('dashboard.php');
include('config1.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);


// Check if form is submitted
if(isset($_POST['submit'])){
    $id = isset($_GET['id']);
    $current_password = $_POST['password'];
    $new_password = $_POST['newpass'];
    $confirm_password = $_POST['confirmpass'];

    // Validate and sanitize input
    $id = mysqli_real_escape_string($conn, $id);
    $current_password = mysqli_real_escape_string($conn, $current_password);
    $new_password = mysqli_real_escape_string($conn, $new_password);
    $confirm_password = mysqli_real_escape_string($conn, $confirm_password);

    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);


    // Check if new passwords match
    if($new_password == $confirm_password) {
        $update_sql = "UPDATE tbl_admin SET password='$hashed_password' WHERE id=" . (int)$id;

        $res2=mysqli_query($conn, $update_sql);
        if($res2==true)
        {
            $_SESSION['success'] = "Password changed successfully.";
            header('location:'.SITEURL.'HallerAdmin/manage-admin.php');
            exit();

        }
        else
         {
            $_SESSION['error'] = "Failed to update password: " . mysqli_error($conn);
            header('location:'.SITEURL.'HallerAdmin/manage-admin.php');
            exit();
        }
            
    }
    else
    {
        $_SESSION['error'] = "Passwords do not match! " . mysqli_error($conn);

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
        <h2>Change Password</h2>
        <?php
        $id=$_GET['id'];
        
        $sql="SELECT * FROM tbl_admin WHERE id=$id";
        $res=mysqli_query($conn, $sql);

        if($res==true){
            $count= mysqli_num_rows($res);

            if($count==1){
                //echo "Admin Available";
                $row=mysqli_fetch_assoc($res);

                $name=$row['name'];
                $email=$row['email'];

            }else{
                header('location:'.SITEURL.'HallerAdmin/manage-admin.php');
            }
        }

        ?>
        <form id="admin-form" action="update-password.php" method="POST">
		<?php
if(isset($_SESSION['pass']))
{
echo $_SESSION['pass']; //Display Session Message
unset($_SESSION['pass']); //Remove Session Message
}
?>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="Enter full name" value="<?php echo $name;?>" readonly>
            </div>
            <div class="form-group">
                <label for="password">Current Password</label>
                <input type="password" id="password" name="password" placeholder="Current Password" value="" required>
            </div>
            <div class="form-group">
                <label for="newpass">New Password</label>
                <input type="password" id="password" name="newpass" placeholder="New Password" value="" required>
            </div>
            <div class="form-group">
                <label for="newpass"> Confirm New Password</label>
                <input type="password" id="password" name="confirmpass" placeholder="Confirm Password" value="" required>
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button type="submit" name="submit" class="btn-primary">Change Password</button>
        
        </form>
    </div>

<script src="script.js"></script>
</body>
</html>