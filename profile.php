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
              <h6>Upload a different photo...</h6>

              <input type="file" class="form-control">
            </div>
          </div>

          

        <!-- edit form column -->
        <div class="col-md-9 personal-info">
        <div class="alert alert-info alert-dismissable">
          <a class="panel-close close" data-dismiss="alert">×</a> 
          <i class="fa fa-coffee"></i>
          Edit <strong>profile Details</strong>
        </div>
        <h3>Personal Informations</h3>

        <form class="form-horizontal" role="form">
          <div class="form-group">
            <label class="col-lg-3 control-label">First Name:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="">
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label">Last Name:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="">
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label">Credit Card Number:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" placeholder="XXX-XXXX-XXXX">
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label">Confirm Credit Card Number:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" placeholder="XXX-XXXX-XXXX">
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-3 control-label">Password:</label>
            <div class="col-md-8">
              <input class="form-control" type="password" placeholder="**********">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Confirm password:</label>
            <div class="col-md-8">
              <input class="form-control" type="password" placeholder="**********">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <input type="button" class="btn btn-primary" value="Save Changes">
              <input type="reset" class="btn btn-default" value="Cancel">
            </div>
          </div>
        </form>
        
      </div>
    </div>
    </div><br><br><br>
    
    <footer id="footer">
    <div class="container">
        <div class="pull-left fnav">
            <p>ALL RIGHTS RESERVED. COPYRIGHT © 2017. Designed by TeamMILKY &#169;</p>
            </div>
        </div>
    </footer>
    
</body>
</html>