<?php
session_start();
date_default_timezone_set('Africa/Cairo');

if (isset($_SESSION["try4"])) {
  echo "SSN is already associated with an account!<br>";
  unset($_SESSION["try4"]);
}
if (isset($_SESSION["try122"])) {
  echo "Username is already associated with an account!<br>";
  unset($_SESSION["try122"]);
}
if (isset($_SESSION["try123"])) {
  echo "Email is already associated with an account!<br>";
  unset($_SESSION["try123"]);
}
if (isset($_SESSION["try124"])) {
  echo "phone number is already associated with an account!<br>";
  unset($_SESSION["try124"]);
}

?>

<html>

<head>
  <link rel="stylesheet" href="style2.css">
  <style>
    body {
      background-image: url('car32.jpg');
      background-repeat: no-repeat;
      background-size: 100% 100%;
    }

    html,
    body {
      width: 100%;
      height: 100%;
      overflow: hidden;
      margin: 0;
    }
    .val_error{
      color: red;
    }
  </style>
  <script>
    function validateForm() {
      let x = document.forms["customerregform"]["fname"].value;
      let y = document.forms["customerregform"]["fpassword"].value;
      let z = document.forms["customerregform"]["fcpassword"].value;
      let e = document.forms["customerregform"]["fusername"].value;
      let s = document.forms["customerregform"]["fssn"].value;
      let a = document.forms["customerregform"]["fcountry"].value;
      let p = document.forms["customerregform"]["fphone"].value;
      let b= document.forms["customerregform"]["femail"].value;
      // var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      var error = false;
      //check if any field is empty
      if (x == "") {
        document.getElementById("fname_error").innerHTML = "Name must be filled out";
        error = true;
      } else {
        document.getElementById("fname_error").innerHTML = "";
      }
      if (e == "") {
        document.getElementById("fusername_error").innerHTML = "Username must be filled out";
        error = true;
      } else {
        document.getElementById("fusername_error").innerHTML = "";
      }
      if (y == "") {
        document.getElementById("fpassword_error").innerHTML = "Password must be filled out";
        error = true;
      } else {
        document.getElementById("fpassword_error").innerHTML = "";
      }
      if (z == "") {
        document.getElementById("fcpassword_error").innerHTML = "Password must be filled out";
        error = true;
      } else {
        if (z != y && z != "") {
          document.getElementById("fcpassword_error").innerHTML = "Password must be the same";
          error = true;
        } else {
          document.getElementById("fcpassword_error").innerHTML = "";
        }

      }
      if (s == "") {
        document.getElementById("fssn_error").innerHTML = "SSN must be filled out";
        error = true;
      } else {
        document.getElementById("fssn_error").innerHTML = "";
      }
      if (a == "") {
        document.getElementById("fcountry_error").innerHTML = "country must be filled out";
        error = true;
      } else {
        document.getElementById("fcountry_error").innerHTML = "";
      }
      if (p == "") {
        document.getElementById("fphone_error").innerHTML = "Phone must be filled out";
        error = true;
      } else {
        document.getElementById("fphone_error").innerHTML = "";
      }
      if (b == "") {
        document.getElementById("femail_error").innerHTML = "email must be filled out";
        error = true;
      } else {
        document.getElementById("femail_error").innerHTML = "";
      }
      return !error;


    }
  </script>
</head>

<body>

  <h2 id="custregtitle">CUSTOMER SIGN UP</h2>
  <form name="customerregform" id="customerregform" action="customer_reg_processing.php" onsubmit="return validateForm() " method="post">
    Name: <input type="text" id='fname' class='reg1' placeholder="Name" name="fname"> <br>
    <label id="fname_error" class="val_error"></label><br>
    Username: <input type="text" id='fusername' class='reg1' placeholder="Username" name="fusername"> <br>
    <label id="fusername_error" class="val_error"></label><br>
    Country: <input type="text" id='fcountry' class='reg1' placeholder="country" name="fcountry"> <br>
    <label id="fcountry_error" class="val_error"></label><br>
    Password: <input type="password" id='fpassword' class='reg1' placeholder="Password" name="fpassword"> <br>
    <label id="fpassword_error" class="val_error"></label><br>
    Confirm Password: <input type="password" id='fcpassword' class='reg1' placeholder="Confirm Password" name="fcpassword"> <br>
    <label id="fcpassword_error" class="val_error"></label><br>
    SSN: <input type="text" id='fssn' class='reg1' placeholder="SSN" name="fssn"> <br>
    <label id="fssn_error" class="val_error"></label><br>
    Phone Number: <input type="text" id='fphone' class='reg1' placeholder="Phone" name="fphone"> <br>
    <label id="fphone_error" class="val_error"></label><br>
   Email: <input type="email" id='femail' class='reg1' placeholder="email" name="femail"> <br>
    <label id="femail_error" class="val_error"></label><br>
    <input type="submit" id='btn' value="Submit">


  </form>

</body>

</html>