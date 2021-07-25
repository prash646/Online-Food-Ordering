<!DOCTYPE HTML>
<html>
<?php
	session_start();
?>
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Signup</title>

  <meta name="keywords" content="" />
  <meta name="description" content="" />

  <!-- css -->
  <link rel="stylesheet" href="css/bootstrap.css" />
  <link rel="stylesheet" href="css/bootstrap-responsive.css" />
  <link rel="stylesheet" href="css/prettyPhoto.css" />
  <link rel="stylesheet" href="css/sequence.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" type="text/css" href="css/style2.css">
 <link rel="shortcut icon" href="img/favicon.png">
 
</head>

<body>

	<!-- main wrap -->
	<div class="main-wrap">

    <!-- header -->
    <header>
      <!-- top area -->
      <div class="top-nav">
        <div class="wrapper">
          <div class="logo">
				<h1 style="color:white">Pun-Tastic</h1>
          </div>

          <div class="phone">
            <p>Call +91-9310119980</p>
          </div>
        </div>
      </div>
      <!-- end top area -->
    </header>
    <!-- end of header-->
	<div class="container">
		<div class="row">
			<h1 class="myHead" style="text-align: center;margin-top:200px;font-size:40px;">Good to go!</h1>
			<h2 class="myHead" style="text-align: center;"></h2>
			<div style="width: 30%;margin: 25px auto;">
				<form action="signup.php" method="post" onsubmit=" return validation();">
					<div class="form-group">
						<input class="form-control" style="width:350px;" type="text" name="name" id="name" placeholder="Name">
					</div>
					<div class="form-group">
						<input class="form-control" style="width:350px;" type="email" name="email" id="email" placeholder="Email">
					</div>
					<div class="form-group">
						<input class="form-control" style="width:350px;" type="password" name="password" id="password" placeholder="6 letter Password...*A1B2C3">
					</div>
					<div class="form-group">
						<button class="btn btn-lg btn-info btn-block" style="width:365px;background:#A0522D;color:white;font-size:16px;font-family:Times;letter-spacing:2px;" type="submit" name="submit" id="valid" onclick="validation();">Sign Up</button>
						
					</div>
				</form>
			</div>
		</div>
	</div>

	
<!-- footer -->
    <footer>
      <div class="footer" style="margin-top:100px;">
        <div class="wrapper">
           <div class="subfooter">
            <p class="copyright">&#169; Copyright. All rights reserved</p>
          </div>
        </div>
      </div>
    </footer>


  </div>
  <!-- end main wrap -->

  <!-- Javascript Libraries -->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/jquery.prettyPhoto.js"></script>
  <script src="js/sequence.jquery.js"></script>
  <script src="js/jquery-hover-effect.js"></script>

  <!-- Contact Form JavaScript File -->
  <script src="contactform/contactform.js"></script>

  <!-- Template Custom Javascript File -->
  <script src="js/custom.js"></script>

</body>

</html>

<script language="javascript">
			function validation(){
				var nameCheck = document.getElementById("name").value;
				var emailCheck = document.getElementById("email").value;
				var passCheck = document.getElementById("password").value;
				if(nameCheck.length == 0){
					alert("Please Do Enter Name");
					return false;
				}
				if(emailCheck.length == 0){
					alert("Please Do Enter EmailID");
					return false;
				}
				
				if(passCheck.length == 0){
					alert("Please Do Enter Password");
					return false;
				}
				if(nameCheck.length<6){
					alert("Please Enter A Proper Name");
					return false;
				}
				if(passCheck.length!=6){
					alert("Please Enter 6 Letter Password");
					return false;
				}
			
				
			};
			//var validButton = document.querySelector("#valid");
			//validButton.addEventListener("submit", function(){
			//validation();
			//});
			<?php
				if(isset($_POST['submit'])){
				
				$db = mysqli_connect("localhost", "root", "","restaurant") or die("Could not connect to database");
				$myusername = $_POST['name'];
				$myemail = $_POST['email'];
				$mypassword = $_POST['password'];
				$_SESSION['new']="0";
				if(mysqli_num_rows(mysqli_query($db,"select * from user_info where EmailID='{$myemail}';"))>0){
					?>
					alert("Email already registered");
				<?php
				}
				else{
					
					if(mysqli_query($db,"INSERT INTO `user_info`(`Username`, `EmailID`, `Password`) VALUES ('{$myusername}','{$myemail}','{$mypassword}')")){
						?>
					alert("bkhgjh");
					<?php
						$_SESSION['NAME']=$_POST['email'];
						$_SESSION['new']="1";
						header("Location: ./ordering.php");
					}
					else{
					?>
					alert("Server Error!");
					<?php
					}
				}
			}
			?>
			
</script>		


			