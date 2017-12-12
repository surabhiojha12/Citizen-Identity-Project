<?php
   include("config.php");
  // define variables and set to empty values
$nameErr = $emailErr = $adderr = $stateerr  = $pnoerr = $doberr  = $genderErr ="";
$name = $email = $gender = $add = $state= $cid = $pno =$dob = $pas =  "";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed"; 
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
    }
  }
  

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
  

  if (empty($_POST["add"])) {
    $adderr = "Address is required";
  } else {
    $add = test_input($_POST["add"]);
    // check if name only contains letters and whitespace
    //if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      //$adderr = "Only letters and white space allowed"; 
    }
  

   if (empty($_POST["state"])) {
    $stateerr = "Speciality is required";
  } else {
    $state = test_input($_POST["state"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$state)) {
      $stateerr = "Only letters and white space allowed"; 
    }
  }

   
   if (empty($_POST["pno"])) {
    $pnoerr = "Phone Number is required";
  } else {
    $pno = test_input($_POST["pno"]);
    // check if name only contains letters and whitespace
    if (!is_numeric($pno)) {
      $pnoerr = "Only Numbers allowed"; 
    }
  }

   

   if (empty($_POST["dob"])) {
    $doberr = "Date of birth is required";
  } else {
    $dob = test_input($_POST["dob"]);
    // check if name only contains letters and whitespace
    }
  

   
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
  <h1>ENTER NEW CITIZEN DETAIL</h1>
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

<div class="myform">
<p><span class="error">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  
  Name: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  DOB:<input type="date" name="dob"  value="<?php echo $dob;?>"><br>
  <span class="error">* <?php echo $doberr;?></span>
  <br><br>
  Phone Number:<input  type="number" name="pno" value="<?php echo $pno;?>">
  <span class="error"><?php echo $pnoerr;?></span>
  <br><br>
  E-mail: <input type="email" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  
  State: <input type="text" name="state" value="<?php echo $state;?>">
  <span class="error"><?php echo $stateerr;?></span>
  <br><br>
  Address: <textarea name="add" rows="5" cols="40" width="100%"><?php echo $add;?></textarea>
   <span class="error"><?php echo $adderr;?></span>
  <br><br>
  <br><br>
  Gender:
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>
</div>

<?php
function generateRandomString($length = 10) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$cid=generateRandomString();

function generate_password($length = 10){
  $chars =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.
            '0123456789`-=~!@#$%^&*()_+,./<>?;:[]{}\|';

  $str = '';
  $max = strlen($chars) - 1;

  for ($i=0; $i < $length; $i++)
    $str .= $chars[random_int(0, $max)];

  return $str;
}
$pas=generate_password();

// Check connection

if (($name == "") || ($email == "") || ($gender == "") || ($add == "" ) || ($state=="") || ($cid == "") || ($pno =="") || ( $dob =="") || ($pas ==""))
{echo "<br>";
echo " <h2> Enter the details properly </h2>";
}

else
// Create connection
{

$sql = "INSERT INTO citizen (cid,name,dob,pno,address,state,gender,email,password)
VALUES ('$cid', '$name','$dob','$pno','$add','$state','$gender','$email','$pas')";

if ($db->query($sql) === TRUE) {
    echo "<br>";
    echo " <h2> New record created successfully </h2>";

    
//define the receiver of the email
$to = $email;
//define the subject of the email
$subject = 'The INDIAN  CITIZEN  NUMBER '; 
//define the message to be sent. Each line should be separated with \n
$message = $cid; 
//define the headers we want passed. Note that they are separated with \r\n
$headers = "From: indiancitizenportal@india.com\r\nReply-To: indiancitizenportal@india.com";
//send the email
$mail_sent = @mail( $to, $subject, $message, $headers );
//if the message is sent successfully print "Mail sent". Otherwise print "Mail failed" 
echo $mail_sent ? "<h2>CITIZEN NO Mail sent</h2>" : " <h2>CITIZEN NO Mail failed</h2>";


//define the receiver of the email
$to = $email;
//define the subject of the email
$subject = 'The INDIAN CITIZEN PASSWORD DO NOT SHARE WITH ANYONE '; 
//define the message to be sent. Each line should be separated with \n
$message = $pas; 
//define the headers we want passed. Note that they are separated with \r\n
$headers = "From: indiancitizenportal@india.com\r\nReply-To: indiancitizenportal@india.com";
//send the email
$mail_sent = @mail( $to, $subject, $message, $headers );
//if the message is sent successfully print "Mail sent". Otherwise print "Mail failed" 
echo $mail_sent ? "<h2>Password Mail sent</h2>" : "<h2>Password Mail failed</h2>";


} else {
    echo "<h2>Error: UNable to insert</h2>";
}

echo "<br>";
//echo " YOUR DATA OF DB";
}

 $result = mysqli_query($db,"SELECT * FROM citizen where email ='$email' ");



?>
<div>
<!--<div class="w3-container">-->
  <h1>NEWLY ADDED CITIZEN DETAIL</h1>
  <button onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-black">Display</button>
   
   <div id="id01" class="w3-modal">
    <div class="w3-modal-content">
      <div class="w3-container">
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>


         <div class="form">
         <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
          
              <th>CITIZENID</th>
              <th>NAME</th>
              <th>DATE OF BIRTH</th>
              <th>PHONE NO</th>
              <th>ADDRESS</th>
              <th>STATE</th>
              <th>GENDER</th>
              <th>EMAIL</th>
              <th>PASSWORD</th>
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
                  <td><?php echo $row['password']; ?></td> 
                  
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