<?php
	ob_start();
    include 'wcaccess.php';
	require_once("includes/db.inc");
	require_once("includes/functions.php");
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
      <link type="text/css" rel="stylesheet" href="inc/materialize/css/materialize.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="css/font-awesome.css"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>        
    </head>
    <body>
        <nav>
            <div class="nav-wrapper container">
                <a href="#" class="brand-logo">Logo</a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li><a href="index.php">Timeline</a></li>
<!--                        <li class="active"><a href="view.php">View Order</a></li>-->
<!--                        <li><a href="design.php">Design</a></li>-->
                        <li><a href="register.php">Register</a></li>
                  </ul>
            </div>
        </nav>

        <div class="container">
			<div class="row">    			
				<div class="col s12"><br/>
					<h3>States</h3>
					<div id="paste_states">
					
					</div>
				</div>            
			</div>
    
        
        </div>
		    <div id="delete_modal" class="modal">
                <div class="modal-content">
                    <h5>
                        Delete state
                    </h5>
                    <p>
						Do you really want to delete this state ?
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
                        Delete states
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
      <script type="text/javascript" src="inc/jQuery/jquery.js"></script>
      <script type="text/javascript" src="inc/materialize/js/materialize.min.js"></script>
      <script type="text/javascript" src="js/main.js"></script>
      <script>
        $('.button-collapse').sideNav();
        $('.modal-trigger').leanModal();
		
		$(document).ready(function(){
			get_states();
		})

      </script>
    </body>
  </html>
