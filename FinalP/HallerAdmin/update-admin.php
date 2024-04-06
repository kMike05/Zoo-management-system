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
        <h2>Update Admin</h2>
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
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <button type="submit" name="submit" class="btn-primary">Update Admin</button>
        
        </form>
    </div>
    <?php
    if(isset($_POST['submit'])){
        $id=$_POST['id'];
        $name=$_POST['name'];
        $email=$_POST['email'];

        $sql="UPDATE tbl_admin SET

		name='$name',
		email='$email'
        WHERE id='$id'
        ";

$res=mysqli_query($conn, $sql);

if($res==TRUE){
    $_SESSION['update']="<div class='success'>Admin updated successfully!!</div>";
    
    //REDIRECT
    header('location:'.SITEURL.'HallerAdmin/manage-admin.php');
}else{
    $_SESSION['update']="<div class='error'>Failed to update Admin. Try again later!!";
    header('location:'.SITEURL.'HallerAdmin/manage-admin.php');

}

    }
     ?>
    <!-- End Form -->
	<script src="script.js"></script>
</body>
</html>
