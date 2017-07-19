<?php
//////////////////////////////
include_once("php/Crud.php");
$crud=new Crud();
//////////////////////////////
session_start();
//print_r($_SESSION);
$owner_email=$_SESSION['email'];
$ownerDetails=$crud->getData("SELECT userID FROM users WHERE email='$owner_email'");
$ownerID=$ownerDetails[0]['userID'];
//echo '<br>'.$ownerID.'<br>';
$boardingArray=Array();
$boardingList=$crud->getData("SELECT boardingID FROM bet_details WHERE ownerID='$ownerID'");


//==================================================
$boardingList_temp=$crud->getData("SELECT * FROM bet_details WHERE ownerID='$ownerID' AND isBooked='true'");
$true_list=Array();
if(!empty($boardingList_temp)){
    for($temp8=0; $temp8<sizeof($boardingList_temp); $temp8++) {
        $boardingID = $boardingList_temp[$temp8]["boardingID"];
        array_push($true_list,$boardingID);
    }
}
print_r($true_list);
//*===========================================================

if(!empty($boardingList)){
    for($temp1=0; $temp1<sizeof($boardingList); $temp1++){
        $boardingID=$boardingList[$temp1]['boardingID'];
        $isTrue="false";
        for($temp9=0; $temp9<sizeof($true_list); $temp9++){
            if($boardingID==$true_list[$temp9]){
                $isTrue="true";
            }
        }
        if($isTrue=="false") {
            $isPresent = "false";
            for ($temp2 = 0; $temp2 < sizeof($boardingArray); $temp2++) {
                if ($boardingID == $boardingArray[$temp2]) {
                    $isPresent = "true";
                }
            }
            if ($isPresent == "false") {
                array_push($boardingArray, $boardingID);
            }
        }
    }
    //print_r($boardingArray);

}else{
    echo 'boardings are not yet booked!<br>';
}



/*confirming the purchase
=========================*/
if(isset($_POST['confirmPurchase'])){
    $boardingID_text=$_POST['boardingID_text'];
    $email_text=$_POST['email_text'];
    $user_text=$crud->getData("SELECT userID FROM users WHERE email='$email_text'");
    $userID_text=$user_text[0]['userID'];
    $update_text=$crud->getData("UPDATE bet_details SET isBooked='true' WHERE boardingID=$boardingID_text AND studentID=$userID_text");
    $header("location:purchaseDetails.php");
    /*if($update_text){
        echo 'updated sucessfully';
        $header("location:purchaseDetails_1.php");
    }else{
        echo 'update failed';
    }*/
}


?>


<html>
<head>
    <title>AccomodateMe-Purchase Details</title>
    <!-- styles used-->
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Titillium+Web" rel="stylesheet">
    <link href="css/style_purchaseDetails.css" type="text/css" rel="stylesheet">

</head>
<body>
    <div style="float:right" class='log_out'>
        <form align="right" name="form1" method="post" action="php/logout.php">
            <label class="logoutLblPos">
                <button name="log_out" type="submit" id="log_out" class="btn btn-info">Log Out</button>
            </label>
        </form>
    </div><br>
    <h1>Purchace Details</h1>
    <?php
        for($temp3=0; $temp3<sizeof($boardingArray); $temp3++) {
            $boardingID=$boardingArray[$temp3];
            //echo $boardingID.'<br>';
            $boardingDetails=$crud->getData("SELECT * FROM boarding_details WHERE boardingID='$boardingID'");
            $address=$boardingDetails[0]['address'];
            //echo $address;
            $bidDetails=$crud->getData("SELECT * FROM bet_details WHERE ownerID='$ownerID' AND boardingID='$boardingID'");
            $bidArray=Array();
            for($temp5=0; $temp5<sizeof($bidDetails); $temp5++) {
                $bid=$bidDetails[$temp5]['betAmount'];
                array_push($bidArray,$bid);
            }
            //print_r($bidArray);


            $query="SELECT * FROM users WHERE ";
            for($temp4=0; $temp4<sizeof($bidDetails)-1; $temp4++) {
                $bidderID = $bidDetails[$temp4]['studentID'];
                $query=$query."userID=".$bidderID." OR " ;
            }
            $query=$query."userID=".$bidDetails[sizeof($bidDetails)-1]['studentID'];
            $studentDetails=$crud->getData($query);

            $finalList=Array();
            for($temp5=0; $temp5<sizeof($studentDetails); $temp5++){
                $tempList=Array();
                array_push($tempList, $studentDetails[$temp5]['firstName']);
                array_push($tempList, $studentDetails[$temp5]['telephone']);
                array_push($tempList, $studentDetails[$temp5]['email']);
                array_push($tempList, $bidArray[$temp5]);
                array_push($finalList, $tempList);
            }
            //print_r($finalList);
            $header='Address: '.$address.' | Boarding ID: '.$boardingID;

                echo "<h2>$header</h2>";
                echo "<table class='table'>
                    <thead>
                        <tr>
                            <th>Bidder's Name</th>
                            <th>Bidder's Telephone Number </th>
                            <th>Bidder's e-mail</th>
                            <th>Bid Amount</th>
                        </tr>
                    </thead>
                    <tbody>";
                        for($temp7=0; $temp7<sizeof($finalList); $temp7++) {
                            echo "<tr>
                                <td>".$finalList[$temp7][0]."</td>
                                <td>".$finalList[$temp7][1]."</td>
                                <td>".$finalList[$temp7][2]."</td>
                                <td>".$finalList[$temp7][3]."</td>
                            </tr>";
                        }
                    echo"</tbody>
                </table>";
        }
    ?>
    <div style="float:right">
        <form align="right" name="form2"  method="post" class="admin-email-form">
            <span>"Select Boarding ID and enter Bidder's email to do transaction"</span>
            <label>
<!--                <input type="number" style="color:white" class="form-control" name="boardingID_text" value="Boarding ID">-->
                <select style="padding:10px;padding-left:20px;" name="boardingID_text">
                <?php
                for($x=0;$x<sizeof($boardingArray);$x++){
                    echo "<option name=".$boardingArray[$x]." value=".$boardingArray[$x].">".$boardingArray[$x]."</option>";
                    }    
                ?>
                </select>
                <input type="email" style="color:white" class="form-control" name="email_text" placeholder="Bidders's Email">
                <button type="submit" name="confirmPurchase" class="btn btn-info">Sell the Boarding</button>
            </label>
        </form>
        <button style="float:right" class="btn btn-info"><a href="process_1.php" style="color:white;text-decoration:none;padding:10px">Go to Previous Page</a></button>
    </div>
    
</body>
</html>