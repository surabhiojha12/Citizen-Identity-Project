<?php
   include('session.php');
   $request= " ";
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $request = test_input($_POST["request"]);
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
  <a class="active" href="one.html">Home</a>
  
</div>

<div class="header" id="header1">
  <h1>WELCOME TO USER PAGE</h1>
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
$result = mysqli_query($db,"SELECT * FROM citizen where cid ='$login_session'");
?>

<div class="myform">
<!--<div class="w3-container">-->
  <h1>YOUR DETAILS</h1>
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
              <th>DATE OF BIRTH</th>
              <th>PHONE NO</th>
              <th>ADDRESS</th>
              <th>STATE</th>
              <th>GENDER</th>
              <th>EMAIL</th>
              
              <?php

                   
                     while($row = mysqli_fetch_array($result)) 
                     {  

                ?>
          <tr>
                  <td><?php echo $row['cid']; ?></td> 
                  <td><?php echo $row['name']; ?></td>  
                  <td><?php echo $row['dob']; ?></td> 
                  <td><?php echo $row['pno']; ?></td> 
                  <td><?php echo $row['address']; ?></td> 
                  <td><?php echo $row['state']; ?></td> 
                  <td><?php echo $row['gender']; ?></td> 
                  <td><?php echo $row['email']; ?></td> 
                  
                  
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
<h1>REQUEST FOR UPDATION </h1>
  
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
       <div>
       REQUEST: <textarea name="request" rows="5" cols="40" width="100%"></textarea>
          <span class="error"></span>
      <br><br>
      <input type="submit" name="submit" value="Submit"> 
      </div> 
     </form>
  <?php

  if( $request != " ")
  {$sql = "UPDATE citizen  set request = '$request' WHERE cid ='$login_session'";

if ($db->query($sql) === TRUE) {
    echo "<br>";
    echo " <h2> Request Successfully Submitted</h2>";
} else {
    echo " <h2> Error: Unable to Submit your request </h2>";
}}
?>

 </div>   

<div>
<h1>VIEW REQUEST STATUS</h1>
  <?php
  $result_1 = mysqli_query($db,"SELECT * FROM citizen where cid ='$login_session'");
  $row1= mysqli_fetch_array($result_1);
  if( $row1['request'] == "") 
  	{echo "<h2> No request Was Made </h2>";}
  elseif (!($row1['request'] == "") && $row1['rkey'] == 0) 
  {
   	echo "<h2> Request Under Process </h2>";
   } 
  else
  { echo "<h2> A key has been sent to your Registered email. Use link below to Change Detail</h2>"  ;

   ?>
 <div class=" myform" >
  
  <form method="get" action="update.php">
  <button type="submit" class="btn btn-primary btn-block">CHANGE DETAIL</button>
</form>
  
</div>


 <?php }

  ?>
</div>




<h2><a href = "logout.php">Sign Out</a></h2>

<footer class="text-center">
  <a class="up-arrow" href="#fix" data-toggle="tooltip" title="TO TOP">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br><br>
  <p>INDIAN CITIZEN PORTAL<a href="https://www.shopiteasyshop.com" title="Visit w3schools"></br>www.indiancitizenportal.com</a></p>
  <p>THIS IS MY DBMS PROJECT</br></p>  
</footer>

       
 </body>
   
</html>