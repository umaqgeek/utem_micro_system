<?php
session_start();
include "connect.php";

$user= $_SESSION['user'];

$sql = "SELECT * from members where me_username='member'";
$result = mysql_query($sql);

if(mysql_num_rows($result)){
while($row=mysql_fetch_row($result)){
 $json['fname']= $row[2];
 $json['lname']= $row[3];
 $json['mdname']= $row[18];
 $json['uname']= $row[4];
 $json['email']= $row[21];
 $json['bday']= $row[16];
 $json['wsno']= $row[20];
 $json['add1']= $row[9];
 $json['add2']= $row[10];
 $json['poskod']= $row[11];
 $json['country']= $row[12];
 $json['phno']= $row[15];
 $json['issue_id']= $row[13];
 $json['link']= $row[8];
 $json['lesen']= $row[14];
 $json['nasionality']= $row[19];
 $json['desc']= $row[17];
 
 }
}
echo json_encode($json);
 
?>