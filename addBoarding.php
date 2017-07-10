<?php
//////////////////////////////////////////////////////
require 'database/connect.inc.php';
include 'php/add_boarding.php';
//////////////////////////////////////////////////////
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>AccomodateMe-Add a Boarding Place</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
        <link href="css/style_addBoarding_slider.css" rel="stylesheet" type="text/css">
        <link href="css/style_addBoarding.css" rel="stylesheet" type="text/css">
      
    
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Titillium+Web" rel="stylesheet">
  </head>
    
  <body class="nomobile">
    <section id="header">
        <div class="container">            
            <div class="col-md-8 col-md-offset-2">
            	<h1>Add a Boarding place</h1><br><br>
                <form class="login-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                  <div class="form-group">
                      Email:
                      <div class="input-group">
                          <input type="email" class="form-control" placeholder="Type your email" name="email" value="<?php print $email;?>">
                      </div>
                  </div>
                  <div class="form-group">
                      Password:
                      <div class="input-group">
                          <input type="password" class="form-control" placeholder="Type your password" name="password" value="<?php print $password;?>">
                      </div>
                  </div>
                  <div class="form-group">
                      No of Students:
                      <div class="input-group">
                          <input type="number" class="form-control" placeholder="Add No of Students" value="<?php print $studentCount;?>" min="1" name="studentCount">
                      </div>
                  </div>
                  <div class="form-group">
                      Price for Boarding Place:
                      <div class="input-group">
                          <input type="number" class="form-control" placeholder="Add Price for Boarding Place" value="<?php print $price;?>" min="500" step="100" name='price'>
                      </div>
                  </div>
                  <div class="form-group">
                      Distance from University:
                      <div class="input-group">
                          <input type="number" class="form-control" placeholder="Add Distance from University" value="<?php print $distance; ?>" min="100" step="100" name="distance">
                      </div>
                  </div>

                  <div class="form-group">
                      Add Picture of Boarding place:
                      <div class="input-group">
                          <input type="file" class="form-control" placeholder="" name="photo_1">
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="input-group">
                          <input type="file" class="form-control" placeholder="" name="photo_2">
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="input-group">
                          <input type="file" class="form-control" placeholder="" name='photo_3'>
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="input-group">
                          <input type="file" class="form-control" placeholder="" name="photo_4">
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="input-group">
                          <input type="file" class="form-control" placeholder="" name="photo_5">
                      </div>
                  </div>

                  <div class="form-group">
                      <div class="input-group">
                          <button type="submit" class="btn btn-primary" name='submit'>Save Changes</button><span> </span>
                          <button type="reset" class="btn btn-default" style="color:black;">Cancel</button>
                      </div>
                  </div>

              </form>
			</div>
            </div>
        
        
        <!-- START SLIDER -->
        <!--div id="slider" class="rev_slider">
            <ul>
              <li data-transition="slideleft" data-slotamount="1" data-thumb="img/addBoarding/01_1.jpg">
                <img src="img/addBoarding/01_1.jpg">
              </li>
              <li data-transition="slideleft" data-slotamount="1" data-thumb="img/addBoarding/02_1.jpg">
                <img src="img/addBoarding/02_1.jpg">
              </li>
              <li data-transition="slideleft" data-slotamount="1" data-thumb="img/addBoarding/03_1.jpg">
                <img src="img/addBoarding/03_1.jpg">
              </li>
              <li data-transition="slideleft" data-slotamount="1" data-thumb="img/addBoarding/05_1.jpg">
                <img src="img/addBoarding/05_1.jpg">
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