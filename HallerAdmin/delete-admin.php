<?php
 include('config1.php');

 $id=$_GET['id'];

 $sql="DELETE FROM tbl_admin WHERE id=$id";
 $res=mysqli_query($conn, $sql);

 if($res==true){
    //echo "Admin deleted";
    $_SESSION['delete']= "<div class='success'>Admin deleted successfully!!</div>";
    header('location:'.SITEURL.'HallerAdmin/manage-admin.php');

 }
 else
 {
    //echo "Failed to delete admin";
    $_SESSION['delete']= "<div class='error'>Failed to delete Admin.Try again later!</div>";
    header('location:'.SITEURL.'HallerAdmin/manage-admin.php');

 }
?>