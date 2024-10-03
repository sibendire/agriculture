<?php session_start();
	require 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>AgroPreneur Farm System</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href="bootstrap\css\bootstrap.min.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="bootstrap\js\bootstrap.min.js"></script>
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="login.css"/>
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
		</noscript>
		<link rel="stylesheet" href="indexfooter.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
	</head>

	<body class>

		<?php
			require 'menu.php';
			function dataFilter($data)
			{
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
		?>

		<!-- One -->
			<section id="main" class="  style1 align-center" >
				<div class="container">
				<h2 style="text-align: center; color: #006600; font-size:32px"> AGROPRENEUR DIGITAL MAR</h2>
				<p style="text-align: center; font-size: 18px; line-height: 1.6; color: #333; border:1px solid #006600; background:#006600; color:white; font-size:18px">Welcome to AgroPreneur, 
				the premier digital marketplace revolutionizing agribusiness. 
				Connect with farmers, suppliers, and buyers seamlessly.<br> 
				Our user-friendly interface and robust security ensure endless opportunities for growth. 
				<br>Join us and embark on a journey of innovation and prosperity in agriculture.</p>
				

				<?php
					if(isset($_GET['n']) AND $_GET['n'] == 1):
				?>
					<h3>Select Filter</h3>
					<form method="GET" action="productMenu.php?">
						<input type="text" value="1" name="n" style="display: none;"/>
						<center>
							<div class="row">
							<div class="col-sm-4"></div>
							<div class="col-sm-2">
								<div class="select-wrapper" style="width: auto" >
									<select name="type" id="type" required style="background-color:white;color: black;">
										<option value="all" style="color: black;">List All</option>
										<option value="fruit" style="color: black;">Fruit</option>
										<option value="vegetable" style="color: black;">Vegetable</option>
										<option value="grain" style="color: black;">Grains</option>
										<option value="animals" style="color: black;">Animals</option>
									</select>
							  	</div>
							</div>
							<div class="col-sm-2">
								<input class="button special" type="submit" value="Go!" />
							</div>
							<div class="col-sm-4"></div>
						</div>
						</center>
					</form>
				<?php endif; ?>

				<section id="two" class="  style2 align-center">
				<div class="container">
				<?php
					if(!isset($_GET['type']) OR $_GET['type'] == "all")
					{
					 	$sql = "SELECT * FROM fproduct WHERE 1";
					}
				    if(isset($_GET['type']) AND $_GET['type'] == "fruit")
					{
						$sql = "SELECT * FROM fproduct WHERE pcat = 'Fruit'";
					}
					if(isset($_GET['type']) AND $_GET['type'] == "vegetable")
					{
						$sql = "SELECT * FROM fproduct WHERE pcat = 'Vegetable'";
					}
					if(isset($_GET['type']) AND $_GET['type'] == "animals")
					{
						$sql = "SELECT * FROM fproduct WHERE pcat = 'Animals'";
					}
					
					if(isset($_GET['type']) AND $_GET['type'] == "grain")
					{
						$sql = "SELECT * FROM fproduct WHERE pcat = 'Grains'";
					}
					$result = mysqli_query($conn, $sql);

					?>
					<div class="row">
					<?php

						while($row = $result->fetch_array()):
							$picDestination = "images/productImages/".$row['pimage'];
						?>
							<div class="col-md-4">
							<section>
							<strong><h2 class="title" style="color:black; "><?php echo $row['product'].'';?></h2></strong>
							<a href="addToCart.php?pid=<?php echo $row['pid'] ;?>" > <img class="image fit" src="<?php echo $picDestination;?>" height="220px;"  /></a>
                            
                          
							<div style="align: left">
							<?php echo "Number : ".$row['pnumber'];?></blockquote>

							<div style="align: left">
							<blockquote><?php echo "Type : ".$row['pcat'].'';?><br><?php echo "Price : ".$row['price'].' /-';?><br></blockquote>
							
							<button onclick="window.location.href='addToCart.php?pid=<?php echo $row['pid']; ?>'">Add To Cart</button>

							
                            
						</section>
						</div>

						<?php endwhile;	?>


					</div>

			</section>
					</header>

			</section>

	</body>

		<!-- Banner -->
			<section id="banner" class="wrapper">
				<!-- <div class="container">
				<h2>Welcome to AgroPreneur Farm System</h2>
				<p>Your Product, Our Market</p>
				<br>  -->
				<center>
					<div class="row uniform">
						<div class="6u 12u$(xsmall)">
							<button class="button fit" onclick="document.getElementById('id01').style.display='block'" style="width:auto">LOGIN</button>
						</div>

						<div class="6u 12u$(xsmall)">
							<button class="button fit" onclick="document.getElementById('id02').style.display='block'" style="width:auto">REGISTER</button>
						</div>
					</div>
				</center>


			</section>

		 

		<!-- Footer -->
		<footer class="footer-distributed" style="background-color:black" id="aboutUs">
		<center>
			<h1 style="font: 35px calibri;">About Us</h1>
		</center>
		<div class="footer-left">
			<h3 style="font-family: 'Times New Roman', cursive;">AgroPreneur &copy; 2024</h3>
		<!--	<div class="logo">
			
				<a href="index.php"><img src="images/logo.png" width="200px"></a>
			</div>-->
			<br />
			<p style="font-size:20px;color:white">Your product Our market !!!</p>
			<p style="font-size:20px;color:white">By Kephas and Friends</p>
			<br />
			
		</div>

		<div class="footer-center">
			<div>
				<i class="fa fa-map-marker"></i>
				<p style="font-size:20px">Agro Preneur Farm<span></span></p>
			</div>
			<div>
				<i class="fa fa-phone"></i>
				<p style="font-size:20px">0789742831</p>
			</div>
			<div>
				<i class="fa fa-phone"></i>
				<p style="font-size:20px">0789311009</p>
			</div>
			 
		</div>

		<div class="footer-right">
			<p class="footer-company-about" style="color:white">
				<span style="font-size:20px"><b>About AgroPreneur</b></span>
				AgroPreneur is an e-commerce trading platform for grains & groceries...
			</p>
			<div class="footer-icons">
				<a href="#"><i style="margin-left: 0;margin-top:5px;" class="fa fa-facebook"></i></a>
				<a href="#"><i style="margin-left: 0;margin-top:5px" class="fa fa-instagram"></i></a>
				<a href="#"><i style="margin-left: 0;margin-top:5px" class="fa fa-youtube"></i></a>
			</div>
		</div>

	</footer>


			<div id="id01" class="modal">

  <form class="modal-content animate" action="Login/login.php" method='POST'>
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>

    <div class="container">
    <h3>Login</h3>
							<form method="post" action="Login/login.php">
								<div class="row uniform 50%">
									<div class="7u$">
										<input type="text" name="uname" id="uname" value="" placeholder="UserName" style="width:80%" required/>
									</div>
									<div class="7u$">
										<input type="password" name="pass" id="pass" value="" placeholder="Password" style="width:80%" required/>
									</div>
								</div>
									<div class="row uniform">
										<p>
				                            <b>Category : </b>
				                        </p>
				                        <div class="3u 12u$(small)"> 
												<select type="text" id="farmer" name="category">
													<option value="1">Farmer</option>
													<!-- <option value="0">Buyer</option> -->
												</select>	
				                        </div>
				                        
									</div>
									<center>
									<div class="row uniform">
										<div class="7u 12u$(small)">
											<input type="submit" value="Login" />
										</div>
									</div>
									</center>
								</div>
							</form>
						</section>
</div>
    </div>
    </div>
  </form>
</div>


<div id="id02" class="modal">

  <form class="modal-content animate" action="Login/signUp.php" method='POST'>
    <div class="imgcontainer">
      <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>

    <div class="container">

<section>
<h3>SignUp</h3>
<form method="post" action="Login/signUp.php" enctype="multipart/form-data">
    <center>
        <div class="row uniform">
            <div class="3u 12u$(xsmall)">
                <input type="text" name="name" id="name" placeholder="Name" required />
            </div>
            <div class="3u 12u$(xsmall)">
                <input type="text" name="uname" id="uname" placeholder="UserName" required />
            </div>
        </div>
        <div class="row uniform">
            <div class="3u 12u$(xsmall)">
                <input type="text" name="mobile" id="mobile" placeholder="Mobile Number" required />
            </div>
            <div class="3u 12u$(xsmall)">
                <input type="email" name="email" id="email" placeholder="Email" required />
            </div>
        </div>
        <div class="row uniform">
            <div class="3u 12u$(xsmall)">
                <input type="password" name="password" id="password" placeholder="Password" required />
            </div>
            <div class="3u 12u$(xsmall)">
                <input type="password" name="pass" id="pass" placeholder="Retype Password" required />
            </div>
        </div>
        <div class="row uniform">
            <div class="6u 12u$(xsmall)">
                <input type="text" name="addr" id="addr" placeholder="Address" style="width:80%" required />
            </div>
        </div>
        <div class="row uniform">
            <label for="picName">Upload your profile photo</label>
            <div class="6u 12u$(xsmall)">
                <input type="file" name="profilePic" id="picName" style="width:80%" required />
            </div>
        </div>
        <div class="row uniform">
            <p><b>Category: </b></p>
            <div class="3u 12u$(small)">
                <select id="farmer" name="category">
                    <option value="1">Farmer</option>
                </select>
            </div>
        </div>
        <div class="row uniform">
            <div class="3u 12u$(small)">
                <input type="submit" value="Submit" name="submit" class="special" />
            </div>
            <div class="3u 12u$(small)">
                <input type="reset" value="Reset" name="reset" />
            </div>
        </div>
    </center>
</form>

</div>



<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

var modal1 = document.getElementById('id02');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal1) {
        modal1.style.display = "none";
    }
}

        // JavaScript to handle the modal
        $(document).ready(function(){
            $('a[href="login.php"]').click(function(event){
                event.preventDefault();
                $('id01').modal('show');
            });
        });
  

</script>


	</body>
</html>
