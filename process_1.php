<?php
////////////////////////////////////////////////////
require 'database/connect.inc.php';

session_start();
$emailprof=$_SESSION['email'];

$sql4 = "SELECT profPic FROM users WHERE email='$emailprof' ";
$result4 = $db->query($sql4);
$row4 = mysqli_fetch_assoc($result4);
$profile=$row4['profPic'];
////////////////////////////////////////////////////
?>



<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>AccomodateMe</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="css/style_process.css" rel="stylesheet" type="text/css">
      
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
  </head>
    
  <body class="nomobile">
    <section id="header">
        <div style="float:right" class='log_out'>
            <form align="right" name="form1" method="post" action="php/logout.php">
              <label class="logoutLblPos">
                  <button name="log_out" type="submit" id="log_out" class="btn btn-info">Log Out</button>
              </label>
            </form>
            </div>
        <div class="container">
            <header>
                <!-- HEADLINE -->
                <h1 data-animated="GoIn"><b>Welcome!
                </b></h1>
                
            </header>
            <div class="col-md-8 col-md-offset-2">
            
            <!--profile pic-->    
                <div class="wrap">
                    <div class="sideA"></div>
                    <a href="profile.php"><div class="sideB"></div></a>
                </div>
                <style>
                        .wrap{
                        margin: auto;
                        width: 150px;
                        height: 150px;
                        cursor: pointer;
                    }

                    .wrap div{
                        width:150px;
                        height:150px;
                        border-radius: 100%;
                        background-position:50% 50%;
                        background-size: 150px;
                        background-repeat: no-repeat;
                        box-shadow:inset 0 0 45px rgba(255,255,255,0.3) , 0 12px 20px -10px rgba(0,0,0,0.4)  ;
                    }

                    .sideA{
                        background-image: url("profPic/<?php echo $profile;?>");
                        background-size:cover;
                    }

                    .sideB{
                        background-image: url("img/editProfile.jpg");
                        background-size: cover;
                    }

                    /*Transitions for the wallpapers*/
                    body{
                        -webkit-perspective: 800px;
                    }

                    .wrap div{
                        position: absolute;
                        -webkit-backface-visibility: hidden;
                    }

                    .sideA{
                        z-index: 100;
                    }
                    .sideB{
                        -webkit-transform: rotateY(-180deg);
                    }
                    .wrap{
                        transition:-webkit-transform 0.2s ease-in ;
                        -webkit-transform-style: preserve-3D;

                    }
                    .wrap:hover{
                        -webkit-transform:rotateY(180deg);
                    }
                </style>
            <!--------------->
                <h3 class='addboarding_link'><a href=addBoarding.php>Add a Boarding Place</a></h3><br>
                <style>
                    .addboarding_link{
                        transform: scale(1.0);
                        transition-duration: 0.2s;
                    }
                    .addboarding_link:hover{
                        transform: scale(1.2);
                        transition-duration: 0.2s;
                    }
                </style>
            	<h4>Search For a Boarding Place</h4><br>
				<form class="form-inline" role="form">
				
                      
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="noOfPeople">No of People :</label>
                        <input type="number" min="1"  class="form-control" id="noOfPeople" placeholder="Enter Number of People" name="" value="1">
                      </div>
                    </div></div>
                    
                <div class="row">
                    <div class="col-md-12">
                    <div class="form-group">
                      <label for="priceForBoarding">Price: </label>
                        <input type="number" min="1000" step="500" class="form-control" id="priceForBoarbing" placeholder="Price for Boarding place" name="" value="1000">
                      </div>
                    </div></div>
                    
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="distanceForBoarding">Distance for Boarding:</label>
                        <input type="number" min="100" step="100" class="form-control" id="distanceForBoarding" placeholder="Distance from Boarding" name="" value="100">
                      </div>
                    </div></div>
                    <br> 
				  <button type="button" class="btn btn-info">Search</button>
				</form>            
			</div>
            </div>
        
        
        <!-- START SLIDER -->
        <div id="slider" class="rev_slider">
            <ul>
              <li data-transition="slideleft" data-slotamount="1" data-thumb="img/slider/01.jpg">
                <img src="img/slider/01.jpg">
              </li>
              <li data-transition="slideleft" data-slotamount="1" data-thumb="img/slider/02.jpg">
                <img src="img/slider/02.jpg">
              </li>
              <li data-transition="slideleft" data-slotamount="1" data-thumb="img/slider/03.jpg">
                <img src="img/slider/03.jpg">
              </li>
              <li data-transition="slideleft" data-slotamount="1" data-thumb="img/slider/04.jpg">
                <img src="img/slider/04.jpg">
              </li>
            </ul>
        </div>
        
    <!-- END SLIDER -->
    </section>
  </body>
  <!-- END BODY -->
     <!-- Bootstrap core JavaScript
    ================================================== -->
      
    <script src="js/jquery.1.11.1.js"></script>
	<script type="text/javascript" src="js/modernizr.custom.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/jquery.themepunch.revolution.min.js"></script>
    <script src="js/custom.js"></script>
</html>