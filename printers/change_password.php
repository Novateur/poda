<?php
	ob_start();
	require_once("../includes/db.inc");
	require_once("../includes/functions.php");
	
	if(!isset($_SESSION['username']))
	{
		header("location:login.php");
	}
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
//        error_reporting(E_ALL);
//        ini_set('display_errors', 1);
?>
<!DOCTYPE html>
  <html>
    <head>
        <title>Change Password</title>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="../inc/materialize/css/materialize.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="../css/font-awesome.css"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>        
    </head>
    <body>
        <nav>
            <div class="nav-wrapper container">
                <a href="welcome.php" class="brand-logo">Logo</a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li><a href="welcome.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                        <li><a href="view_orders.php"><i class="fa fa-bar-chart"></i> Orders</a></li>
<!--                        <li class="active"><a href="view.php">View Order</a></li>-->
<!--                        <li><a href="design.php">Design</a></li>-->
                        <li><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
                  </ul>
            </div>
        </nav>

        <div class="container">
			<div class="row">
				<div class="col l3"><h1></h1></div>
				<div class="col l6"><br/>
					<h4>Change Password</h4>
					<div>
						<?php
							if(isset($_POST['submit']))
							{
								echo "You're submitting ooo!!";
							}
						?>
						<form id="myForm" method="post" action="">
							<div id="change_pass_msg"></div><br/>
							Current password<br/>
							<input type="password" name="current_pass" id="current_pass"/><br/>
							New password<br/>
							<input type="password" name="new_pass" id="new_pass"/><br/>
							Confirm new password<br/>
							<input type="password" name="con_new_pass" id="con_new_pass"/><br/>
							<button type="submit" name="submit">Submit</button>
						</form>
					</div>
				</div>
				<div class="col l3"></div>
			</div>
    
        
        </div>
			    	    
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="../inc/jQuery/jquery.js"></script>
      <script type="text/javascript" src="../inc/materialize/js/materialize.min.js"></script>
      <script type="text/javascript" src="../js/main.js"></script>
      <script>
        $('.button-collapse').sideNav();
        $('.modal-trigger').leanModal();
		
		$(document).ready(function(){
			get_cities();
		})
		$('#myForm').submit(function(e){
			e.preventDefault();
			var current_pass,new_pass,con_new_pass;
			current_pass = $('#current_pass').val();
			new_pass = $('#new_pass').val();
			con_new_pass = $('#con_new_pass').val();
			if(current_pass=="" || new_pass=="" || con_new_pass=="")
			{
				if(current_pass=="")
				{
					document.getElementById("current_pass").style.border="1px solid red";
				}				
				if(new_pass=="")
				{
					document.getElementById("new_pass").style.border="1px solid red";
				}				
				if(con_new_pass=="")
				{
					document.getElementById("con_new_pass").style.border="1px solid red";
				}
			}
			else
			{
				if(new_pass == con_new_pass)
				{
					$.ajax({
						url:"handler/change_password.php",
						type:"POST",
						data: new FormData(this),
						cache:false,
						contentType:false,
						processData:false,
						success:function(data)
						{
							if(data=="updated")
							{
								Materialize.toast("Your password has been changed successfully",8000);
							}
							else
							{
								Materialize.toast(data,8000);
							}
						}
					})
				}
				else
				{
					Materialize.toast("Password mismatched",5000);
				}
			}
		})
      </script>
    </body>
  </html>
