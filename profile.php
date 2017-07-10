<?php
//////////////////////////////////////////////////////////////////
require 'database/connect.inc.php';
include 'php/profile_checking.php';
//////////////////////////////////////////////////////////////////
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
          <div class="col-md-3">
            <div class="text-center">
              <img src="img/team/02.jpg" class="avatar img-circle" alt="avatar" height="150px" width="150px">
              <h6>Upload a Different Photo</h6>
              <h6>&#91;Use 1024&nbsp;&chi;&nbsp;1024px Photo&#93;</h6>
              <input type="file" class="form-control">
            </div>
          </div>

          

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
            <label class="col-md-3 control-label">Password:</label>
            <div class="col-md-8">
              <input class="form-control" type="password" placeholder="**********" name="password"><span><?php echo $error_message_PW;?></span>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Confirm password:</label>
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
        
      </div>
    </div>
    </div><br><br><br>
    
   
    
</body>
</html>