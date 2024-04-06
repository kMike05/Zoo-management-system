
<?php
@include 'config.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="images/logo.png" rel="icon">
	<title>Haller Park</title>


	<!-- font awesome cdn link -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

	<!-- custom css link -->
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="css/pop.css">
	<style>
        /* CSS for hiding the popup form initially *
    /* CSS for popup form */
    #popupForm {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(255, 255, 255, 0.8);
        padding: 20px;
        border-radius: 10px;
        z-index: 9999;
        width: 65%;
        max-width: 500px;
        backdrop-filter: blur(10px);
    }
/* CSS for moving message within the popup form */
.popup-form {
    position: relative;
}

.form-container {
    position: relative;
    padding-top: 40px; /* Adjust top padding to make space for the moving message */
}

.moving-message-container {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    overflow: hidden; /* Ensure the message stays within the container */
}

.moving-message {
    padding: 10px 20px;
    
    color: #183d2e;
    font-size: 16px;
    border-radius: 5px;
    animation: moveMessage 10s linear infinite; /* Adjust duration as needed */
}

@keyframes moveMessage {
    0% {
        transform: translateX(100%);
    }
    100% {
        transform: translateX(-100%);
    }
}

   

    .popup-form h2 {
        margin-top: 0;
    }

    .popup-form label {
        display: block;
        margin-bottom: 5px;
    }

	.popup-form input[type="date"],
	.popup-form input[type="text"],
    .popup-form input[type="email"],
    .popup-form select {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .popup-form #saveBtn {
        background-color: #183d2e;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 10px;
    }

    .popup-form .cancel {
        background-color: #ccc;
    }

    .popup-form button {
        display: inline-block;
        margin-right: 10px;
    }

    .popup-form .closeBtn {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 20px;
        cursor: pointer;
    }

    </style>
</head>
<body>

	<!-- header section start -->
	<header class="header" id="nav">
		
		<div>
			<h1>Haller Park <br></h1></div>

		<div class="links">
			<a href="#home">Home</a>
			<a href="#Ticket">Tickets</a>
			<a href="#project">Animals</a>
			<a href="#team">Team</a>
			<a href="#blog">Events</a>
			<a href="#contact">Contact Us</a>
		</div>
		

		<div class="icons">
			<div href="#" class="fab fa-facebook-f"></div>
			<div href="#" class="fab fa-twitter"></div>
			<div href="#" class="fab fa-instagram"></div>
			<div class="fas fa-bars" id="menu-btn"></div>
			<!--<a href="Aregister.php" class="btn1"><span>Register</span></a>
			<a href="Alogin.php" class="btn1"><span>Login</span></a>	-->	
		</div>
		<?php
        // PHP code for user session
        if(isset($_SESSION['user_name'])){
            echo '<img src="images/prof.jpeg" class="user-pic" onclick="toggleMenu()">';
            echo '<div class="sub-menu-wrap" id="subMenu">';
            echo '<div class="sub-menu">';
            echo '<div class="user-info">';
            echo '<img src="images/prof.jpeg">';
            echo '<h3>Hi, <span class="username">' . $_SESSION["user_name"] . '</span></h3>';
            echo '</div>';
            echo '<hr>';
            echo '<a href="#" class="sub-menu-link" >';
            echo '<i class="fa-solid fa-user"></i><p>View profile</p>';
            echo '<span>></span>';
            echo '</a>';
            echo '<a href="logout.php" class="sub-menu-link">';
            echo '<i class="fa-solid fa-right-from-bracket"></i><p>logout</p>';
            echo '<span>></span>';
            echo '</a>';
            echo '</div>';
            echo '</div>';
        } else {
            echo '<a href="Alogin.php" class="btn1"><span>Login</span></a>';
            echo '<a href="Aregister.php" class="btn1"><span>Register</span></a>';
        }
        ?>
          
    </div>
                 </nav>
            </div>
	</header>
<script>
	function validatePhoneNumberInput(input) {
    // Remove non-numeric characters from the input value
    input.value = input.value.replace(/\D/g, '');
}

