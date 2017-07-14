<?php
require 'connect.inc.php';
//////////////////////////////////////////////////////////////////////////////////////
session_start();
//if(strlen($_SESSION['email'])>0){
//    $email = $_SESSION['email'];
//}elseif(strlen($_SESSION['email_signin'])>0){
//    $email=$_SESSION['email_signin'];
//}
$email=$_SESSION['email'];
////////////////////////////////////////////////////////////

$sql1 = "SELECT firstName FROM users WHERE email='$email' ";
$result1 = $db->query($sql1);
$row1 = mysqli_fetch_assoc($result1);
$sql2 = "SELECT lastName FROM users WHERE email='$email' ";
$result2 = $db->query($sql2);
$row2 = mysqli_fetch_assoc($result2);
$sql3 = "SELECT telephone FROM users WHERE email='$email' ";
$result3 = $db->query($sql3);
$row3 = mysqli_fetch_assoc($result3);

$sql7 = "SELECT password FROM users WHERE email='$email' ";
$result7 = $db->query($sql7);
$row7 = mysqli_fetch_assoc($result7);
$old_password=$row7['password'];

////////////////////////////////////////////////////////////

////////////////////////////////////////////
//variables signup
$error_message_FN=$error_message_LN=$error_message_PW=$error_message_RPW=$error_message_CCN=$error_message_TEL=$error_message_RCCN=$error_message_OPW="";
/////////////////////////////////////////////////////////////////////

if(isset($_POST['save'])) {
    $firstname = $_POST['firstName'];
    $lastname = $_POST['lastName'];
    $creditcard = $_POST['creditcardnum'];
    $rcreditcard = $_POST['rcreditcardnum'];
    $o_password=$_POST['o_password'];
    $passwordn = $_POST['password'];
    $rpasswordn = $_POST['rpassword'];
    $telephone=$_POST['telephone'];
    $add = true;
    
    //////////////////////////////////////////
    //error checking
    if(($old_password)!=$o_password){
        $error_message_OPW="*Password Incorrect";
    }
    $string_exp = "/^[A-Za-z-]+$/";
      if(!preg_match($string_exp,$firstname)) {
        $error_message_FN = '*The First Name you entered does not appear to be valid.<br />';
      }
      if(!preg_match($string_exp,$lastname)) {
        $error_message_LN = '*The Last Name you entered does not appear to be valid.<br />';
      }
    if(strlen($passwordn)<8){
        $error_message_PW='*Password Should have atleast 8 characters';
    }
    if(($passwordn)!=$rpasswordn){
        $error_message_RPW='*Do not match with Password';
    }
    if(strlen($creditcard)>20 || strlen($creditcard)<12){
        $error_message_CCN='*Credit Card Number Invalied';
    }
    if($creditcard!=$rcreditcard){
        $error_message_RCCN="*Do not match with Credit Card Number";
    }
    $tel_string='/^[0-9]{10}+$/';//10 digits in tel no
    if(!preg_match($tel_string,$telephone)){
        $error_message_TEL='*Telephone Number is not valid';
    }
    //////////////////////////////////////////
    if((strlen($error_message_FN)>0) ||(strlen($error_message_TEL)>0)||(strlen($error_message_OPW)>0)|| (strlen($error_message_LN))>0 || (($passwordn)!=$rpasswordn)){
        //Returning to index.php using $_SERVER['PHP_SELF']
    }else{
        if(!empty($_POST['creditcardnum'])) {
            if ($creditcard == $rcreditcard) {
                $sql = "UPDATE users SET creditCardNo='$creditcard' WHERE email='$email'";
                mysqli_query($db,$sql);
            } else {
                $add=false;
            }
        }
        if(!empty($_POST['password'])) {
            if ($passwordn==$rpasswordn && strlen($passwordn)>8 &&  strlen($passwordn)<65) {
                $sql = "UPDATE users SET password='$passwordn' WHERE email='$email'";
                mysqli_query($db,$sql);

            }
            else{
                $add=false;
            }
        }
        if($add==true) {
            if (!empty($_POST['firstName'])) {
                $sql = "UPDATE users SET firstName='$firstname' WHERE email='$email'";
                mysqli_query($db,$sql);

            }
            if (!empty($_POST['lastName'])) {
                $sql = "UPDATE users SET lastName='$lastname' WHERE email='$email'";
                mysqli_query($db,$sql);

            }
            if (!empty($_POST['telephone'])) {
                $sql = "UPDATE users SET telephone='$telephone' WHERE email='$email'";
                mysqli_query($db,$sql);

            }
        }
        else{

        }
    }
   
    
}


//////////////////////////////////////////////////////////////////////////////////////
?>