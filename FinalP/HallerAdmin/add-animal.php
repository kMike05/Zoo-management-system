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
    <script defer src="/script.js"></script>

	<title>Admin</title>
</head>
<body>
        <div class="form-container">
        <h2>Add animal</h2>
     
        <form id="admin-form" action="" method="POST" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="animal_name">animal Name</label>
                <input type="text" id="animal_name" name="animal_name" placeholder="Enter animal name" value="" required>
            </div>
            <div class="form-group">
                <label for="animal_species">Species</label>
                <input type="text" id="animal_species" name="animal_species" placeholder="Enter animal species" value="" required>
            </div>
            <div class="form-group">
                <label for="animal_name">Description</label>
                <textarea id="message" name="message" placeholder="Description of the animal" cols="30" rows="5"></textarea>
            </div>
            <div class="form-group">
                <label for="count">Picture</label>
                <input type="file" id="animal_pic" name="Animal_pic" min="1" placeholder="Animal_pic" required>
            </div>


            <input type="hidden" name="id" value="">
            <button type="submit" name="submit" class="btn-primary">Add animal</button>
        
        </form>
    </div>
    <?php
   if(isset($_POST['submit'])){
    $name=$_POST['animal_name'];
    $Animal_count=$_POST['Animal_count'];

    $sql="INSERT INTO tbl_animal SET 
    animal_name='$name',
    Animal_count='$Animal_count'

    ";
    $res=mysqli_query($conn, $sql);
    if($res==TRUE){
        $_SESSION['add_animal']="<div class='success'>animal added successfully!!</div>";
        
        //REDIRECT
        header('location:'.SITEURL.'HallerAdmin/manage-animal.php');
    }else{
        echo "<div class='error'>Failed to add animal. Try again later!!";

    }
   }?>
<script>
    function validateForm() {
        var animalName = document.getElementById("animal_name").value.trim();
        var animalSpecies = document.getElementById("animal_species").value.trim();
        var description = document.getElementById("message").value.trim();
        var picture = document.getElementById("animal_pic").value.trim();

        // Regular expression to match only letters and spaces
        var lettersOnly = /^[A-Za-z\s]+$/;

        if (animalName === "") {
            alert("Please enter animal name");
            return false;
        }
        if (!animalName.match(lettersOnly)) {
            alert("Animal name should contain only letters");
            return false;
        }
        if (animalSpecies === "") {
            alert("Please enter animal species");
            return false;
        }
        // Check if description contains only letters and spaces
        if (description === "" || !description.match(lettersOnly)) {
            alert("Description should contain only letters");
            return false;
        }
        if (picture === "") {
            alert("Please select a picture");
            return false;
        }

        return true;
    }
</script>
</body>
</html>