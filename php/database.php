<?php
    //1.Create a database connection
    $dbhost="localhost";
    $dbuser="accomodateMe";
    $dbpass="milky";
    $dbname="Customers";
    
    $connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

    //test if connection occurred
    if(mysqli_connect_errno()){
        die("Database connection failed:".mysqli_connect_error()."(".mysqli_connect_errno().")");
    }
?>

<?php
//2.perform database query
$query="select * from boardingSearcher";
$result=mysqli_query($connection,$query);

//there was a query error
if(!$result){
    die("Database query failed.");
}
?>

<?php
//3.use returned data (if any)
    while($row=mysqli_fetch_row($result)){
        //output data from each row
        var_dump($row);
        echo "<hr>";
    }

    //if associative array is used
    while($row=mysqli_fetch_assoc($result)){
        //output data from each row
        echo $row["id"]. "<br>";
        echo $row["firstName"]. "<br>";
        echo $row["lastName"]. "<br>";
        echo $row["email"]. "<br>";
        echo $row["password"]. "<br>";
}



?>

<?php
//4.released the returned data
mysqli_free_result($result);
?>

<?php
//5.close database connection
mysqli_close($connection);
?>