<?php

  session_start();
  date_default_timezone_set('Africa/Cairo');

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
 ?>
 ?>

<html>
<head>

<script>

function validateForm() {
  let x = document.forms["myForm"]["ffemail"].value;
  let y = document.forms["myForm"]["fpassword"].value;
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

<h2>LOGIN FORM</h2>


<form name="myForm" action="Validate.php" id="myform" onsubmit="return validateForm()" method="post">
 Username:     <input type="text"placeholder="Name"style="text-transform: lowercase" id='ffemail'class="login" name="ffemail" ><br> <br>
 Password:   <input type="password"placeholder="Password" id='fpassword' class="login" name="fpassword" ><br> <br>
  <input type="submit" value="LOGIN" id='log'/><br> <br>
  <input type="reset" value="Reset" />



</body>
</html>
