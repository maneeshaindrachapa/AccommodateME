<?php

$mysql_host='localhost';
$mysql_user='root';
$mysql_pass='';
$mysql_database='accomodate_me';
$conn_error='Could not connect to the database';

$db = @mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_database);
if(mysqli_connect_errno()) {
    die($conn_error);
}

?>