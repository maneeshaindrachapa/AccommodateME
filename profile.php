<?php
//////////////////////////////////////////////////////////////////
require 'database/connect.inc.php';
include 'php/profile_checking.php';

$emailprof=$_SESSION['email'];

$sql5 = "SELECT profPic FROM users WHERE email='$emailprof' ";
$result5 = $db->query($sql5);
$row5 = mysqli_fetch_assoc($result5);
$profile=$row5['profPic'];
/////////////////////////////////////////////////////////////////
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>AccomodateMe</title>

<!--styles used-->
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/style_profile.css" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Titillium+Web" rel="stylesheet">




</head>
<body>
        <div class="container" >
        <h1>Edit Profile</h1>
        <hr>
        <div class="row" >
          <!-- left column -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
          <div class="col-md-3">
            <div class="text-center">
              <img src="profPic/<?php echo $profile;?>" class="avatar img-circle" alt="avatar" height="150px" width="150px">
              <h6>Upload a Different Photo</h6>
              <h6>&#91;Use 1024&nbsp;&chi;&nbsp;1024px Photo&#93;</h6>
              <input type="file" class="form-control" name="profUpdate"><br>
              <button type="submit" class="btn btn-primary" name='profileSubmit' >Update Profile Picture</button>
                 
                <?php
                ///////////////////////////////////////////
                
                if(isset($_POST['profileSubmit'])){
                    $p_name=$_FILES['profUpdate']['name'];
                    $p_size=$_FILES['profUpdate']['size'];
                    $p_type=$_FILES['profUpdate']['type'];
                    $p_temp_name=$_FILES['profUpdate']['tmp_name'];
                    $p_extention=strtolower(substr($p_name,strpos($p_name,'.')+1));
                    $p_max_size=5242880;
                if(isset($p_name)){
                    if(!empty($p_name)){
                        if(($p_extention=='jpg' || $p_extention=='jpeg')&&($p_type=='image/jpeg')&&($p_size<=$p_max_size)){
                            $location = 'profPic';
                            if(is_dir($location)==false){
                                mkdir("$location", 0700);// Create directory if it does not exist
                                        }
                            $sql6="SELECT userID FROM users WHERE email='$emailprof' ";
                            $result6 =$db->query($sql6);
                            $row6 = mysqli_fetch_assoc($result6);
                            $p_id=$row6['userID'];
                            $new_p_name=$p_id.'.'.$p_extention;

                            if (move_uploaded_file($p_temp_name, "$location/" .$new_p_name)) {
                                $sql = "UPDATE users SET profPic='$new_p_name' WHERE email='$email'";
                                mysqli_query($db,$sql);
                                header("location:profile.php");
                            }
                        }    
                    }
                }
                }
                /////////////////////////////////////
                ?>
                
            </div>
          </div>
            </form>

          

        <!-- edit form column -->
        <div class="col-md-9 personal-info">
        <h3>Personal Informations</h3>

        <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            
          <div class="form-group">
            <label class="col-lg-3 control-label">First Name:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="<?php echo $row1['firstName']?>" name="firstName"><span><?php echo $error_message_FN;?></span>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label">Last Name:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="<?php echo $row2['lastName']?>" name="lastName"><span><?php echo $error_message_LN;?></span>
            </div>
          </div>
            
            <div class="form-group">
            <label class="col-lg-3 control-label">Telephone:</label>
            <div class="col-lg-8">
              <input class="form-control" type="tel" value="<?php echo "0".$row3['telephone'];?>" name="telephone"><span><?php echo $error_message_TEL;?></span>
            </div>
          </div> 

          <div class="form-group">
            <label class="col-lg-3 control-label">Credit Card Number:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" placeholder="XXX-XXXX-XXXX" name="creditcardnum"><span><?php echo $error_message_CCN;?></span>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label">Confirm Credit Card Number:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" placeholder="XXX-XXXX-XXXX" name="rcreditcardnum"><span><?php echo $error_message_RCCN;?></span>
            </div>
          </div>

        <div class="form-group">
            <label class="col-md-3 control-label">Old Password:</label>
            <div class="col-md-8">
              <input class="form-control" type="password" placeholder="**********" name="o_password"><span><?php echo $error_message_OPW; ?></span>
            </div>
          </div>
            
          <div class="form-group">
            <label class="col-md-3 control-label">New Password:</label>
            <div class="col-md-8">
              <input class="form-control" type="password" placeholder="**********" name="password"><span><?php echo $error_message_PW;?></span>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Confirm New Password:</label>
            <div class="col-md-8">
              <input class="form-control" type="password" placeholder="**********" name="rpassword"><span><?php echo $error_message_RPW;?></span>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <input type="submit" class="btn btn-primary" value="Save Changes" name="save">
              <input type="reset" class="btn btn-default" value="Cancel" name="reset">
            </div>
          </div>
        </form>
            <button style="float:right" class="btn btn-primary" onclick="history.go(-1);"><a href="" style="color:white">Go to Previous Page</a></button>
      </div>
    </div>
    </div><br><br><br>
    
   
    
</body>
</html>