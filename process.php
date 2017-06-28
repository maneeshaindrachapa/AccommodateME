<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>AccomodateMe</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="style_process.css" rel="stylesheet">

    
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Titillium+Web" rel="stylesheet">
  </head>
    
  <body class="nomobile">
    <section id="header">
        <div class="container">
            <header>
                <!-- HEADLINE -->
                <h1 data-animated="GoIn"><b>Welcome <?php echo $_POST["firstName"];?></b> </h1>
            </header>
            <div class="col-md-8 col-md-offset-2">
            	<h4>Search For a Boarding Place</h4><br><br>
				<form class="form-inline" role="form">
				
                      
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="noOfPeople">No of People ----</label>
                        <input type="number" class="form-control" id="noOfPeople" placeholder="Enter Number of People" name="">
                      </div>
                    </div></div>
                    
                <div class="row">
                    <div class="col-md-12">
                    <div class="form-group">
                      <label for="priceForBoarding">Price ----  </label>
                        <input type="number" class="form-control" id="priceForBoarbing" placeholder="Price for Boarding place" name="">
                      </div>
                    </div></div>
                    
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="distanceForBoarding">Distance for Boarding ----</label>
                        <input type="number" class="form-control" id="distanceForBoarding" placeholder="Distance from Boarding" name="">
                      </div>
                    </div></div>
                    <br><br><br> 
				  <button type="submit" class="btn btn-info">Search</button>
				</form>            
			</div>
            
        </div>
        <!-- LAYER OVER THE SLIDER TO MAKE THE WHITE TEXTE READABLE -->
        <div id="layer"></div>
        <!-- END LAYER -->
        
        <!-- START SLIDER -->
        <div id="slider" class="rev_slider">
            <ul>
              <li data-transition="slideleft" data-slotamount="1" data-thumb="img/03.jpg">
                <img src="img/03.jpg">
              </li>
              <li data-transition="slideleft" data-slotamount="1" data-thumb="img/04.jpg">
                <img src="img/04.jpg">
              </li>
              <li data-transition="slideleft" data-slotamount="1" data-thumb="img/05.jpg">
                <img src="img/05.jpg">
              </li>
              <li data-transition="slideleft" data-slotamount="1" data-thumb="img/10.jpg">
                <img src="img/10.jpg">
              </li>
            </ul>
        </div>
        
        <!-- END SLIDER -->
    </section>
 
    <!-- END HEADER -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="js/jquery.1.11.1.js"></script>
	<script type="text/javascript" src="js/modernizr.custom.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/jquery.themepunch.revolution.min.js"></script>
    <script src="js/custom.js"></script>
  </body>
  <!-- END BODY -->
</html>