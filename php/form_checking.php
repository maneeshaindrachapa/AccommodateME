<?php
//require 'phpmail.php';

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
                        $query_add="INSERT INTO users VALUES(NULL, '$firstName', '$lastName', '$email', '$password', '$telephone','$type', '$date',NULL,'default.jpg')";
                        if(mysqli_query($db, $query_add)){
                            $firstName='';
                            $lastName='';
                            $password='';
                            $re_password='';
                            $telephone='';
                            
                            ///////////////////////////////////////////
                            $p_name=$_FILES['profilepicture']['name'];
                            $p_size=$_FILES['profilepicture']['size'];
                            $p_type=$_FILES['profilepicture']['type'];
                            $p_temp_name=$_FILES['profilepicture']['tmp_name'];
                            $p_extention=strtolower(substr($p_name,strpos($p_name,'.')+1));
                            $p_max_size=5242880;
                            
                            if(isset($p_name)){
                                if(!empty($p_name)){
                                    if(($p_extention=='jpg' || $p_extention=='jpeg')&&($p_type=='image/jpeg')&&($p_size<=$p_max_size)){
                                        $location = 'profPic';
                                        if(is_dir($location)==false){
                                            mkdir("$location", 0700);// Create directory if it does not exist
                                                    }
                                        $sql3 = "SELECT userID FROM users WHERE email='$email' ";
                                        $result3 = $db->query($sql3);
                                        $row3 = mysqli_fetch_assoc($result3);
                                        $p_id=$row3['userID'];
                                        $new_p_name=$p_id.'.'.$p_extention;
                                        
                                        if (move_uploaded_file($p_temp_name, "$location/" .$new_p_name)) {
                                            $sql = "UPDATE users SET profPic='$new_p_name' WHERE email='$email'";
                                            mysqli_query($db,$sql);   
                                        }
                                    }    
                                }
                            }
                            //////////////////////////////////////////
                            
                            
                            
                            if($searcher_status=='checked'){
                                header("location:process.php");
                           }elseif($owner_status=='checked'){
                                header("location:process_1.php");
                            }
                        }else{
                            }
                    }else{
                    $accountAlreadyThere='*Account Already on This E-mail!';
                        }
            }
        }
        else{
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
                        }elseif($type_db=='admin'){
                            header("location:process_admin.php");
                        }
                        else{
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