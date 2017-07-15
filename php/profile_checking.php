<?php
/*startup settings
==================*/
session_start();
$email=$_SESSION['email'];

$query="SELECT * FROM users WHERE email='$email'";
if($query_run=mysqli_query($db, $query)){
    while ($row = mysqli_fetch_assoc($query_run)) {
        $userID=$row['userID'];
        $firstName=$row['firstName'];
        $lastName=$row['lastName'];
        $telephone=$row['telephone'];
        $imageID=$userID;
        if($imageID==''){
            $imageID="default.jpg";
        }
        $location='profPic/'.$imageID.'.jpg';
        $user_password=$row['password'];
    }
}

////////////////////////////////////////////
//variables signup
$error_message_FN=$error_message_LN=$error_message_PW=$error_message_RPW=$error_message_CCN=$error_message_TEL=$error_message_RCCN=$error_message_OPW=$error_message_EM="";
/////////////////////////////////////////////////////////////////////

if(isset($_POST['save'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['newPassword'];
    $password_re = $_POST['newPassword_re'];
    $old_password= $_POST['oldPassword'];
    $telephone=$_POST['telephone'];

    
    //////////////////////////////////////////
    //error checking
    $string_exp = "/^[A-Za-z0-9 .'-]+$/";
    if(!preg_match($string_exp,$firstName)) {
        $error_message_FN = '*The First Name you entered does not appear to be valid.<br />';
    }
    if(!preg_match($string_exp,$lastName)) {
        $error_message_LN = '*The Last Name you entered does not appear to be valid.<br />';
    }
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    if(!preg_match($email_exp,$email)) {
        $error_message_EM = '*The Email Address you entered does not appear to be valid'.'<br />';
    }
    if(strlen($creditCardNum)>20 || strlen($creditCardNum)<8){
        $error_message_CCN='*Invalid Credit Card Number';
    }
    if($creditCardNum!=$creditCardNum_re){
        $error_message_RCCN="*Do not match with Credit Card Number";
    }
    $tel_string='/^[0-9]{9}+$/';//10 digits in tel no
    if(!preg_match($tel_string,$telephone)){
        $error_message_TEL='*Telephone Number is not valid';
    }
    //////////////////////////////////////////
    if((strlen($error_message_FN)>0) ||(strlen($error_message_TEL)>0)|| (strlen($error_message_LN))>0 || (strlen($error_message_EM))>0 ||(strlen($error_message_CCN))>0 ){
        //Returning to index.php using $_SERVER['PHP_SELF']
    }else{

        /*changing the password
        =======================*/
        if(($password!='')||($password_re='')||($old_password!='')){
            if(($password!='')&&($password_re!='')&&($old_password!='')){
                if(strlen($password)>=8) {
                    if ($password == $password_re) {
                        if ($user_password == $old_password) {
                            $query_update="UPDATE users SET password='$password' WHERE userID='$userID'";
                            if(mysqli_query($db, $query_update)) {
                                echo '<br>password updated successfully';
                            }else{
                                echo 'failed';
                            }

                        } else {
                            echo 'invalid old password';
                            $error_message_OPW = '*Invalid old Password';
                        }
                    } else {
                        $error_message_RPW = '*Do not match with Password';
                    }
                }else{
                    $error_message_PW='*Password Should have atleast 8 characters';
                }
            }else{
                echo '<br>fill all the data.';
            }
        }

        /*changing the prof pic
        ========================*/
//        $file_name = $_FILES['profilepicture']['name'];
//        $file_size = $_FILES['profilepicture']['size'];
//        $file_type = $_FILES['profilepicture']['type'];
//        echo $file_tmp_name = $_FILES['profilepicture']['tmp_name'];
//        $file_extention=strtolower(substr($file_name,strpos($file_name,'.')+1));
//        $file_max_size=5242880;
//
//        if(isset($file_name)){
//            if(!empty($file_name)){
//                if(($file_extention=='jpg' || $file_extention=='jpeg')&&($file_type=='image/jpeg')&&($file_size<=$file_max_size)) {
//
//                    /*upload location and renaming the image file
//                    =============================================*/
//                    $location = 'uploads/profile_pics';
//                    if(is_dir($location)==false){
//                        mkdir("$location", 0700);// Create directory if it does not exist
//                    }
//                    $new_file_name='u'.$userID.'.'.$file_extention;
//                    if (move_uploaded_file($file_tmp_name, "$location/".$new_file_name)) {
//                        //if all details in sign-up is correct load in to process.php
//                        /*avoide browser from keeping cache files
//                         ==========================================*/
//                        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
//                        header("Cache-Control: post-check=0, pre-check=0", false);
//                        header("Pragma: no-cache");
//                        header("location:profile.php");
//                    } else {
//                        //$error_1= '*There was an error uploading the file '.$file_name.' ';
//                    }
//                }else{
//                    //$error_2= '*file must be jpg/jpeg and must be 5MB or less. ';
//                }
//            }else{
//                //$error_3= '*please choose an image ';
//            }
//        }
    }
}


//////////////////////////////////////////////////////////////////////////////////////
?>