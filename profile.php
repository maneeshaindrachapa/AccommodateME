<?php
//////////////////////////////////
include_once("php/Crud.php");
include_once('php/Validation.php');
include('php/profile_checking.php');
//////////////////////////////////
$crud=new Crud();
$validation=new Validation();
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
                <div  class="avatar img-circle"></div>
                <style>
                    .avatar{
                        height:150px;
                        width: 150px;
                        background-image:url('<?php echo $location; ?>');
                        background-size:cover;
                        background-position:50% 50%;
                        background-size: 150px;
                        background-repeat: no-repeat;
                    }
                    .img-circle{
                        margin-left:50px;
                    }
                </style>
                
              <h6>Upload a Different Photo</h6>
              <h6>&#91;Use 1024&nbsp;&chi;&nbsp;1024px Photo&#93;</h6>
              <input type="file" class="form-control" name="profilepicture"> <br>
              <button type="submit" class="btn btn-primary" name='profileSubmit' >Update Profile Picture</button>
            </div>
            </div>
                <?php
                ///////////////////////////////////////////
                
                if(isset($_POST['profileSubmit'])){
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
                                header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
                                header("Cache-Control: post-check=0, pre-check=0", false);
                                header("Pragma: no-cache");
                                header("location:profile.php");
                            }
                        }    
                    }
                }
                }
                /////////////////////////////////////
                ?>            
            </form>
    
    

          
        
        <!-- edit form column -->
        <div class="col-md-9 personal-info">
        <h3>Personal Informations</h3>


        <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <div class="form-group">
            <label class="col-lg-3 control-label">First Name:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="<?php echo $firstName; ?>" name="firstName"><span><?php echo $error_message_FN;?></span>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label">Last Name:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="<?php echo $lastName; ?>" name="lastName"><span><?php echo $error_message_LN;?></span>
            </div>
          </div>

            <div class="form-group">
            <label class="col-lg-3 control-label">Telephone:</label>
            <div class="col-lg-8">
              <input class="form-control" type="tel" value="<?php echo $telephone; ?>" name="telephone"><span><?php echo $error_message_TEL;?></span>
            </div>
          </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">E-mail:</label>
                <div class="col-lg-8">
                    <input class="form-control" type="email" value="<?php echo $email; ?>" name="email" disabled><span><?php echo $error_message_EM;?></span>
                </div>
            </div>
          <div class="form-group">
            <label class="col-md-3 control-label"> New Password:</label>
            <div class="col-md-8">
              <input class="form-control" type="password" placeholder="**********" name="newPassword"><span><?php echo $error_message_PW;?></span>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Confirm new password:</label>
            <div class="col-md-8">
              <input class="form-control" type="password" placeholder="**********" name="newPassword_re"><span><?php echo $error_message_RPW;?></span>
            </div>
          </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">Old password:</label>
                <div class="col-lg-8">
                    <input class="form-control" type="password" placeholder="**********" name="oldPassword"><span><?php echo $error_message_OPW;?></span>
                    <span><?php echo $fillAllData;?></span>
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
            <button style="float:right" class="btn btn-primary" onclick="history.go(-1);"><a href="process_1.php" style="color:white">Go to Previous Page</a></button></div> </div></div>
      <br><br><br>
   
   
    
</body>
</html>