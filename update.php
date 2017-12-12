<?php
   include('session.php');
   $key="";
   $pno ="";
   $add = "";
  $gender= "";
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $key = test_input($_POST["key"]);
   $add= test_input($_POST["add"]);
   $gender= test_input($_POST["gender"]);
   $pno = test_input($_POST["pno"]);
   
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
  <h1>WELCOME TO UPDATION PAGE</h1>
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
<h2>You are eligible to change only your address,gender and phone no.Visit nearest office for any other updation. </h2>
<div class="myform">
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
       <div>
       Key: <input type="text" name="key" >
  <span class="error"></span>
  <br><br>
Phone Number:<input  type="number" name="pno" >
  <span class="error"></span>
  <br><br>
Address: <textarea name="add" rows="5" cols="40" width="100%"></textarea>
   <span class="error"></span>
  <br><br>
  <br><br>
Gender:
  <input type="radio" name="gender"  value="female">Female
  <input type="radio" name="gender"  value="male">Male
  <span class="error"></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>
</div>    
     </form>
  </div>  

  <?php
 $a=$b=$c=0;

  if( $key != "")
  { $result = mysqli_query($db,"SELECT cid FROM citizen WHERE cid ='$login_session'and rkey ='$key'");
    $row = mysqli_fetch_array($result);
    $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
     if($count != 1){
    echo " <h2> Error: Invalid Key </h2>";
}
      else if($count == 1) 
  {
  
   
  if( $pno != "")
  {$sql = "UPDATE citizen  set pno = '$pno' WHERE cid ='$login_session'";

if ($db->query($sql) === TRUE) {
    echo "<br>";
    echo " <h2> Phone Number Updated </h2>";
    $a=1;
} }
if( $add!= "")
  {$sql = "UPDATE citizen  set address= '$add' WHERE cid ='$login_session'";

if ($db->query($sql) === TRUE) {
    echo "<br>";
    echo " <h2> Address Updated </h2>";
    $b=1;
} }
if( $gender != "")
  {$sql = "UPDATE citizen  set gender = '$gender' WHERE cid ='$login_session'";

if ($db->query($sql) === TRUE) {
    echo "<br>";
    echo " <h2> Gender Updated</h2>";
    $c=1;
} }

if(($a==1) ||($b ==1)||($c==1))
{
$sql = "UPDATE citizen  set rkey= 0 WHERE cid ='$login_session'";

if ($db->query($sql) === TRUE) {
    }

 $sql = "UPDATE citizen  set request ='' WHERE cid ='$login_session'";

if ($db->query($sql) === TRUE) {
    }
   

}}
}
?>


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