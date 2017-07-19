<?php
//////////////////////////////////
include_once("php/Crud.php");
//////////////////////////////////
$crud=new Crud();

session_start();
if($_SESSION['email']==''){
    header('location:index.php');
}
if(isset($_GET['boardingID'])){
    $temp = $_GET['boardingID'];
    $_SESSION['boardingID']=$temp;
}
$boardingID=$_SESSION['boardingID'];

$queryBoarding_details=$crud->getData("SELECT * FROM `boarding_details` WHERE boardingID='$boardingID'");
if(sizeof($queryBoarding_details)>0){
        $userID = $queryBoarding_details[0]['userID'];
        $profPicName=$userID.'.jpg';
        $studentCount =$queryBoarding_details[0]['studentCount'];
        $price =$queryBoarding_details[0]['price'];
        $distance =$queryBoarding_details[0]['distance'];
        $address =$queryBoarding_details[0]['address'];
        $boardingFor =$queryBoarding_details[0]['boardingFor'];
        $query_userID =$crud->getData("SELECT * FROM `users` WHERE userID='$userID'");
   
        if (sizeof($query_userID)>0){
            $userName=$query_userID[0]['firstName'].' '.$query_userID[0]['lastName'];
            $email=$query_userID[0]['email'];
            $telephone=$query_userID[0]['telephone'];
        }
        $photo_1='u'.$userID.'b'.$boardingID.'img00.jpg';
        $photo_2='u'.$userID.'b'.$boardingID.'img01.jpg';
        $photo_3='u'.$userID.'b'.$boardingID.'img02.jpg';
        $photo_4='u'.$userID.'b'.$boardingID.'img03.jpg';
        $photo_5='u'.$userID.'b'.$boardingID.'img04.jpg';
    
}

/*finding the student id
=========================*/
$user_email=$_SESSION['email'];
$query_user=$crud->getData("SELECT userID from users WHERE email='$user_email'");
if(sizeof($query_user)>0){
    $studentID = $query_user[0]['userID'];
}

//deactivate button here
/*disable the purchase button
==============================*/
$buttonActivate='disabled';
$query_button=$crud->getData("SELECT isBooked FROM bet_details WHERE boardingID='$boardingID' AND studentID='$studentID'");
if(sizeof($query_button)>0){
        $isBooked=$query_button[0]['isBooked'];
        if($isBooked=='true'){
            $buttonActivate="";
            //activate button here
        }
}

$price_updated=$price;

/*getting the maximum bet value
==============================*/
$query_max=$crud->getData("SELECT betAmount FROM bet_details WHERE boardingID='$boardingID' ORDER BY betAmount DESC");
if(sizeof($query_max)>0){
   $price_updated=$query_max[0]['betAmount'];
}
//=============================


if(isset($_POST['confirmBet'])){
    $betValue=$_POST['betValue'];
    $query_test=$crud->getData("SELECT * FROM bet_details WHERE boardingID='$boardingID' AND studentID='$studentID'");
    print_r($query_test);
    if(sizeof($query_test)==0){
        $query_add =$crud->execute("INSERT INTO bet_details VALUES ($boardingID, $userID, $studentID,$betValue,'false')");
        echo $query_add;
        if($query_add){
            echo '<script>swal("Done", "Your Bet Added Successfully.", "success")</script>';    
            header("location:boardingProfile.php");
        }
    }else{
        $query_test=$crud->execute("UPDATE bet_details SET betAmount='$betValue' WHERE boardingID='$boardingID' and studentID='$studentID'");
        if($query_test){
            echo 'updated successfully';
            header("location:boardingProfile.php");
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AccomodateMe</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/style_boardingProfile.css" rel="stylesheet">
    
    <!--Alerts-->
    <script src="alert/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="alert/sweetalert.css">

</head>

<body>
    <div>
    <div  class="avatar img-circle"></div>
                <style>
                    .avatar{
                        height:250px;
                        width:250px;
                        background-image:url('profPic/<?php echo $profPicName; ?>');
                        background-size:cover;
                        background-position:50% 50%;
                        //background-size: 150px;
                        background-repeat: no-repeat;
                    }
                    .img-circle{
                        float: left;
                        margin: 20px 5% 5px 120px;
                    }
                </style>
        <div class='details'>
            <div class="details leftside">
                <h1>About Owner</h1>
                <h3>Owner's Name : <?php echo $userName; ?></h3>
                <h3>Email : <?php echo $email; ?></h3>
                <h3>Address : <?php echo $address; ?></h3>
                <h3>Telephone : <?php echo $telephone; ?></h3>
            </div>
            <div class="details rightside">  
                <h1>Boarding Details</h1>
                <h3>Boarding For : <?php echo $boardingFor; ?></h3>
                <h3>No of Students : <?php echo $studentCount; ?></h3>
                <h3>Monthly Fee : <?php echo "Rs ".$price; ?></h3>
                <h3>Distance from University : <?php echo $distance.' m'; ?></h3>
            </div>
        </div>
    </div>
    
    <!-- Half Page Image Background Carousel Header -->
    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li>
            <li data-target="#myCarousel" data-slide-to="4"></li>
        </ol>

        <!-- Wrapper for Slides -->
        <div class="carousel-inner">
            <div class="item active">
                <!-- Set the first background image using inline CSS below. -->
                <div class="fill" style="background-image:url('uploads/<?php echo $photo_1; ?>');"></div>
                <div class="carousel-caption">
                    <h3>Caption 1</h3>
                </div>
            </div>
            <div class="item">
                <!-- Set the second background image using inline CSS below. -->
                <div class="fill" style="background-image:url('uploads/<?php echo $photo_2; ?>');"></div>
                <div class="carousel-caption">
                    <h3>Caption 2</h3>
                </div>
            </div>
            <div class="item">
                <!-- Set the third background image using inline CSS below. -->
                <div class="fill" style="background-image:url('uploads/<?php echo $photo_3; ?>');"></div>
                <div class="carousel-caption">
                    <h3>Caption 3</h3>
                </div>
            </div>
            <div class="item active">
                <!-- Set the forth background image using inline CSS below. -->
                <div class="fill" style="background-image:url('uploads/<?php echo $photo_4; ?>');"></div>
                <div class="carousel-caption">
                    <h3>Caption 4</h3>
                </div>
            </div>
            <div class="item active">
                <!-- Set the fifth background image using inline CSS below. -->
                <div class="fill" style="background-image:url('uploads/<?php echo $photo_5; ?>');"></div>
                <div class="carousel-caption">
                    <h3>Caption 5</h3>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>

    </header>

    <!-- Page Content -->
    <form method="post" action="boardingProfile.php">
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-6">
                <label for="boardingBet" style="font-size:20px;color:#fff">Add a bet for the Boarding :&nbsp; </label>
                <input type="number" min="<?php echo $price_updated;?>" step="500" value="<?php echo $price_updated;?>" id="boardingBet" name="betValue" style="padding:10px;">
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <button type="submit" class="btn btn-info" name="confirmBet">Confirm Bet</button>
                
                
                <button type="submit" class="btn btn-info" name="purchaseBoarding" <?php echo $buttonActivate?>><a href="payment/pay.php">Purchase the Boarding</a></button>
        </div><br>
        </div></div>
    </form>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.1.11.1.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>

</body>

</html>
