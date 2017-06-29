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
                <h1 data-animated="GoIn"><b>Welcome 
                    
                    <?php
                    //////////////////////////////////////////////////////////
                    if(strlen($_POST["password"])>=8){
                    
                    if(isset($_POST["firstName"]) & isset($_POST["lastName"])& isset($_POST["e_mail"]) & isset($_POST["password"]) & isset($_POST["rPassword"]) & isset($_POST["boarding-owner-or-searcher"])){
                        if($_POST["password"]!=$_POST["rPassword"]){
                            header("Location:index.php");
                            exit;
                        }
                        else{echo $_POST["firstName"];}}
                    else{
                        header("Location:index.php");
                        exit;
                    }}
                    else{
                       header("Location:index.php");
                        exit; 
                    }
                    //////////////////////////////////////////////////////////
                    ?></b> </h1>
                
            </header>
                <?php
                ///////////////////////////////////////////////////////////////
                    /*$target_dir="uploads/";
                    $target_file=$target_dir.basename($_FILES["profilepicture"]["name"]);
                    $uploadOk=1;
                    $imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);*/
            
                    //check if image file is actual
                   /* if(isset($_POST["submit"])){
                        $check=getimagesize($_FILES["profilepicture"]["tmp_name"]);
                        if($check!==flase){
                            echo "file is an image".$check["mime"].".";
                            $uploadOK=1;
                        }else{
                            echo "file is not an image";
                            $uploadOK=0;
                        }
                        //check if file already exsits
                        if($_FILES["profilepicture"]["size"]>500000){
                            echo "Sorry file is too large";
                            $uploadOK=0;
                        }
                    }*/
                ///////////////////////////////////////////////////////////////
                ?>
            
            <div class="col-md-8 col-md-offset-2">
                <img src="img/team/02.jpg" id="profilePic" width="150px" height="150px">
                <style>#profilePic{
                    border-radius: 100%;
                    transform: scale(1);
                    transition-duration: 0.2s;
                    }
                    #profilePic:hover{
                        transform: scale(1.2);
                        transition-duration: 0.2s;            
                        }
                </style>
                <br><br>
                
            	<h4>Search For a Boarding Place</h4><br><br>
				<form class="form-inline" role="form">
				
                      
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="noOfPeople">No of People ----</label>
                        <input type="number" min="1"  class="form-control" id="noOfPeople" placeholder="Enter Number of People" name="" value="1">
                      </div>
                    </div></div>
                    
                <div class="row">
                    <div class="col-md-12">
                    <div class="form-group">
                      <label for="priceForBoarding">Price ----  </label>
                        <input type="number" min="1000" step="500" class="form-control" id="priceForBoarbing" placeholder="Price for Boarding place" name="" value="1000">
                      </div>
                    </div></div>
                    
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="distanceForBoarding">Distance for Boarding ----</label>
                        <input type="number" min="100" step="100" class="form-control" id="distanceForBoarding" placeholder="Distance from Boarding" name="" value="100">
                      </div>
                    </div></div>
                    <br><br><br> 
				  <button type="button" class="btn btn-info">Search</button>
				</form>            
			</div>
            
        </div>
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