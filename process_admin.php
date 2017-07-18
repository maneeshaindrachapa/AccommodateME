<?php
//////////////////////////////////
include_once("php/Crud.php");
//////////////////////////////////
$crud=new Crud();

session_start();

$email=$_SESSION['email'];
if($_SESSION['email']==""){
    header('location:index.php');
}
$name=$crud->getData("SELECT firstName FROM users where email='$email'");

$userDetails=$crud->getData("SELECT userID,firstName,lastName,email,password,telephone,type,active FROM users");

$boardingDetails=$crud->getData("SELECT boardingID,userID,boardingFor,studentCount,price,distance,address FROM boarding_details");

$emailprof=$_SESSION['email'];
$profile_pic_db=$crud->getData("SELECT profPic FROM users WHERE email='$emailprof'");
$profile=$profile_pic_db[0]['profPic'];
////////////////////////////////////////////////////
?>

<html>
    <head>
        <title>Accomodate Me-Admin Page</title>
        
        <!-- styles used-->
        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Titillium+Web" rel="stylesheet">
        <link href="css/style_process_admin.css" type="text/css" rel="stylesheet">
        
    </head>
    
    <body>
        <div style="float:right" class='log_out'>
            <form align="right" name="form1" method="post" action="php/logout.php">
              <label class="logoutLblPos">
                  <button name="log_out" type="submit" id="log_out" class="btn btn-info">Log Out</button>
              </label>
            </form>
            </div><br>
        <div>
        <h1>Welcome&nbsp;<?php echo $name[0]['firstName'];?></h1>
        <div class="wrap">
                    <div class="sideA"></div>
                    <a href="profile.php"><div class="sideB"></div></a>
                </div><br>
                <style>
                        .wrap{
                        margin: auto;
                        width: 150px;
                        height: 150px;
                        cursor: pointer;
                    }

                    .wrap div{
                        width:150px;
                        height:150px;
                        border-radius: 100%;
                        background-position:50% 50%;
                        background-size: 150px;
                        background-repeat: no-repeat;
                        box-shadow:inset 0 0 45px rgba(255,255,255,0.3) , 0 12px 20px -10px rgba(0,0,0,0.4)  ;
                    }

                    .sideA{
                        background-image: url("profPic/<?php echo $profile;?>");
                        background-size:cover;
                    }

                    .sideB{
                        background-image: url("img/editProfile.jpg");
                        background-size: cover;
                    }

                    /*Transitions for the wallpapers*/
                    body{
                        -webkit-perspective: 800px;
                    }

                    .wrap div{
                        position: absolute;
                        -webkit-backface-visibility: hidden;
                    }

                    .sideA{
                        z-index: 100;
                    }
                    .sideB{
                        -webkit-transform: rotateY(-180deg);
                    }
                    .wrap{
                        transition:-webkit-transform 0.2s ease-in ;
                        -webkit-transform-style: preserve-3D;

                    }
                    .wrap:hover{
                        -webkit-transform:rotateY(180deg);
                    }
                </style>
            <!--------------->
        <h2>Users</h2>
        <table class="table">
            <thead>
            <tr>
                <th>UserID</th>
                <th>FirstName</th>
                <th>LastName</th>
                <th>email</th>
                <th>password</th>
                <th>telephone</th>
                <th>type</th>
                <th>Active Account</th>
                
            </tr>
            </thead>
            <tbody>
        <?php
        ///////////////////////////////////////////////////
        if (sizeof($userDetails)> 0) {
        // output data of each row
            for($x=0;$x<sizeof($userDetails);$x++) {
                echo  "<tr><td>".$userDetails[$x]['userID']."</td><td>".$userDetails[$x]['firstName']."</td><td>".$userDetails[$x]['lastName']."</td><td>".$userDetails[$x]['email']."</td><td>".$userDetails[$x]['password']."</td><td>".$userDetails[$x]['telephone']."</td><td>".$userDetails[$x]['type']."</td><td>".$userDetails[$x]['active']."</td></tr>";
                }
            }else {
                echo "0 results";
                }
        /////////////////////////////////////////////////
        ?>
            </tbody>
        </table>
        <div style="float:right">
            <form align="right" name="form2"  method="post" action="process_admin.php" class="admin-email-form">
              <label>
                  <input type="email" style="color:white" class="form-control" name="remove_email" value="User's Email">
                  <button name="removeEmailButton" type="submit"  class="btn btn-info">Banned User</button>
              </label>
            </form>
            </div><br><br><br><br><br><br><br><br>
            
        <?php
        ////////////////////////////////////////////////////
        $error_remove_email="";
        $active="false";
        if(isset($_POST['removeEmailButton']) && isset($_POST['remove_email'])){
            $remove_email=$_POST['remove_email'];
            $remove_user=$crud->execute("UPDATE users SET active='$active' WHERE email='$remove_email'");
        }else{  
        }
        ////////////////////////////////////////////////////
        ?>
         <div style="float:right">
            <form align="right" name="form2"  method="post" action="process_admin.php" class="admin-email-form">
              <label>
                  <input type="email" style="color:white" class="form-control" name="active_email" value="User's Email">
                  <button name="activeEmailButton" type="submit"  class="btn btn-info">Unbanned User</button>
              </label>
            </form>
            </div><br><br><br><br><br><br><br>
            
        <?php
        ////////////////////////////////////////////////////
        $error_active_email="";
        $active="true";
        if(isset($_POST['activeEmailButton']) && isset($_POST['active_email'])){
            $active_email=$_POST['active_email'];
            $active_user=$crud->execute("UPDATE users SET active='$active' WHERE email='$active_email'");
        }else{  
        }
        ////////////////////////////////////////////////////
        ?>
            
                <h2>Boarding Details</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Boarding ID</th>
                <th>User ID</th>
                <th>Boarding For</th>
                <th>Student Count</th>
                <th>Price</th>
                <th>Distance from University</th>
                <th>Address</th>
            </tr>
            </thead>
            <tbody>
        <?php
        ///////////////////////////////////////////////////
        if ($boardingDetails> 0) {
        // output data of each row
           for($x=0;$x<sizeof($boardingDetails);$x++){
                echo  "<tr><td>".$boardingDetails[$x]['boardingID']."</td><td>".$boardingDetails[$x]['userID']."</td><td>".$boardingDetails[$x]['boardingFor']."</td><td>".$boardingDetails[$x]['studentCount']."</td><td>".$boardingDetails[$x]['price']."</td><td>".$boardingDetails[$x]['distance']."</td><td>".$boardingDetails[$x]['address']."</td></tr>";
                }
            }else {
                echo "0 results";
                }
        /////////////////////////////////////////////////
        ?>
            </tbody>
        </table>
        </div>
        
    <?php
    ////////////////////////////////////////////
    $error_adminemail="";
    $type='admin';
    if(isset($_POST['adminEmailButton']) && isset($_POST['adminemail'])){
        $adminemail=$_POST['adminemail'];
        $email_admin_making=$crud->execute("UPDATE users SET type='$type' WHERE email='$adminemail'");
        if($email_admin_making){
        }
    }else{
    }
    ///////////////////////////////////////////
    ?>
        
        <div style="float:right">
            <form align="right" name="form1"  method="post" action="process_admin.php" class="admin-email-form">
              <label>
                  <input type="email" style="heght:40px" class="form-control" name="adminemail" value="User's Email">
                  <button name="adminEmailButton" type="submit"  class="btn btn-info" >New Admin</button>
              </label>
            </form>
            </div><br>        
    </body>
</html>