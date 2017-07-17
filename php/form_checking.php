<?php
//////////////////////////////////
include_once("Crud.php");
include_once('Validation.php');
//////////////////////////////////
session_start();

$crud=new Crud();
$validation=new Validation();

////////////////////////////////variables for errors
$error_message_EM=$error_message_FN=$error_message_LN=$error_message_PW=$error_message_RPW=$error_message_TEL="";
$fillAllData=$accountAlreadyThere="";
////////////////////////////////

////////////////////////////////variables for values
$firstName=$lastName=$email=$password=$re_password=$telephone="";

$passwordErr= $noAccount=$banned="";
////////////////////////////////   


///sign Up
if(isset($_POST['submit_signup'])){
    $firstName=$crud->escape_string($_POST['firstName']);
    $lastName=$crud->escape_string($_POST['lastName']);
    $email=$crud->escape_string($_POST['email']);
    $password=$crud->escape_string($_POST['password']);
    $re_password=$crud->escape_string($_POST['re_password']);
    $telephone=$_POST['telNo'];
    
    $_SESSION['email']=$email;
    
    $searcher_status=isset($_POST['boarding-searcher'])?"checked":"unchecked";
    $owner_status=isset($_POST['boarding-owner'])?"checked":"unchecked";
    $active="true";
    $type='searcher';
    if($searcher_status=='unchecked'){
        $type='owner';
    }
    
    $profPic="default.jpg";
    
    
    $msg=$validation->check_empty($_POST,array('firstName','lastName','email','password','re_password','telNo'));
    $check_firstname=$validation->is_name_valid($_POST['firstName']);
    $check_lastname=$validation->is_name_valid($_POST['lastName']);
    $check_email=$validation->is_email_valid($_POST['email']);
    $password_length=$validation->password_length($_POST['password']);
    $check_password=$validation->is_password_valid($_POST['password'],$_POST['re_password']);
    $check_telephone=$validation->is_tel_valid($_POST['telNo']);

    
    $account_there=($crud->getData("SELECT * FROM users WHERE email='$email'"));
        
    //checking empty fields
    if($msg!=null){
        $fillAllData="*Fill all Data";
    }elseif(!$check_firstname){
        $error_message_FN='*The first name you entered does not seem correct';
    }elseif(!$check_lastname){
        $error_message_LN='*The last name you entered does not seem correct';
    }elseif(!$check_email){
        $error_message_EM= '*the email you entered does not seems correct';
    }elseif(!empty($account_there)){
        $accountAlreadyThere="*There is an account already from this e-mail";
    }elseif(!$check_password){
        $error_message_RPW="*Does not match with password";
    }elseif(!$password_length){
        $error_message_PW="*Password must contain at least 8 characters";
    }elseif(!$check_telephone){
        $error_message_TEL="*Telephone number is not valid";
    }else{
    //if all the fields are filled
    $result=$crud->execute("INSERT INTO users(firstName,lastName,email,password,telephone,type,profPic,active) VALUES ('$firstName','$lastName','$email','$password','$telephone','$type','$profPic','$active')");
    }
    
    ///////////////////////////////////////////*profile pic adding
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
                $prof_pic=$crud->getData("SELECT userID FROM users WHERE email='$email'");
                $p_id=$prof_pic[0]['userID'];
                $new_p_name=$p_id.'.'.$p_extention;

                if (move_uploaded_file($p_temp_name, "$location/" .$new_p_name)) {
                    $prof_pic_result=$crud->execute("UPDATE users SET profPic='$new_p_name' WHERE email='$email'"); 
                }
            }    
        }
    }
    //////////////////////////////////////////
    
    if($type=='searcher'){
        header('location:process.php');
    }else{
        header('location:process_1.php');
    }
    
}

//sign in
if(isset($_POST['submit_signin'])){
    $email_input=$_SESSION['email']=$_POST['email_signin'];
    $password_input=$_POST['password_signin'];
    $account=$crud->getData("SELECT * FROM users WHERE email='$email_input'");
    if(!empty($account)){
        $password_db=$account[0]["password"];
        $active_db=$account[0]['active'];
        $type_db=$account[0]['type'];
        if($active_db=='true'){
            if($password_input==$password_db){
                if($type_db=='owner'){
                    header("location:process_1.php");
                }elseif($type_db=='admin'){
                    header("location:process_admin.php");
                }else{
                    header("location:process.php");
                }
            }else{
                $passwordErr="*Invalid Password";
            }
        }else{
            $banned="*Your Account is Banned";
        }
    }else{
        $noAccount="*Could not find your account.Try again with different e-mail.";   
    }
}else{
    $email_input="";
    $password_input="";
}




?>