<?php
/////////////////////////////////////
include_once("php/Crud.php");
/////////////////////////////////////
$crud=new Crud();

session_start();
$boardingList=$_SESSION['boardingArray'];
//print_r($boardingList);

if(isset($_POST['search_boarding'])){
    $studentCount=(int)$_POST['studentCount'];
    $price=(int)$_POST['price'];
    $distance=(int)$_POST['distance'];
    $for=$_POST['for'];
    $boardingArray=array();

    $query_count=$crud->getData("SELECT * FROM `boarding_details` WHERE studentCount='$studentCount'AND boardingFor='$for'");
    print_r($query_count);
    if(sizeof($query_count)>0) {
        for($x=0;$x<sizeof($query_count);$x++){
            $boardingID = $query_count[$x]['boardingID'];
            $boardingPrice=(int)$query_count[$x]['price'];
            $boardingDistance=(int)$query_count[$x]['distance'];

            if(($price==0)&&($distance==0)){
                array_push($boardingArray,$boardingID);
            }

            if(($price!=0)&&($distance==0)){
                if(($price-500<=$boardingPrice)&&($boardingPrice<=$price+500)) {
                    array_push($boardingArray, $boardingID);
                }
            }

            if(($price==0)&&($distance!=0)){
                if(($distance-100<=$boardingDistance)&&($boardingDistance<=$distance+100)){
                    array_push($boardingArray,$boardingID);
                }
            }

            if(($price!=0)&&($distance!=0)) {
                if (($price - 500 <= $boardingPrice) && ($boardingPrice <= $price + 500)) {
                    if (($distance - 100 <= $boardingDistance) && ($boardingDistance <= $distance + 100)) {
                        array_push($boardingArray, $boardingID);
                    }
                }
            }
        }
    }
    if(!empty($boardingArray)){
        $_SESSION['boardingArray']=$boardingArray;
        //print_r($_SESSION);
        header("location:searchResult.php");
    }else{
        echo "No result Found";
        $_SESSION['boardingArray']=$boardingArray;
        print_r($_SESSION);
        header("location:searchResult.php");
    }
}


?>

<!DOCTYPE html>
<html class="am-sr">
<head>


    <!-- Meta info -->
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AccomodateMe-Search Results</title>

    <!-- Styles -->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="css/styles_searchResults.css" rel="stylesheet" media="screen, print" type="text/css">
    
    
    
</head>
    
<body class="nomobile">
    <header>
            <h1 data-animated="GoIn"><b>Search Results 
            </b></h1>
    </header>
    <div id="container" class="contain">
        <section id="content">
            <!--slider--
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
        </div><!--end slider-->
            

<div id="search-res">
    <ul>
    <?php
    $boardinCount=sizeof($boardingList);
    for($temp=0; $temp<$boardinCount; $temp++) {
        $boardingID=$boardingList[$temp];
        //echo 'boardingID :'.$boardingID.'<br>';
        $query =$crud->getData("SELECT * FROM `boarding_details` WHERE boardingID='$boardingID'");
        if (sizeof($query)>0) {
           for($x=0;$x<sizeof($query);$x++){
                $userID = $query[$x]['userID'];
                $studentCount=$query[$x]['studentCount'];
                $price=$query[$x]['price'];
                $distance=$query[$x]['distance'];
                $address=$query[$x]['address'];
                $boardingFor=$query[$x]['boardingFor'];

                $imageName='u'.$userID.'b'.$boardingID.'img00.jpg';
                $location="uploads/$imageName";
                echo '<li><a href="boardingProfile.php?boardingID='.$boardingID.'"><div style="background-image:url('.$location.')" class="boardingImage"></div>
                      <div class="overlay">
                        <summary>
                            <h4><u><strong>Boarding Details</strong></u></h4>
                            <h5>'.'Boarding For : '.$boardingFor.'</h5>
                            <h5>'.'Number of Student : '.$studentCount.'</h5>
                            <h5>'.'Monthly Fee : Rs.'.$price.'</h5>
                            <h5>'.'Distance : '.$distance.' m '.'</h5>
                        </summary>
                      <div class="addCart">
                        <h2><i class="fa fa-shopping-cart" aria-hidden="true"></i></h2>
                      </div></div></a></li>';
            }
        }
    }
        ?>

</ul>
</div>
        
        <div class="col-md-8 col-md-offset-2">
        
        <h3 class="row">Search For a Boarding Place</h3><br>
				<form class="form-inline" role="form" method="post">
				<div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="boardingFor">For :&nbsp; </label>
                                <select class="form-control" name="for" id="boardingFor">
                                    <option value="Boys" name="forBoys">Boys</option>
                                    <option value="Girls" name="forGirls">Girls</option>
                                </select>
                            </div>
                        </div></div>
                      
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="noOfPeople">No of People :&nbsp;</label>
                        <input type="number" min="1"  class="form-control" id="noOfPeople" placeholder="Enter Number of People" name="studentCount" value="1">
                      </div>
                    </div></div>
                    
                <div class="row">
                    <div class="col-md-12">
                    <div class="form-group">
                      <label for="priceForBoarding">Price:&nbsp; </label>
                        <input type="number" min="1000" step="500" class="form-control" id="priceForBoarbing" placeholder="Optional" name="price" value="">
                      </div>
                    </div></div>
                    
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="distanceForBoarding">Distance for Boarding:&nbsp;</label>
                        <input type="number" min="100" step="100" class="form-control" id="distanceForBoarding" placeholder="Optional" name="distance" value="">
                      </div>
                    </div></div>
                    <br>
                    <div class="row">
                        <button type="submit" class="btn btn-info" name="search_boarding">Search</button></div>
				</form><br><br>
        </div> 
</section>
           
    </div><br><br><!-- container -->
    
</body>
    <!-----------Js-------------->
    <script src="https://use.fontawesome.com/124cbd186f.js"></script>
     <script src="js/jquery.1.11.1.js"></script>
	<script type="text/javascript" src="js/modernizr.custom.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/jquery.themepunch.revolution.min.js"></script>
    <script src="js/custom.js"></script>
    
</html>