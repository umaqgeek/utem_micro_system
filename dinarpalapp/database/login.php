<?php 

include "connect.php";


 if (isset($_POST['name'])  && isset($_POST['pass'])){
 
  $user= $_POST['name'];
  $pass= $_POST['pass'];
  
  $sql = "SELECT * from members where me_username = '".$user."' and me_password = '".$pass."';";
  $result = mysql_query($sql);

  $numrow = mysql_num_rows($result);
  
    if($numrow != 0){
      
      echo 'true';
      
    }else{ echo 'WRONG USERNAME/PASSWORD!';}

 }else{ echo 'LOGIN ERROR!';}
?>