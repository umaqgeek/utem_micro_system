<?php 

include "connect.php";
 
  $name= $_POST['name'];
  $lname= $_POST['lname'];
  $mail= $_POST['mail'];
  $pass= $_POST['pass'];
  
  $sql = "INSERT INTO members(me_firstname,me_lastname,me_username,me_password,me_unique_link,me_register_date,me_account_type,me_activation_status,ml_id,me_status)
						VALUES('".$name."', '".$lname."', '".$mail."', '".$pass."', '".$mail."', now(), 1, 1, 3, 1);";
  $result = mysql_query($sql);

  if ($result === FALSE){
	  echo mysql_error();
  }else{
	  echo '<a align="center">Registration Successful!</a>';
  }

?>