<?php
//////////////////////////////////
include_once("Crud.php");
//////////////////////////////////
session_start();

$crud=new Crud();

/*setting the profile picture
==============================*/
$email=$_SESSION['email'];

$query="SELECT * FROM users WHERE email='$email'";
if($query_run=mysqli_query($db, $query)){
    while ($row = mysqli_fetch_assoc($query_run)) {
        $userID=$row['userID'];
        $firstName=$row['firstName'];
        $imageID='u'.$userID.'.jpg';
        $location='profPic/'.$imageID;
    }
}
/*search boarding part
======================*/
if(isset($_POST['search_boarding'])){
    $studentCount=(int)$_POST['studentCount'];
    $price=(int)$_POST['price'];
    $distance=(int)$_POST['distance'];
    $boardingArray=array();

    $query_count="SELECT * FROM `boarding_details` WHERE studentCount='$studentCount'";
    if(!is_null(mysqli_query($db, $query_count))) {
        if ($query = mysqli_query($db, $query_count)) {
            while ($row = mysqli_fetch_assoc($query)) {
                $boardingID = $row['boardingID'];
                $boardingPrice=(int)$row['price'];
                $boardingDistance=(int)$row['distance'];

                if(($price-500<=$boardingPrice)&&($boardingPrice<=$price+500)){
                    if(($distance-100<=$boardingDistance)&&($boardingDistance<=$distance+100)){
                        array_push($boardingArray,$boardingID);
                    }
                }
            }
        }
    }
    if(!empty($boardingArray)){
        //print_r($boardingArray);
        $_SESSION['boardingArray']=$boardingArray;
        //print_r($_SESSION);
        header("location:searchResult.php");
    }else{
        echo 'no results found!';
    }
}
?>
