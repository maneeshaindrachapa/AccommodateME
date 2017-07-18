<?php
//////////////////////////////////
include_once("Crud.php");
include_once('Validation.php');
include("PHPMailer/PHPMailerAutoload.php");
//////////////////////////////////
session_start();

$crud=new Crud();
$validation=new Validation();

////////////////////////////////variables for errors
$error_message_EM=$error_message_FN=$error_message_LN=$error_message_PW=$error_message_RPW=$error_message_TEL="";
$fillAllData=$accountAlreadyThere="";
$accountCreate='false';
$accountConfirm='false';
$confirmationCode=rand(1000000000,9999999999);
////////////////////////////////
function setConfirm($value){
    $accountConfirm=$value;
}


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
        if($type=='searcher'){
                    //sending confirmation email to searcher
            $mail = new PHPMailer();

            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'maneesh.15@cse.mrt.ac.lk';                 // SMTP username
            $mail->Password = 'queengambit';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
            $mail->From = 'maneesh.15@cse.mrt.ac.lk';
            $mail->FromName = 'AccomodateME';
            $mail->WordWrap = 50;
            $mail->Port = 587;
            $mail->isHTML(true);


            $mail->addAddress($_POST['email']);     // add sellers address from db
            $mail->Subject = 'AccomodateME - Account created';
            $mail->Body =

                '
            <!doctype html>
            <html>
            <body>
            <h1>Welcome to AccomodateME!</h1>

            <p><b>Hi '.$firstName.'<br>We are happy to inform you that your account is successfully created.</b></p><br>
            <p>This is your Confirmation code:<h2>'.$confirmationCode.'</h2>

            <p>Now you can log into our members area and search boardings as your preferance.</p>

            <p>Please make sure you have read the ad-posting rules and guidelines before continuing.</p>

            <p>If you didn\'t sign up on our website using this email, that means your email account is compromised.</p>

            <p>Please contact our accounts manager Yasiru @ 0776097828 as soon as possible.</p>

            <p>Thank you for using our services. Hope to deal with you again.</p>

            <p>----------------------------------------------------------------------------------------------------------------------</p>

            <p>Please don&#39;t reply to this email as this inbox is not monitored.</p>

            <p><a href="http://www.accomodate.me">www.accomodate.me</a></p>
            </body>
            </html>



            ';

            if (!$mail->send()) {
                echo 'Message could not be sent. seller';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                // echo 'Message has been sent';
            }
            $accountCreate='true';
            //header('location:process.php');
    }
        elseif($type=='owner'){
            $mail = new PHPMailer();

            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'maneesh.15@cse.mrt.ac.lk';                 // SMTP username
            $mail->Password = 'queengambit';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
            $mail->From = 'maneesh.15@cse.mrt.ac.lk';
            $mail->FromName = 'AccomodateME';
            $mail->WordWrap = 50;
            $mail->Port = 587;
            $mail->isHTML(true);


            $mail->addAddress($_POST['email']);     // add sellers address from db
            $mail->Subject = 'AccomodateME - Account created';
            $mail->Body =

                '
            <!doctype html>
            <html>
            <body>
            <h1>Welcome to AccomodateME!</h1>

            <p><b>Hi '.$firstName.'<br>We are happy to inform you that your account is successfully created.</b></p><br>
            <p>This is your Confirmation code:<h2>'.$confirmationCode.'</h2>

            <p>Now you can log into our members area and start searching for boarding places.</p>

            <p>Please make sure you have read the bidding rules and guidelines before continuing.</p>

            <p>If you didn\'t sign up on our website using this email, that means your email account is compromised.</p>

            <p>Please contact our accounts manager Yasiru @ 0776097828 as soon as possible.</p>

            <p>Thank you for using our services. Hope to deal with you again.</p>

            <p>----------------------------------------------------------------------------------------------------------------------</p>

            <p>Please don&#39;t reply to this email as this inbox is not monitored.</p>

            <p><a href="http://www.accomodate.me">www.accomodate.me</a></p>
            </body>
            </html>



            ';

            if (!$mail->send()) {
                echo 'Message could not be sent. seller';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                // echo 'Message has been sent';
            }
            $accountCreate='true';
            //header('location:process_1.php');
        }
        if($accountCreate){
        $result=$crud->execute("INSERT INTO users(firstName,lastName,email,password,telephone,type,profPic,active,confirmationCode) VALUES ('$firstName','$lastName','$email','$password','$telephone','$type','$profPic','$active','$confirmationCode')");
        header("location:confirmation.php");
        }           
    
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
        $confirmationCodeCheck=$account[0]['confirmationCodeCheck'];
        $confirmationCode=$account[0]['confirmationCode'];
        if($active_db=='true'){
            if($password_input==$password_db){
                
                if($confirmationCodeCheck==$confirmationCode){
                    if($type_db=='owner'){
                    header("location:process_1.php");
                    }elseif($type_db=='admin'){
                        header("location:process_admin.php");
                    }else{
                        header("location:process.php");
                    }
                }else{
                header('location:confirmation.php');
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