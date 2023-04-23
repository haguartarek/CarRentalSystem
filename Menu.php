<?php

  session_start();

    if(isset($_SESSION["username"]))
    {
        unset($_SESSION["username"]);
    }
    if(isset($_SESSION["password"]))
    {
        unset($_SESSION["password"]);
    }
    if(isset($_SESSION["c_ssn"]))
    {
        unset($_SESSION["c_ssn"]);
    }
    if(isset($_SESSION["try1"]))
    {
        echo"Email and password are not found!";
        unset($_SESSION["try1"]);
    }
    if(isset($_SESSION["try2"]))
    {
        echo" Incorrect Password";
        unset($_SESSION["try2"]);
    }
    if(isset($_SESSION["try3"]))
    {
        echo"Incorrect Email Address";
        unset($_SESSION["try3"]);
    }
    if(isset($_SESSION["try5"]))
    {
        echo"Admin not found!";
        unset($_SESSION["try5"]);
    }
    if(isset($_SESSION["try6"]))
    {
        echo"Incorrect Admin Password!";
        unset($_SESSION["try6"]);
    }
 ?>

<html>
<head>
      <link rel="stylesheet" href="style1.css">
      <style>
  body {
    /* background-image: url('car26.jfif'); */
    background-image: url('car102.jpg');
    background-repeat: no-repeat;
    background-size: 100% 100%;
  }
  html,
  body{
     width: 100%;
     height: 100%;
     overflow: hidden;
     margin: 0;
  }
  </style>

<script>

function validateFormadmin() {
  let x = document.forms["myForm"]["adminname"].value;
  let y = document.forms["myForm"]["adminpassword"].value;
 if (x == "" )
 {
 alert("Admin username must be filled out");

    return false;

}
if (y == "" )
{
alert("Admin password must be filled out");

   return false;

}
}
function validateForm2() {
  let x = document.forms["myForm2"]["ffemail"].value;
  let y = document.forms["myForm2"]["fpassword"].value;
 if (x == "" )
 {
 alert("Email must be filled out");

    return false;

}
if (y == "" )
{
alert("password must be filled out");

   return false;

}
}

</script>
</head>

<body>
<h2 id="carrentals">CAR RENTALS</h2>
<h4 id="subphrase">Online Car Rental Service</h4>


<form name="customerform" action="Customer_login.php" id="customerform" onsubmit="return validateForm()" method="post">
<h3 id="CustomerHeader">Customer Login</h3> 
Username:     <input type="text"placeholder="Name"style="text-transform: lowercase" id='ffemail'class="login" name="ffemail" ><br> <br>
 Password:   <input type="password"placeholder="Password" id='fpassword' class="login" name="fpassword" ><br> <br>
  <input type="submit" value="LOGIN" id='log'/><br> <br>
</form>
<form name="myForm1" action="customer_reg.php" id="myform1"  method="post">
<input  type="submit" class="reg"formaction="customer_reg.php" id='registerr' value="Click here to register">
</form>


<form name="adminform" action="admin_signin_processing.php" id="adminform"onsubmit="return validateFormadmin()"  method="post">
<h3 id="AdminHeader">Admin Login</h3>
Username:     <input type="text"placeholder="Name"style="text-transform: lowercase" id='adminname'class="login" name="adminname" ><br> <br>
  Password:   <input type="password"placeholder="Password" id='adminpassword' class="login" name="adminpassword" ><br> <br>
<input  type="submit" class="reg"formaction="admin_signin_processing.php" id='submitt' value="Submit">
</form>

</body>
</html>
