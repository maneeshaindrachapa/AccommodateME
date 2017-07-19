<?php
//////////////////////////
include_once("php/Crud.php");
include("php/PHPMailer/PHPMailerAutoload.php");
//////////////////////////
$crud=new Crud();
session_start();

?>

<html>
<head>
    <title>Forget Password</title>
    
    <!--Alerts-->
    <script src="alert/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="alert/sweetalert.css">

    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
</head>
<body style="font-family: 'Raleway', sans-serif;text-align:center">
    <div class='confirmationClass'>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <h2>Input Your E-mail</h2>
    <h2>We will send You a new Password!</h2>
    <input type="email" name="forgetEmail" placeholder="Type your Email" class="admin-email-form">
    <input type="submit" name="confirmInput" value="Confirm" class="btn btn-info">
        </form></div>
    
    <style>
        body{
            background-image: url(img/forget_password.jpg);
            background-repeat: no-repeat;
            background-size: cover;
        }
        .confirmationClass{
            background-color: rgba(74, 74, 74, 0.86);
            padding: 20px;
            margin: 15%;
            color: #fff;
        }
        .btn.btn-info{
            background: #338EFF;
            border: 0;
            border-radius:0%;
            padding: 10px 40px;
            color: #ffffff;
            text-transform: uppercase;
        }
        .btn.btn-info:hover{
            color: black;
        }
        .btn:active, .btn.active {
            background-image: none;
            outline: 0;
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        .btn:focus, 
        .btn:active:focus, 
        .btn.active:focus, 
        .btn.focus, 
        .btn:active.focus, 
        .btn.active.focus {
            outline: thin dotted;
            outline: none;
            outline-offset: none;
        }
        .admin-email-form {
            margin:10px ;
            max-width: 400px;
            padding: 10px;
            font-size: 13px ;
            font-family:'Raleway',sans-serif;
        }

        .admin-email-form input[type=email]{
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            border:1px solid #BEBEBE;
            padding: 7px;
            margin-bottom:5px;
            -webkit-transition: all 0.30s ease-in-out;
            -moz-transition: all 0.30s ease-in-out;
            -ms-transition: all 0.30s ease-in-out;
            -o-transition: all 0.30s ease-in-out;
            outline: none;  
        }

        .admin-email-form input[type=email]:focus,{
            -moz-box-shadow: 0 0 8px #88D5E9;
            -webkit-box-shadow: 0 0 8px #88D5E9;
            box-shadow: 0 0 8px #88D5E9;
            border: 1px solid #88D5E9;
        }

        .admin-email-form .field-long{
            width: 100%;
        }
    </style>
    
    <?php
    $newPassword=rand(1000000000,9999999999);
    ///////////////////////////////////
    if(isset($_POST['forgetEmail'])){
        $email=$_POST['forgetEmail'];
        $_SESSION['email']=$email;
        $email_db=$crud->getData("SELECT * FROM users WHERE email='$email'");
        if(sizeof($email_db)>0){
        if($email_db[0]['email']==$email){
            $update=$crud->execute("UPDATE users SET password='$newPassword' WHERE email='$email'");
            
    ///////////////////////////////////
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


            $mail->addAddress($_POST['forgetEmail']);     // add sellers address from db
            $mail->Subject = 'AccomodateME - Password Changing';
            $mail->Body =

                '
            <!doctype html>
            <html>
            <body>
            <h1>Password Change in AccomodateME!</h1>

            
            <p>This is your New Password:<h2>'.$newPassword.'</h2>

        
            <p>If you didn\'t request a new password for this email, that means someone is trying to access to your account.</p>

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
            
            header('location:forgetPasswordConfirmation.php');
        }
    }else{
            echo '<script>swal("Error", "There is no account maching to the email you entered", "error")</script>';
        }
    }
            ///////////////////////////////////////
    ?>
</body>
</html>