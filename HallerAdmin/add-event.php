
<?php
    include('dashboard.php');
    include('config1.php');

   if(isset($_POST['submit'])){
    $name=$_POST['event_name'];
    $event_date=$_POST['event_date'];
    $Description=$_POST['Description'];
    $event_pic=$_FILES['event_pic']['name'];
    $tmp_name=$_FILES['event_pic']['tmp_name'];
    $folder='img/'.$event_pic;

    if(move_uploaded_file($tmp_name, $folder)) {
        echo "<h2>File uploaded successfully</h2>";
    } else {
        echo "<h2>File not uploaded</h2>";
    }
    

    $sql="INSERT INTO tbl_event SET 
    event_name='$name',
    event_date='$event_date',
    event_description='$Description',
    event_pic='$event_pic'

    ";
    $res = mysqli_query($conn, $sql);

    if($res == TRUE){
        $_SESSION['add_event'] = "<div class='success'>event added successfully!!</div>";
        
        //REDIRECT
        header('location:'.SITEURL.'HallerAdmin/manage-events.php');
        exit(); // Exit after redirection
    } else {
        echo "<div class='error'>Failed to add event. Try again later!!</div>";
    }
   }?>
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
        <h2>Add event</h2>
     
        <form id="admin-form" action="" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="event_name">event Name</label>
                <input type="text" id="event_name" name="event_name" placeholder="Enter event name" value="" required>
            </div>
            <div class="form-group">
                <label for="event_date">Date</label>
                <input type="date" id="event_date" name="event_date" placeholder="Enter event date" value="" min="<?= date('Y-m-d') ?>" required>
            </div>
            <div class="form-group">
                <label for="event_name">Description</label>
                <textarea id="message" name="Description" placeholder="Description of the event" cols="30" rows="5"></textarea>
            </div>
            <div class="form-group">
                <label for="count">Picture</label>
                <input type="file" id="event_pic" name="event_pic" min="1" placeholder="event_pic" required>
            </div>


            <input type="hidden" name="id" value="">
            <button type="submit" name="submit" class="btn-primary">Add event</button>
        
        </form>
    </div>

<script>
    function validateForm() {
        var eventName = document.getElementById("event_name").value.trim();
        var eventdate = document.getElementById("event_date").value.trim();
        var description = document.getElementById("message").value.trim();
        var picture = document.getElementById("event_pic").value.trim();

        // Regular expression to match only letters and spaces
        var lettersOnly = /^[A-Za-z\s]+$/;

        if (eventName === "") {
            alert("Please enter event name");
            return false;
        }
        if (!eventName.match(lettersOnly)) {
            alert("event name should contain only letters");
            return false;
        }
        if (eventdate === "") {
            alert("Please enter event date");
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
<style>
        textarea {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-family: Arial, sans-serif;
    resize: vertical; /* Allow vertical resizing */
    min-height: 150px; /* Set a minimum height */
    width: 100%; /* Set the width to 100% of the container */
    box-sizing: border-box; /* Ensure padding and border are included in the element's total width */
}

    </style>
</body>
</html>