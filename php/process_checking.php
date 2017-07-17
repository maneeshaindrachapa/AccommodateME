<?php
//////////////////////////////////
include_once("Crud.php");
//////////////////////////////////
$crud=new Crud();

session_start();

/////////////////////////////variables 
$noBoarding=false;
////////////////////////////


/*search boarding part
======================*/
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
        //print_r($boardingArray);
        $_SESSION['boardingArray']=$boardingArray;
        //print_r($_SESSION);
        header("location:searchResult.php");
    }else{
        $noBoarding=true;
    }
}
?>
