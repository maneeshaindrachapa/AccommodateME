<?php
require 'phpmail.php';

////////////////////////////////////////////
session_start();
////////////////////////////////////////////

/* Signup page
===========================================*/

////////////////////////////////////////////
//variables signup
$error_message_EM=$error_message_FN=$error_message_LN=$error_message_PW=$error_message_RPW=$error_message_TEL="";
$fillAllData=$accountAlreadyThere="";

//adding variables for html to show error messages signin
$passwordErr= $noAccount="";
////////////////////////////////////////////



$owner_status='unchecked';
$searcher_status='unchecked';
if(isset($_POST['submit_signup'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email =$_SESSION['email']= $_POST['email'];
    
    
    
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];
    $telephone=$_POST['telNo'];
    $searcher_status=isset($_POST['boarding-searcher'])?"checked":"unchecked";
    $owner_status=isset($_POST['boarding-owner'])?"checked":"unchecked";
    $date = date('y-m-d');
    $type='searcher';
    if($searcher_status=='unchecked'){
        $type='owner';
    }
    
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
        $error_message_EM = '*The Email Address you entered does not appear to be valid.<br />';
      }
    if(strlen($password)<8){
        $error_message_PW='*Password Should have atleast 8 characters';
    }
    if(($password)!=$re_password){
        $error_message_RPW='*Do not match with Password';
    }
    $tel_string='/^[0-9]{10}+$/';//10 digits in tel no
    if(!preg_match($tel_string,$telephone)){
        $error_message_TEL='*Telephone Number is not valid';
    }
    //////////////////////////////////////////

    if((strlen($error_message_FN)>0) || (strlen($error_message_LN))>0 ||(strlen($error_message_EM)>0) ||(strlen($error_message_TEL)>0)|| (($password)!=$re_password)){
        //Returning to index.php using $_SERVER['PHP_SELF']
    }
    else{
        if(isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['email']) && isset($_POST['password'])&& isset($_POST['telNo'])&& isset($_POST['re_password']) && (($searcher_status=='checked')||($owner_status=='checked')) ){   
            $query="SELECT * FROM users WHERE email='$email'";
            
            if($query_run=mysqli_query($db, $query)){
                if(is_null(mysqli_fetch_assoc($query_run))){
                    
                        $query_add="INSERT INTO users VALUES(NULL, '$firstName', '$lastName', '$email', '$password', '$telephone','$type', '$date',NULL)";
                        if(mysqli_query($db, $query_add)){
                            $firstName='';
                            $lastName='';
                            $password='';
                            $re_password='';
                            $telephone='';
                        }else{
                        }
                    }else{
                    $accountAlreadyThere='*Account Already on This E-mail!';
                }
            }
            //if all details in sign-up is correct load in to process.php
            if($searcher_status=='checked'){
                header("location:process.php");
            }elseif($owner_status=='checked'){
                header("location:process_1.php");
            }
        }else{
            $fillAllData='*Fill All Data to Make the Account!';
        }
    
 
    }
}else{
    $firstName='';
    $lastName='';
    $email='';
    $password='';
    $re_password='';
    $telephone='';
}

/* Signin page
    ===========================================*/
if(isset($_POST['submit_signin'])){
    /////////////////////////
    $_SESSION['email']="";
    /////////////////////////
    
    $email_input =$_SESSION['email']= $_POST['email_signin'];
    $password_input=$_POST['password_signin'];
    $query="SELECT * FROM users WHERE email='$email_input'";
    if($query_run=mysqli_query($db, $query)){
        if(!is_null(mysqli_fetch_assoc($query_run))){
            if($query_run=mysqli_query($db, $query)) {
                while ($row = mysqli_fetch_assoc($query_run)) {
                    $password_db=$row['password'];
                    if($password_input==$password_db){
                        $type_db=$row['type'];
                        if($type_db=='owner'){
                             header("location:process_1.php");
                        }
                        else{//if all details in sign-in is correct then load in to process.php
                            header("location:process.php");
                        }
                    }else{
                        $passwordErr= 'Invalid Password.';
                    }
                }
            }
        }else{
            $noAccount= 'Could not find you account. Try again with a different e-mail.';
        }
    }
}else{
    $email_input='';
    $password_input='';
}
///////////////////////////////////////////////////////////////////////////////////////////
?>