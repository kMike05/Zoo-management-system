<?php
@include 'config.php';
$error = array(); // Initialize the error array
if(isset($_POST['submit'])){
    $name=mysqli_real_escape_string($conn,$_POST['name']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $password=mysqli_real_escape_string($conn,$_POST['pass']);
    $cpassword=mysqli_real_escape_string($conn,$_POST['Cpass']);
    $user_type=$_POST['user_type'];
    $select="SELECT * FROM user_form WHERE email='$email'";
    $result = mysqli_query($conn,$select);
    if(mysqli_num_rows($result)>0){
        $error[]='User already exists!';
    }else{
        if($password != $cpassword){
            $error[]='Passwords do not match!';
        }else{
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            if($user_type == 'user'){
                $insert = "INSERT INTO user_form (name, email, password, user_type) VALUES ('$name', '$email', '$hashedPassword', '$user_type')";
            } elseif($user_type == 'admin') {
                $insert = "INSERT INTO tbl_admin (name, email, password) VALUES ('$name', '$email', '$hashedPassword')";
            }
            
            mysqli_query($conn,$insert);
            header('location:Alogin.php');
            exit(); // Exit after redirection
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>LOGIN</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="passstyle.css">
<script defer src="/style.js"></script>
<script>
      function validateNameInput(input) {
    // Remove non-alphabetic characters from the input value
    input.value = input.value.replace(/[^a-zA-Z]/g, '');
}
    function validateForm() {
        var fullName = document.getElementsByName("name")[0].value.trim();
        var password = document.getElementsByName("pass")[0].value.trim();

        var fullNameRegex = /^[a-zA-Z\s]+$/; // Only allow letters and spaces
        var passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/; // Complex password pattern

        var errors = [];

        if (!fullNameRegex.test(fullName)) {
            errors.push("Full Name should contain only letters.");
        }

        if (!passwordRegex.test(password)) {
            errors.push("Password must be complex");
        }

        if (errors.length > 0) {
            var errorMessage = errors.join("<br>");
            document.getElementById("error-msg").innerHTML = errorMessage;
            return false; // Prevent form submission
        }

        return true; // Allow form submission
    }
  

</script>
</head>
<body background="bg1.jpg">
                <div class="containers">
                    
                    <div class="left"> </div>
                    <div class="right">
                        <div class="formBoxs">
                        <form action="" method="post" onsubmit="return validateForm()">
                            <h4>REGISTER</h4>
                            <p>Full Names</p>
                            <input type="text" placeholder="Full Names" name="name" oninput="validateNameInput(this)" required>
                        <p>Email</p>
                        <input type="text" name="email" placeholder="Email" required>
                        <p>Password</p>
                        <input type="password" placeholder="Password" name="pass" required>
                        <p>Confirm Password</p>
                        <input type="password" placeholder="Confirm Password" name="Cpass" required />
                        <p>user_type</p>
                        <select name="user_type" placeholder="user_type">
                            <option value="user">user</option>
                            <option value="admin">admin</option>
                        </select>
                        <input type="submit" name="submit" value="Register">
                        <p id="error-msg" style="color: red;">
                            <?php
                            if(isset($error)){
                                foreach($error as $error){
                                    echo $error . "<br>";
                                }
                            }
                            ?>
                        </p>
                <p> existing user?<a id="a"href="Alogin.php"><i> click here</i> </a>to login</a></p>
		</div>
	   </form>
	</div></div>
</body>
</html>
