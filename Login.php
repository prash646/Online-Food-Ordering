<!DOCTYPE HTML>
<html>
<?php
	session_start();
?>
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <title>Login</title>

  <meta name="keywords" content="" />
  <meta name="description" content="" />

  <!-- css -->
  <link rel="stylesheet" href="css/bootstrap.css" />
  <link rel="stylesheet" href="css/bootstrap-responsive.css" />
  <link rel="stylesheet" href="css/prettyPhoto.css" />
  <link rel="stylesheet" href="css/sequence.css" />
  <link rel="stylesheet" href="css/style.css" />
 <link rel="stylesheet"  href="css/style2.css" />
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

	
	<div class="formlog" style="margin-top:80px">
		<div class="row">
			<h1 class="myHead" style="text-align: center;font-size:40px;margin-top:100px;">You are just few steps away to satiate your hunger!</h1>
			<h2 class="myHead" style="text-align: center;">Login, quick! :D</h2>
			<div style="width: 30%;margin: 25px auto;">
				<form action="Login.php" method="post" onsubmit="validation();">
					<div class="form-group">
						<input class="form-control" style="width:350px;" type="email" id="email" name="email" placeholder="Email...">
					</div>
					<div class="form-group">
						<input class="form-control" style="width:350px;" type="password" id="password" name="password" placeholder="Password">
					</div>
					<div class="form-group">
						<button class="btn btn-lg btn-success btn-block btn-green" style="width:365px;" type="submit" name="submit" id="valid" >Login!</button>
					</div>
					<!--<div class="form-group">
						<a href="#">Go Back!</a>
					</div>-->
				</form>
			</div>
		</div>
	</div>

	
<!-- footer -->
    <footer>
      <div class="footer" style="margin-top:120px;" >
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
				var userCheck = document.getElementById("email").value;
				var passCheck = document.getElementById("password").value;
				
				
				if(userCheck.length == 0){
					alert("Please Do Enter EmailID");
					return false;
				}
				if(passCheck.length == 0){
					alert("Please Do Enter Password");
					return false;
				}
				
			};
			var validButton = document.querySelector("#valid");
			validButton.addEventListener("submit", function(){
			validation();
			});
				
</script>		


			<?php
			if(isset($_POST['submit'])){
				$db = mysqli_connect("localhost", "root", "","restaurant") or die("Could not connect to database");
				$myusername = $_POST['email'];
				$mypassword = $_POST['password'];
				$result = mysqli_query($db,"SELECT * FROM user_info");
				//$count=mysqli_num_rows($result);
				$row = mysqli_fetch_array($result);
				
				if(mysqli_query($db,"select * from user_info where EmailID='$myusername';"))
				{
					$passCorrect =mysqli_num_rows(mysqli_query($db,"select * from user_info where EmailID='$myusername' AND Password='$mypassword';"));
					if($passCorrect!=0){
						$_SESSION['NAME']=$_POST['email'];
						
						header("Location: ./ordering.php");
					}
					
					else{
					?>
					<script>
						alert("Wrong password");
					</script>
					<?php
					}
  				}
				else{
					?>
					<script>
						alert("User doesn't exist");
					</script>
					<?php
				}
			}
			?>
			