<?php
include('dashboard.php');
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
        <form id="admin-form" action="" method="POST">
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
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <button type="submit" name="submit" class="btn-primary">Change Password</button>
        
        </form>
    </div>
    <?php
    if(isset($_POST['submit'])){
        $id=$_POST['id'];
        $current_password=$_POST['password'];
        $new_password=$_POST['newpass'];
        $confirm_password=$_POST['confirmpass'];

        $sql="SELECT  * FROM tbl_admin WHERE id=$id AND password='$current_password'";

$res=mysqli_query($conn, $sql);

if($res==true){
    $count= mysqli_num_rows($res);

    if($count==1){
        if($new_password==$confirm_password)
        {
            //update password
            $sql2="UPDATE tbl_admin SET
            password=$new_password
             WHERE id=$id
             ";
             $res2 =mysqli_query($conn,$sql2);
            
             if($res2==true)
             {
                $_SESSION['change-pwd']="<div class='success'>Password changed!!";
                header('location:'.SITEURL.'HallerAdmin/manage-admin.php');    
    

             }
             else{
                $_SESSION['pass-not-changed']="<div class='error'>Failed to change password!!";
                header('location:'.SITEURL.'HallerAdmin/manage-admin.php');    
    

             }

        }
        else
        {
          
            $_SESSION['pass-not-matched']="<div class='error'>Password did not match!!";
            header('location:'.SITEURL.'HallerAdmin/manage-admin.php');    

        }

    }
    else{
        $_SESSION['change-pwd']="<div class='success'>Password changed!!";
        //$_SESSION['user-not-found']="<div class='error'>User not found!!";
        header('location:'.SITEURL.'HallerAdmin/manage-admin.php');
    }
}

    }
     ?>
<script src="script.js"></script>
</body>
</html>