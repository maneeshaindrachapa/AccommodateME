<?php
///////////////////////////////////////////////////////////////
require 'database/connect.inc.php';
session_start();
$email=$_SESSION['email'];
$name="SELECT firstName FROM users where email='$email'";
$name_result=$db->query($name);
$name_result_row=mysqli_fetch_assoc($name_result);

$sql="SELECT userID,firstName,lastName,email,password,telephone,type,creditCardNo FROM users";
$sql_1="SELECT boardingID,userID,studentCount,price,distance,address FROM boarding_details";
$result_1=$db->query($sql_1);
$result=$db->query($sql);
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
        <h1>Welcome&nbsp;<?php echo $name_result_row['firstName'];?></h1>
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
                <th>Credit Card No</th>
            </tr>
            </thead>
            <tbody>
        <?php
        ///////////////////////////////////////////////////
        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
                echo  "<tr><td>".$row['userID']."</td><td>".$row['firstName']."</td><td>".$row['lastName']."</td><td>".$row['email']."</td><td>".$row['password']."</td><td>".$row['telephone']."</td><td>".$row['type']."</td><td>".$row['creditCardNo']."</td></tr>";
                }
            }else {
                echo "0 results";
                }
        /////////////////////////////////////////////////
        ?>
            </tbody>
        </table>
        <div style="float:right">
            <form align="right" name="form2"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="admin-email-form">
              <label>
                  <input type="email" style="color:white" class="form-control" name="remove_email" value="User's Email">
                  <button name="removeEmailButton" type="submit"  class="btn btn-info">Remove User</button>
              </label>
            </form>
            </div><br><br><br><br><br><br>
            
        <?php
        ////////////////////////////////////////////////////
        $error_remove_email="";
        if(isset($_POST['removeEmailButton']) && isset($_POST['remove_email'])){
            $remove_email=$_POST['remove_email'];
            $sql_3= "DELETE FROM users WHERE email='$remove_email'";
            if($query_run=mysqli_query($db,$sql_3)){
                header("location:process_admin.php");
            }else{
            }
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
                <th>Student Count</th>
                <th>Price</th>
                <th>Distance from University</th>
                <th>Address</th>
            </tr>
            </thead>
            <tbody>
        <?php
        ///////////////////////////////////////////////////
        if ($result_1->num_rows > 0) {
        // output data of each row
            while($row_1= $result_1->fetch_assoc()) {
                echo  "<tr><td>".$row_1['boardingID']."</td><td>".$row_1['userID']."</td><td>".$row_1['studentCount']."</td><td>".$row_1['price']."</td><td>".$row_1['distance']."</td><td>".$row_1['address']."</td></tr>";
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
        $sql_3= "UPDATE users SET type='$type' WHERE email='$adminemail'";
        if($query_run=mysqli_query($db,$sql_3)){
            header("location:process_admin.php");
        }else{
        }
    }else{
    }
    ///////////////////////////////////////////
    ?>
        
        <div style="float:right">
            <form align="right" name="form1"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="admin-email-form">
              <label>
                  <input type="email" style="heght:40px" class="form-control" name="adminemail" value="User's Email">
                  <button name="adminEmailButton" type="submit"  class="btn btn-info" >New Admin</button>
              </label>
            </form>
            </div><br>        
    </body>
</html>