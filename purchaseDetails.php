<?php
//////////////////////////////
include_once("php/Crud.php");
$crud=new Crud();
//////////////////////////////
?>

<html>
<head>
    <title>AccomodateMe-Purchase Details</title>
    
    <!-- styles used-->
        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Titillium+Web" rel="stylesheet">
        <link href="css/style_purchaseDetails.css" type="text/css" rel="stylesheet">
    
</head>
<body>
    <div style="float:right" class='log_out'>
            <form align="right" name="form1" method="post" action="php/logout.php">
              <label class="logoutLblPos">
                  <button name="log_out" type="submit" id="log_out" class="btn btn-info">Log Out</button>
              </label>
            </form>
            </div><br>
    <h1>Purchace Details</h1>
    <h2>Boarding Address</h2> <!--Boarding address-->
    <table class="table">
        <thead>
            <tr>
                <th>Bidder's Name</th>
                <th>Bidder's Telephone Number </th>
                <th>Bidder's e-mail</th>
                <th>Bid Amount</th>
                <th>Choose</th>
            </tr>
        </thead>
        <tbody>
        <!--echo details-->
            <!--div class="row">
                    <div class="form-group" id="selectType">
                      <label for="selectType">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Select Type</label><br>
                        `
                        <div class="selectType">
                        <label  id="selectOne"  for="exampleInputType1">
                            <input type="checkbox" class="form-control" id="exampleInputType1" name="boarding-searcher" checked onclick="selectOnlyThis(this.id)">
                            Boarding Searcher</label><br>
                        </div>
                        
                        <div class="selectType">
                        <label  id="selectTwo" for="exampleInputType2">
                            <input type="checkbox" class="form-control" id="exampleInputType2" name="boarding-owner" onclick="selectOnlyThis(this.id)">
                            Boarding Owner &nbsp;&nbsp;&nbsp;</label>
                        </div>
                        
                      </div>
                  </div-->
            
        </tbody>
    </table>
    <div style="float:right">
            <form align="right" name="form2"  method="post" action="process_admin.php" class="admin-email-form">
              <label>
                  <input type="number" style="color:white" class="form-control" name="remove_email" value="Boarding ID">
                  <input type="email" style="color:white" class="form-control" name="confirmPurchaseEmail" value="User's Email">
                  <button name="confirmPurchaseButton" type="submit"  class="btn btn-info">Sell the Boarding</button>
              </label>
            </form>
            </div>
</body>
     <!--selecting only one from checkbox-->
    <script>
        function selectOnlyThis(id){
            for(var i=1;i<=2;i++){
                document.getElementById("exampleInputType"+i).checked=false;
            }
            document.getElementById(id).checked=true;
        }
    </script>    
    <!------------------------------------->
</html>