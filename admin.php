

<?php
   include("config.php");
   $id= " ";
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $id = test_input($_POST["id"]);
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<!DOCTYPE html>
<html>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="dbms.css">

</head>
<body onscroll="myFunction()" onscroll="myFunction2()">





<div id="fix"><image src="india.png" class="top" width="50%" ><image src="india.png" class="top" width="50%" ></div>

<div id="navbar">
  <a class="active" href="two.html">Home</a>
  
</div>

<div class="header" id="header1">
  <h1>WELCOME TO ADMIN PAGE</h1>
</div>

<script>
var navbar = document.getElementById("navbar");

var sticky = navbar.offsetTop;

function myFunction() {
  if (window.scrollY >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}

</script>
<?php 
$result = mysqli_query($db,"SELECT * FROM citizen where request is not null ");
?>

<div class="myform">
<!--<div class="w3-container">-->
  <h1>UPDATION REQUEST</h1>
  <button onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-black">Display</button>
   
   <div id="id01" class="w3-modal">
    <div class="w3-modal-content">
      <div class="w3-container">
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>


         <div class="form">
         <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
          
              <th>CITIZEN NO</th>
              <th>NAME</th>
              <th>EMAIL</th>
              <th>REQUEST</th>
              <th>KEY</th>
              <?php

                   
                     while($row = mysqli_fetch_array($result)) 
                     {  

                ?>
          <tr>
                  <td><?php echo $row['cid']; ?></td> 
                  <td><?php echo $row['name']; ?></td>  
                  <td><?php echo $row['email']; ?></td> 
                  <td><?php echo $row['request']; ?></td> 
                  <td><?php echo $row['rkey']; ?></td> 
                  
          </tr> 
                <?php

                }
                
                 ?>

              
                 </table>
              </div>
            </div>
      </div>
    </div>
  </div>
</div>

<div class="myform">
<h1>KEY ASSIGNMENT TO REQUEST </h1>
  
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
       <div>
       CITIZEN ID:<input  type="text" name="id" >
  <span class="error"></span>
  <br><br>
      <input type="submit" name="submit" value="Submit"> 
      </div> 
     </form>
  <?php

 $MIN_SESSION_ID = 1000000000;
$MAX_SESSION_ID = 9999999999;

$key = mt_rand($MIN_SESSION_ID, $MAX_SESSION_ID);



  if( $id != " ")
  {$sql = "UPDATE citizen  set rkey= '$key' WHERE cid ='$id'";

if ($db->query($sql) === TRUE) {
    echo "<br>";
    echo " <h2> Key Successfully Submitted</h2>";
} else {
    echo " <h2> Error: Unable to Submit your key </h2>";
}}
?>

 </div> 


 <?php

$result = mysqli_query($db,"SELECT * FROM citizen where cid ='$id' ");
$row = mysqli_fetch_array($result);
 echo "<br>";
//define the receiver of the email
 if( $row['rkey'] != 0)
{$to = $row['email'];
//define the subject of the email
$subject = 'This Is your key Do not share it with anyone '; 
//define the message to be sent. Each line should be separated with \n
$message = $row['rkey'] ; 
//define the headers we want passed. Note that they are separated with \r\n
$headers = "From: indiancitizenportal@india.com\r\nReply-To: indiancitizenportal@india.com";
//send the email
$mail_sent = @mail( $to, $subject, $message, $headers );
//if the message is sent successfully print "Mail sent". Otherwise print "Mail failed" 
echo $mail_sent ? "<h2>Mail sent</h2>" : "<h2>Mail failed</h2>";
}
?>  

<div class=" myform" >
  
  <form method="get" action="detail.php">
  <button type="submit" class="btn btn-primary btn-block">ADD NEW CITIZEN DETAIL</button>
</form>
</div>
<h2><a href = "logout1.php">Sign Out</a></h2>

<footer class="text-center">
  <a class="up-arrow" href="#fix" data-toggle="tooltip" title="TO TOP">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br><br>
  <p>INDIAN CITIZEN PORTAL ADMIN PAGE<a href="https://www.shopiteasyshop.com" title="Visit w3schools"></br>www.indiancitizenportal.com</a></p>
  <p>THIS IS MY DBMS PROJECT</br></p>  
</footer>

       
 </body>
   
</html>