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
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
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
</head>
<body>

<!-- Modal Form -->
<div id="id01" class="modal-content animate">
    <div class="imgcontainer">
        <span onclick="document.getElementById('id01').style.display='none'; window.location.href='index.php';" class="close" title="Close Modal">&times;</span>
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
                <p><b>Category : </b></p>
                <div class="3u 12u$(small)">
                    <select type="text" id="farmer" name="category">
                        <option value="1">Farmer</option>
                        <option value="0">Buyer</option>
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
        </form>
    </div>
</div>

<script>
    // When the user clicks anywhere outside the modal or clicks the close button, close the modal and redirect
    window.onclick = function(event) {
        var modal = document.getElementById('id01');
        if (event.target == modal || event.target.className == 'close') {
            modal.style.display = "none"; 
            window.location.href = 'index.php'; 
        }
    }
    
    $(document).ready(function(){
        $('a[href="login.php"]').click(function(event){
            event.preventDefault();
            $('#id01').show();  
        });
    });
</script>

</body>
</html>
