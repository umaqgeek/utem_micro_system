<?php
session_start();
include "connect.php";

	$fname = $_POST['me_firstname'];	
	$lname = $_POST['me_lastname'];	
	$nmame = $_POST['me_maiden_name'];	
	$uname = $_POST['me_username'];	
	$email = $_POST['me_email'];	
	$bday = $_POST['me_birth_date'];	
	$ws_no = $_POST['me_whatsapp_no'];	
	$add1 = $_POST['me_address1'];	
	$add2 = $_POST['me_address2'];	
	$poskod = $_POST['me_postcode'];	
	$country = $_POST['me_country'];	
	$phno = $_POST['me_phone_no'];	
	$issue_id = $_POST['me_government_issue_id'];	
	$lesen = $_POST['me_driver_license'];	
	$unik = $_POST['me_unique_link'];	
	$nasional = $_POST['me_nationality'];	
	$desc = $_POST['me_description'];		
	
$sql = "SELECT * from members where me_username='member'";
$result = mysql_query($sql);

if ($result === FALSE){
	  echo mysql_error();
  }else{
	  echo '<a align="center">Profile updated!</a>';
  }
 
?>