function validateNameInput(input) {
    // Remove non-alphabetic characters from the input value
    input.value = input.value.replace(/[^a-zA-Z]/g, '');
}



</script>
	<!-- header section ends -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<div id="popupForm" class="popup-form">
        <span class="closeBtn" onclick="closePopupForm()">&times;</span>

        <form class="form-container">
			<div class="moving-message-container">
        <div class="moving-message">Only M-Pesa payments are allowed</div>
    </div>
            <h2>Payment details</h2>
			
            <label for="name"><b>Name</b></label>
            <input type="text" placeholder="Enter Name" name="name" oninput="validateNameInput(this)" required>
            <label for="email"><b>Email</b></label>
			<input type="email" placeholder="Enter Email" name="email" required>
			<label for="phone"><b>Phone Number</b></label>
        <input type="text" placeholder="Enter Phone Number" name="phone" id="phone" oninput="validatePhoneNumberInput(this)" required>
		<label for="date"><b>date of Visit</b></label>
		<input type="date" id="date" class="form-input" placeholder="Visit Date" min="<?= date('Y-m-d') ?>">
        <label for="ticketType"><b>Ticket Type</b></label>
        <select id="ticketType" name="ticketType" required>
            <option value="">Select Ticket Type</option>
            <option value="student">Student</option>
            <option value="adult">Adult</option>
            <option value="child">Child</option>
            <option value="group">Group</option>
            <option value="family">Family</option>
        </select>
			<button type="button" id="saveBtn" onclick="saveForm()">Pay</button>
			<button type="submit" class="btn cancel" style="display: none;">Close</button>
        </form>
    </div>

	<!-- home section start -->

	<section class="home" id="home">
		<div class="content">
			<h1>WELCOME TO HALLER PARK.</h1>
			<p>Enjoy the jungle life and bring your friends to the Haller Park Zoo.Haller Park is a place where you can see nature in its Wildlife.
			</p>
		
		</div>
	</section>
	<!-- home section ends -->
	

	
	<!-- Ticket section start -->
	<section class="Ticket" id="Ticket">
		<a href="../authenthication/signup.html" class="btn"><span>Donate</span></a>
		<div class="payd">
			<div class="payd-content">
			<form action="" method="post">
				<div class="close">+</div>
                            <h4>DONATE</h4>
                            <p>Full Names</p>
                            <input type="text" placeholder="Full Names" name="name">
                        <p>Email</p>
                        <input type="text" name="email" placeholder="Email">
                        <p>phone Number</p>
                            <input type="text" placeholder="Phone" name="name">
                        <p>Payment Mode</p>
                        <select name="Mode" placeholder="mode">
                            <option value="mpesa">MPESA</option>
                            <option value="bank">Bank</option>
                        </select>
			</div>
		</div>

		<h1 class="heading">Tickets</h1>
		<p class="paragraph">Book yourself a Ticket</p>


		<div class="box-container">
			<div class="box">
				<i class="fa-solid fa-graduation-cap"></i>
				<h3>Student Package</h3>
				<p>Upto 20 Yrs(*std id)</p>
				<p class="price">Ksh1000</p>
				<a href="#" class="Tbutton" onclick="openPopupForm();togglePopupForm(event)">
					Get Ticket
				   </button></a>
			
			</div>

			<div class="box">
				<i class="fa-solid fa-person"></i>
				<h3>Adult</h3>
				<p>Ticket for 13+ Yrs</p>
				<p class="price">Ksh2000</p>
				<a href="#" class="Tbutton" onclick="openPopupForm();togglePopupForm(event)">
					Get Ticket
				   </button></a>
			</div>

			<div class="box">
				<i class="fa-solid fa-user"></i>
				<h3>Child</h3>
				<p>Ticket for upto 12 Yrs</p>
				<p class="price">Ksh500</p>
				<a href="#" class="Tbutton" onclick="openPopupForm();togglePopupForm(event)">
				Get Ticket
			</button></a>
			</div>

			<div class="box">
				<i class="fa-solid fa-users"></i>
				<h3>Group Package</h3>
				<p>Ticket for group of 10</p>
				<p class="price">Ksh8000</p>
				<a href="#" class="Tbutton" onclick="openPopupForm();togglePopupForm(event)">
				Get Ticket
			</button></a>
			</div>

			<div class="box">
				<i class="fa-solid fa-user-group"></i>
				<h3>Family Package</h3>
				<p>2 Parents 2 Children</p>
				<p class="price">Ksh4500</p>
				<a href="#" class="Tbutton" onclick="openPopupForm();togglePopupForm(event)">
				Get Ticket
			</button></a>
			</div>

	</section>
	<!-- Ticket section ends -->

	<!-- Animal section start -->

	<section class="project" id="project">
		<h1 class="heading">Our Animals</h1>
		<p class="paragraph">
			Haller park has a wide range of Wildlife<br>
		</p>

		<div class="box-container">
			<div class="box">
				<img src="images/lion.jpg">

				<div class="content">
					<div>
						<h3>LION</h3>
						<span> Fun Fact<br>A lion's roar can be heard up to eight kilometres away.</span>
					</div>
				</div>
			</div>

			<div class="box">
				<img src="images/cheetah.jpg">

				<div class="content">
					<div>
						<h3>CHEETAH</h3>
						<span> Fun Fact<br>Cheetahs are the fastest land animalS on Earth.</span>
					</div>
				</div>
			</div>

			<div class="box">
				<img src="images/Tortoise.jpg">

				<div class="content">
					<div>
						<h3>TORTOISE</h3>
						<span> Fun Fact<br>They Can Live a Very Long Time.</span>
					</div>
				</div>
			</div>

			<div class="box">
				<img src="images/snake.jpg">

				<div class="content">
					<div>
						<h3>SNAKE</h3>
						<span> Fun Fact<br>They smell with their tongues.</span>
					</div>
				</div>
			</div>

			<div class="box">
				<img src="images/rhino.jpg">

				<div class="content">
					<div>
						<h3>RHINO</h3>
						<span> Fun Fact<br>Rhinos can weigh over 3 tonnes.</span>
					</div>
				</div>
			</div>

			<div class="box">
				<img src="images/zebra.jpg">

				<div class="content">
					<div>
						<h3>ZEBRA</h3>
						<span> Fun Fact<br>Zebras' stripes are used for camouflage.</span>
					</div>
				</div>
			</div>

		</div>
	</section>
	<!-- project section ends -->


	<!-- team section start -->

	<section class="team" id="team">
		<h1 class="heading">meet our team</h1>
		<p class="paragraph">
			</p>

		<div class="box-container">
			<div class="box">
				<img src="images/me.jpg">

				<div class="content">
					<div>
						<h3>Mike Ngetich</h3>
						<span>Manager</b></span>

						<div class="icon">
							<a href="#" class="fab fa-facebook-f"></a>
							<a href="#" class="fab fa-instagram"></a>
							<a href="#" class="fab fa-twitter"></a>
						</div>
					</div>
				</div>
			</div>

			<div class="box">
				<img src="images/me.jpg">

				<div class="content">
					<div>
						<h3>MIKE KIBET</h3>
						<span>ZooKeeper</span>

						<div class="icon">
							<a href="#" class="fab fa-facebook-f"></a>
							<a href="#" class="fab fa-instagram"></a>
							<a href="#" class="fab fa-twitter"></a>
						</div>
					</div>
				</div>
			</div>

			<div class="box">
				<img src="images/me.jpg">

				<div class="content">
					<div>
						<h3>Mike</h3>
						<span>Veterinarian</span>

						<div class="icon">
							<a href="#" class="fab fa-facebook-f"></a>
							<a href="#" class="fab fa-instagram"></a>
							<a href="#" class="fab fa-twitter"></a>
						</div>
					</div>
				</div>
			</div>

		</div>
	</section>

	<!-- team section ends -->

	<!-- blog section start -->

	<section class="blog" id="blog">
		<h1 class="heading">Events</h1>
		<p class="paragraph">
			read our latest news <br> stay updated for our Upcoming events!!
		</p>


		<div class="box-container">
			<div class="box">
				<div class="image">
					<img src="images/rhino.jpg">
                   
				</div>

				<div class="content">
					<a href="#" class="cate">Upcoming event</a>
					<span>Upcoming event</span>
					<p>Upcoming event</p>
					<a href="#">read more</a>
				</div>
			</div>

			<div class="box">
				<div class="image">
					<img src="images/BACK17.jpg">
				</div>

				<div class="content">
					<a href="#" class="cate">Upcoming event</a>
					<span>Upcoming event</span>
					<p>Upcoming event</p>
					<a href="#">read more</a>
				</div>
			</div>

			<div class="box">
				<div class="image">
					<img src="images/BACK12.jpg">
				</div>

				<div class="content">
					<a href="#" class="cate">Upcoming event</a>
					<span>Upcoming event</span>
					<p>Upcoming event</p>
					<a href="#">read more</a>
				</div>
			</div>
		</div>
	</section>

	<!-- blog section ends -->


	<!-- contact section start -->

	<section class="contact" id="contact">
		<h1 class="heading">contact us</h1>
		<p class="paragraph">feel free to contact us</p>

		<div class="row">
			<div class="content">
				<h1>let's talk</h1>
				<h3>HallerPark@gmail.com</h3>
				<p>If facing an issue with ticket booking feel free to contact us.</p>

				<div class="icons">
					<a href="#" class="fab fa-facebook-f"></a>
					<a href="#" class="fab fa-twitter"></a>
					<a href="#" class="fab fa-instagram"></a>
					<a href="#" class="fab fa-linkedin"></a>
					<a href="#" class="fab fa-tiktok"></a>

				</div>
			</div>

			<div class="form">
				<form>
					<input type="text" name="" placeholder="your name">
					<input type="email" name="" placeholder="your email">
					<input type="text" name="" placeholder="subject" class="subject">

					<textarea placeholder="your message"></textarea>

					<a href="#" class="btn"><span>send message</span></a>
				</form>
			</div>
		</div>
	</section>


	<!-- contact section ends -->

	<!-- footer section start -->
	<section class="footer">
		<div class="credit">
			created by <span>Mike</span> | all rights reserved.
		</div>

		<div class="links">
			<a href="#">teams of use</a>
			<a href="#">privacy policy</a>
			<a href="#">cookie policy</a>
		</div>
	</section>
	<!-- footer section ends -->
	
	
	<script>
		let subMenu=document.getElementById("subMenu")
		function toggleMenu(){
			subMenu.classList.toggle("open-menu");
		}
	</script>
	<!-- custom js link -->
	<script src="js/scripts.js"></script>
	<script>
    // JavaScript function for opening the popup form
    function togglePopupForm(event) {
    event.preventDefault(); // Prevent default anchor behavior

	}
	function openPopupForm() {
        var popupForm = document.getElementById("popupForm");

        popupForm.style.display = "block";
        document.body.style.overflow = "hidden"; // Disable scrolling
        
        // Hide the sub menu if it's visible
    
    }

    // JavaScript function for closing the popup form
    function closePopupForm() {
        document.getElementById("popupForm").style.display = "none";
        document.body.style.overflow = "auto"; // Enable scrolling
    }

    // JavaScript function for editing the form
    function editForm() {
        var form = document.querySelector('.form-container');
        var saveBtn = document.getElementById('saveBtn');
        var submitBtn = document.querySelector('.btn.cancel');

        form.querySelectorAll('input').forEach(function(input) {
            input.removeAttribute('readonly');
        });

        saveBtn.style.display = 'block';
        submitBtn.style.display = 'none';
    }

    // JavaScript function for saving the form
    function saveForm() {
        // Logic for saving the form data goes here
    }

   
</script>

</body>
</html>