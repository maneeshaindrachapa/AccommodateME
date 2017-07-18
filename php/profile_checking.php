<?php
//////////////////////////////////
include_once("php/Crud.php");
include_once('php/Validation.php');
//////////////////////////////////
$crud=new Crud();
$validation=new Validation();

/*startup settings
==================*/
session_start();
$email=$_SESSION['email'];

$profile_data=$crud->getData("SELECT * FROM users WHERE email='$email'");

$userID=$profile_data[0]['userID'];
$firstName=$profile_data[0]['firstName'];
$lastName=$profile_data[0]['lastName'];
$telephone='0'.$profile_data[0]['telephone'];
$imageID=$profile_data[0]['profPic'];
$location='profPic/'.$imageID;
$user_password=$profile_data[0]['password'];


////////////////////////////////////////////
//variables signup
$error_message_FN=$error_message_LN=$error_message_PW=$error_message_RPW=$error_message_TEL=$error_message_OPW=$error_message_EM="";
$fillAllData='';
$errors=true;
/////////////////////////////////////////////////////////////////////

if(isset($_POST['save'])){
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $password = $_POST['newPassword'];
    $password_re = $_POST['newPassword_re'];
    $old_password= $_POST['oldPassword'];
    $telephone=$_POST['telephone'];
    
    $check_firstname=$validation->is_name_valid($_POST['firstName']);
    $check_lastname=$validation->is_name_valid($_POST['lastName']);
    $check_telephone=$validation->is_tel_valid($_POST['telephone']);
    $check_email=$validation->is_email_valid($_POST['email']);

    
    //////////////////////////////////////////
    ////checking empty fields
    if(!$check_firstname){
        $error_message_FN='*The first name you entered does not seem correct';
        $errors=false;
    }elseif(!$check_lastname){
        $error_message_LN='*The last name you entered does not seem correct';
        $errors=false;
    }elseif(!$check_telephone){
        $error_message_TEL="*Telephone number is not valid";
        $errors=false;
    }elseif(!$check_email){
        $error_message_EM="*email you entered is not valid";
        $errors=false;
    }else{
    //if all the fields are filled
        if(isset($_POST['firstName'])){
            $result=$crud->execute("UPDATE users SET firstName='$firstName' WHERE email='$email'");   
        }
        
        if(isset($_POST['lastName'])){
            $result=$crud->execute("UPDATE users SET lastName='$lastName' WHERE email='$email'");
        }
        
        if(isset($_POST['telephone'])){
            $result=$crud->execute("UPDATE users SET telephone='$telephone' WHERE email='$email'"); 
        }
        if(isset($_POST['email'])){
            $email_new=$_POST['email'];
            if($email!=$email_new){
                echo '1';
                $email_data=$crud->getData("SELECT * FROM users WHERE email='$email_new'");
                if(empty($email_data)){
                    echo '2';
                    $result=$crud->execute("UPDATE users SET email='$email_new' WHERE userID='$userID'");
                    $_SESSION['email']=$email_new;
                    header("location:profile.php");
                }else{
                    $error_message_EM="*There is an account already from this e-mail";
                    $errors=false;
                }
            }else{

            }
        }
        
        if(isset($_POST['newPassword']) && isset($_POST['newPassword_re']) && isset($_POST['oldPassword'])){
            if($_POST['newPassword']!='' && $_POST['newPassword']!='' && $_POST['newPassword']!='') {
                if ($_POST['oldPassword'] == $profile_data[0]['password']) {
                    $password_length = $validation->password_length($_POST['newPassword']);
                    $check_password = $validation->is_password_valid($_POST['newPassword'], $_POST['newPassword_re']);
                    if (!$check_password) {
                        $error_message_RPW = "*Does not match with password";
                        $errors=false;
                    } elseif (!$password_length) {
                        $error_message_PW = "*Password must contain at least 8 characters";
                        $errors=false;
                    } else {
                        $result = $crud->execute("UPDATE users SET password='$password' WHERE userID='$userID'");
                    }
                } else {
                    $error_message_OPW = '*The Old password you entered seems to be incorrect';
                    $errors=false;
                }
            }
        }
        }
      }
    //////////////////////////////////////////

?>