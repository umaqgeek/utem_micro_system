<?php 
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = mysql_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysql_error());
}

$db_selected = mysql_select_db('dinarpal_db');
if (!$db_selected) {
    die ('Can\'t use DB : ' . mysql_error());
}
?>