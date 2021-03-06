<?php
	ob_start();
	require_once("../includes/db.inc");
	require_once("../includes/functions.php");
	
	if(!isset($_SESSION['username']))
	{
		header("location:../login.php");
	}
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
//        error_reporting(E_ALL);
//        ini_set('display_errors', 1);
?>
<!DOCTYPE html>
  <html>
    <head>
        <title>View Order</title>
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
                        <li><a href="register.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                        <li><a href="register.php"><i class="fa fa-bar-chart"></i> Orders</a></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
                  </ul>
            </div>
        </nav>

        <div class="container">
			<div class="row">
				<div class="col l2"><h1></h1></div>
				<div class="col l8"><br/>
					<h4>Company Details</h4>
					<div>
						<?php
							if(isset($_POST['submit']))
							{
								$name = sanitize($_POST['company_name']);
								$telephone = sanitize($_POST['telephone']);
								$email = sanitize($_POST['email']);
								if($name=="" || $telephone=="" || $email=="")
								{
									echo "All fileds are required";
								}
								else
								{
									$sql = "UPDATE printers SET company_name='{$name}',telephone='{$telephone}',email='{$email}' WHERE email='{$_SESSION['username']}'";
									$query = $connection->query($sql);
									if($query)
									{
										echo "Records updated successfully";
									}
								}
							}
							get_printer_profile();
						?>
					</div>
				</div>
				<div class="col l2"></div>
			</div>
    
        
        </div>
		    <div id="delete_modal" class="modal">
                <div class="modal-content">
                    <h5>
                        Delete city
                    </h5>
                    <p>
						Do you really want to delete this city ?
                    </p>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="modal-action modal-close waves-effect waves btn-flat">Cancel</button>
                    <span id="paste_btn"></span>
                </div>
                    </form>
            </div>			    
			<div id="multi_del_modal" class="modal">
                <div class="modal-content">
                    <h5>
                        Delete cities
                    </h5>
                    <p>
						Do you really want to perform a multiple delete action,once you proceed with this action
						there is no going back
                    </p>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="modal-action modal-close waves-effect waves btn-flat">Cancel</button>
                    <span id="paste_btn_multi"></span>
                </div>
                    </form>
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

      </script>
    </body>
  </html>
