<?php
//////////////////////////
include_once("php/Crud.php");
//////////////////////////
$crud=new Crud();

session_start();
$email=$_SESSION['email'];
if($_SESSION['email']==""){
    header('location:index.php');
}
?>

<html>
<head>
    <title>Confirm Account</title>
    
    <!--Alerts-->
    <script src="alert/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="alert/sweetalert.css">

    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
</head>
<body style="font-family: 'Raleway', sans-serif;text-align:center">
    <div class='confirmationClass'>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <h2>Input the Confirmation code We send You</h2>
    <h2>to Verify your E-mail !</h2>
    <input type="text" name="confirmation" placeholder="Confirmation Code" class="admin-email-form">
    <input type="submit" name="confirmInput" value="Confirm" class="btn btn-info">
        </form></div>
    
    <style>
        body{
            background-image: url(img/confirm_account.jpg);
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
            background: #FCAC45;
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
    ///////////////////////////////////
    if(isset($_POST['confirmInput'])){
        $confirmCode=$_POST['confirmation'];
        $confirmCode_db=$crud->getData("SELECT * FROM users WHERE email='$email'");
        if($confirmCode_db[0]['confirmationCode']==$confirmCode){
            $update=$crud->execute("UPDATE users SET confirmationCodeCheck='$confirmCode' WHERE email='$email'");
            if($confirmCode_db[0]['type']=='searcher'){
                header("location:process.php");
            }elseif($confirmCode_db[0]['type']=="owner"){
                header("location:process_1.php");
            }
        }else{
            echo '<script>swal("Error", "Confirmation code You entered is Invaild", "error")</script>';
        }
    }
    //////////////////////////////////
    ?>
</body>
</html>