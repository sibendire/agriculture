<?php
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1) {
    $loginProfile = "My Profile: " . $_SESSION['Username'];
    $link = "profileView.php";
} else {
    $loginProfile = "Login";
    $link = "#"; // Link to nowhere, since the modal will be triggered
}
$logo = "glyphicon glyphicon-log-in"; // Assuming this is your login icon
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgroPreneur Farm System</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body class="subpage">
    <!-- Header -->
    <header id="header" class="alt">
        <div class="logo">
            <a href="index.php"><img src="images/logo.png" height="40px" width="40px"></a>
        </div>
        <a href="#menu"></a>
        <span><font color="white"><b>MENU</b></font></span>
    </header>

    <!-- Nav -->
    <nav id="menu">
        <ul class="links">
            <li id="loginLink"><a href="login.ph"><?php echo $loginProfile; ?></a></li>
            <li><a href="index.php">Home</a></li>
            <!-- Other menu items -->
        </ul>
    </nav>

    <!-- Login Modal -->
    <div id="loginModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Login</h4>
                </div>
                <div class="modal-body">
                  
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
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#loginLink').click(function(event){
                event.preventDefault(); // Prevent the default action of the link
                $('#loginModal').modal('show'); // Show the login modal
            });
        });
    </script>
</body>
</html>
