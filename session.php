<?php
   include('config.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select cid from citizen where cid = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['cid'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:one.html");
   }
?>