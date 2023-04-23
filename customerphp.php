<html>
  <head>
    <style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
    *{
      margin: 0;
      padding: 2px;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
       font-size: 30px;

    }
    html,body{
      display: grid;
      height: 100%;
      width: 100%;
      place-items: center;
    /*  background: -webkit-linear-gradient(right,#F8F8FF,#B0C4DE,	#F8F8FF);*/

    }
    #customersearch {
       padding: 10px 90px;
         background: #D3D3D3;
          color: #fff;
          border: 1px solid #eee;
          border-radius: 5px;
          box-shadow: 5px 5px 5px #eee;
          text-shadow: none;
        transform: translateY(-230px);


    }
    #goback {
       padding: 10px 80px;
         background: #D3D3D3;
          color: #fff;
          border: 1px solid #eee;
          border-radius: 5px;
          box-shadow: 5px 5px 5px #eee;
          text-shadow: none;
           transform: translateY(-100px);


    }
    * {
      box-sizing: border-box;
    }
    body {
      background-image: url('car32.jpg');
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
  </head>
  <body>

<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental";
date_default_timezone_set('Africa/Cairo');

$name=$_POST["fname"];
$password1=$_POST["fpassword"];
$password1=md5($password1);
$username1=$_POST["fusername"];
$address=$_POST["faddress"];
$phone=$_POST["fphone"];
$ssn=$_POST["fssn"];


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$resultofssn = mysqli_query($conn,"SELECT * FROM customer WHERE customer_ssn = '$ssn'");

if(mysqli_num_rows($resultofssn) != 0  ) {
     echo "You already have an account";
     $_SESSION["try4"]="SSN is already used!";

     header("Location: http://localhost/CarSystem/customer_reg.php");
}

  $sql = "INSERT INTO customer (username, name, password , phone, customer_ssn,address)
  VALUES ('$username1', '$name', '$password1' , '$phone','$ssn','$address')";

  if ($conn->query($sql) === TRUE) {
   echo "New record created successfully! ";
   echo "<br>";
  echo " Welcome $name!   ";
  } else {
   echo "Error: " . $sql . "<br>" . $conn->error;

  }
  echo "<form action='Menu.php' method='post'>
  <input type='submit' id='goback' value='Go Back to Home'>
  </form>
  
  <form action='customermenu.php' method='post'>
  <input type='submit' id='customersearch' value='Search for a Car'>
  </form>";




$conn->close();
?>
