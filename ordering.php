<script language="javascript">
	function checkinput(){
				var location = document.getElementById("location").value;
				var coupon = document.getElementById("coupon").value;
				
				if(location.length==0){
					alert("Please Do Enter Location");
					return false;
				}
				var flag =0;
				for(var i=1;i<=16;i++){
				var q = document.getElementById(i).value;
				if(q!=0){
					flag=1;
				}
				}
				if(flag==0){
				alert("Please select at least one item");
				return false;
				}
				
				if(coupon.length==0){
					alert("Please Do Enter Coupon");
					return false;
				}
			   
				
			}
			alert("You are logged in");
			<?php
				session_start();
				if(isset($_POST['order'])){
					$db = mysqli_connect("localhost", "root", "","restaurant") or die("Could not connect to database");
					$i=1;
					$_SESSION['loca']=$_POST['location'];
					$_SESSION['coup']=$_POST['coupon'];
					
					for($b=1;$b<=16;$b++){
						$a=$_POST[$i++];
						$x=mysqli_query($db,"UPDATE `items` SET `Quantity`= $a WHERE No=$b;");
						if($x){
							header("Location: ./bill.php");
						}
					}
				}
?>
</script>
			

<html>
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <title>Order</title>

  <meta name="keywords" content="" />
  <meta name="description" content="" />

  <!-- css -->
  <link rel="stylesheet" href="css/bootstrap.css" />
  <link rel="stylesheet" href="css/bootstrap-responsive.css" />
  <link rel="stylesheet" href="css/prettyPhoto.css" />
  <link rel="stylesheet" href="css/sequence.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/stylem.css" />

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
            <p><?php echo $_SESSION['NAME'];?></p>
          </div>
        </div>
      </div>
      <!-- end top area -->
    </header>
    <!-- end of header-->

	<div class="menu-body" >
	
		<form action="ordering.php" method="POST" onsubmit="return checkinput();">
			<div class="menu-item" style="margin-top:150px;"> 
				<h2 style="color:black;text-align:center;font-size:35px;"><u>ORDERING MENU</u></h2>
				<select style="width:670px;" name="location" id="location">
					<option value="">Enter Your Location (only in VASAI)</option>
					<option value="VasantNagar">VasantNagar</option>
					<option value="Evershine">Evershine</option>
					<option value="Suncity">Suncity</option>
					<option value="JDNagar">JDNagar</option>
				</select>
			</div>
			<?php
			$db = mysqli_connect("localhost", "root", "","restaurant") or die("Could not connect to database");
			$result=mysqli_query($db,"Select * from items;");
			while($row=mysqli_fetch_array($result)){
			?>
			
			<!-- Item starts -->
			<div class="menu-item">
				<div class="menu-item-name">
						<?php echo $row['No']; ?> <?php echo $row['ItemName']; ?>
				</div>

				<div class="menu-item-price">
					<?php echo $row['Price']; ?>
				</div>
			
				<div style="float:right;">
				<select style="width:60px;height:30px;margin-right:-30px;" name="<?php echo $row['No']; ?>" id="<?php echo $row['No']; ?>"> 
					<option value="0">Qty.</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
				</select>
				</div>
			</div>
			<?php
			}
			?>
			<div class="menu-item" style="margin-top:150px;width:1000px;">
				<select style="width:670px;" name="coupon" id="coupon">
					<option value="">Enter Coupon code</option>
					<?php
					$new=$_SESSION['NAME'];
					$db = mysqli_connect("localhost", "root", "","restaurant") or die("Could not connect to database");
					$myrow = mysqli_fetch_assoc(mysqli_query($db,"Select * from user_info where EmailID ='{$new}';"));
					$my=$myrow['myorder'];
					
					if($my==0){
					?>
						<option value="NEW">FIRST200...200 OFF ON TOTAL AMOUNT</option>
					<?php
					}
					?>
					
					<option value="OFFER30">OFFER30...30% OFF ON TOTAL AMOUNT</option>
					<option value="TAKE100">TAKE100...100 OFF ON TOTAL AMOUNT</option> 
				</select>
			</div>
		<button style="width:200px;margin:0 auto;" type="submit" name="order" id="Check">Place Order</button>
		</form>
	</div>	
	<footer>
      <div class="footer" style="margin-top:50px;">
        <div class="wrapper">
           <div class="subfooter">
            <p class="copyright">&#169; Copyright. All rights reserved</p>
          </div>
        </div>
      </div>
    </footer>
</div>
</body>
