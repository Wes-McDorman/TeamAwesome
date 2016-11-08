<?php
//define variables -- hostname,username,and password will be changed when we upload it to our remote server.
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "teamawesome";

//making the connection to mysql
$dbc = mysqli_connect($hostname, $username, $password, $dbname) OR die("could not connect to database, ERROR: ".mysqli_connect_error());

// echo "you are connected to ".$dbname." Database";
?>
