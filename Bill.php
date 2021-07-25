<!DOCTYPE HTML>
<html>
<?php
	session_start();
?>
<script language="javascript">
	function back(){
		<?php
		if(isset($_POST['back'])){
			header("Location: ./ordering.php");
		}
		?>
	}
	<?php
	if(isset($_POST['logout'])){
	?>
	alert("Your order will be delievered in 30 Minutes");
	<?php
	
		$db = mysqli_connect("localhost", "root", "","restaurant") or die("Could not connect to database");
		$new=$_SESSION['NAME'];
		$m = mysqli_fetch_array(mysqli_query($db,"Select * from user_info where EmailID ='{$new}';"));
		$myrow=$m['myorder'];
		$my=($myrow+1);
	
		mysqli_query($db,"UPDATE `user_info` SET `myorder`='$my' WHERE `EmailID`='$new';");
		
		if(isset($_POST['logout']))
			if(session_destroy())
				header("Location: ./index.php");
	}
	?>
	
</script>
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <title>Bill</title>

  <meta name="keywords" content="" />
  <meta name="description" content="" />

  <!-- css -->
  <link rel="stylesheet" href="css/bootstrap.css" />
  <link rel="stylesheet" href="css/bootstrap-responsive.css" />
  <link rel="stylesheet" href="css/prettyPhoto.css" />
  <link rel="stylesheet" href="css/sequence.css" />
  <link rel="stylesheet" href="css/style.css" />

  <!-- Favicon -->
  <link rel="shortcut icon" href="img/favicon.ico">

  <style>
	table{
		align:center;
		margin-top:100px;
		margin-left:150px;
	}
	td {
		
		font-family: Arial;
		font-size: 16px;
		text-align:left;   
		padding: 5px;
		width:200px;	
	}
	.head{
		background:gray;
		color:white;
	}
	.tableHead{
		font-size:30px;
	}

	</style>
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
            <a href="index.html">
              <!-- your logo image -->
				<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"/>
				<i class="icon fas fa-utensils"> </i>
				<h1 style="color:white">Pun-Tastic</h1>
            </a>
          </div>

          <div class="phone">
            <p><?php echo $_SESSION['NAME'];?></p>
          </div>
        </div>
      </div>
      <!-- end top area -->
    </header>
    <!-- end of header-->
	
	<div class="container" >
	<?php $db = mysqli_connect("localhost", "root", "","restaurant") or die("Could not connect to database");?>
	<div>
			<table align="center" cellspacing="0px";>
				<caption class="tableHead">Your Order Details!</caption>
			<tr>	
				<td class="head">Item Name</td>
				<td class="head">Price</td>
				<td class="head">Quantity</td>
				<td class="head">Total</td>
			</tr>
			
			<tr>
			<?php 
			$sr =1;
			$sql = "SELECT * FROM items";
			$result =mysqli_query($db,$sql);
			while($row = mysqli_fetch_assoc($result)) {
			if($row['Quantity']!=0){
			?>
			<tr> 
				<td><?php echo $row['ItemName']; ?></td>
				<td><?php echo $row['Price']; ?></td>
				<td><?php echo $row['Quantity']; ?></td>
				<td><?php echo $row['Price']*$row['Quantity']; ?></td>
			</tr>
			<?php
			}
			}
			?>
			
			<?php
			$sum = 0;
			$sql = "SELECT * FROM items";
			$result =mysqli_query($db,$sql);
			
			while($row = mysqli_fetch_assoc($result)){
				$sum += ($row['Price']*$row['Quantity']);
			}
			?>
			
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>Amount</td>
				<td><?php echo $sum; ?></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>GST:</td>
				<td><?php echo $sum*0.05; ?></td>
			</tr>
			
			<tr>
				<td></td>
				<td></td>
				<td>Total</td>
				<td><?php echo $sum*1.05; ?></td>
			</tr>
			<tr>
				<?php
				$c=$_SESSION['coup'];
				
				if($c=="NEW"){
					if($sum*1.05<200)
						$disc=$sum*1.05;
					else
						$disc=200;
				}
				if($c=="OFFER30"){
					$disc=$sum*1.05*0.3;
				}
				if($c=="TAKE100"){
					if($sum*1.05 < 100)
						$disc=$sum*1.05;
					else
						$disc=100;
				}
				?>
				<td></td>
				<td></td>
				<td>Discount</td>
				<td><?php echo $disc; ?></td>
			</tr>
			
			<tr>
				<td></td>
				<td></td>
				<td><b>Amount to be paid:</b></td></b></td>
				<?php
				$total=$sum*1.05-$disc;
				if($total<0){
				?>
					<td><b>0</b></td>  
				<?php
				}
				else{
				?>
					<td><b><?php echo $total;?></b></td>   
				<?php
				}
				?>
				
				 
			</tr>
			<hr>
			</table>
		</div>
		</div>
		<!--Delivery boy -->
		<div style="margin-top:40px">
		<center>
			<td><h4>Delivery Boy Details</h4></td>
			<?php
				
				$deli = $_SESSION['loca'];
				$dboy=mysqli_fetch_array(mysqli_query($db,"SELECT * from deliveryboy where Location='{$deli}';"));
			?>
			<h4><?php echo "Location: ". $_SESSION['loca'];?></h4>
			<h4><?php echo $dboy['Name'].":".$dboy['ContactNo'] ; ?></h4>
			<form method="post" type="submit">
			<button onclick=" return back();" type="submit" name="back">Go to Cart</button>
			<button onclick=" return death();" type="submit" name="logout">Confirm  Order and Logout</button>
			</form>
		</center>
		</div>
	
    <!-- footer -->
    <footer>
      <div class="footer" style="margin-top:100px;width:100%;">
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
