

<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental";
date_default_timezone_set('Africa/Cairo');

$name=$_POST["fname"];
$password1=$_POST["fpassword"];
// $password1=md5($password1);
$username1=$_POST["fusername"];
$country=$_POST["fcountry"];
$phone=$_POST["fphone"];
$ssn=$_POST["fssn"];
$email=$_POST["femail"];

echo "<link rel='stylesheet' href='transaction_success.css'>";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$resultofssn = mysqli_query($conn,"SELECT * FROM customer WHERE customer_ssn = '$ssn'");
$resultofusername= mysqli_query($conn,"SELECT * FROM customer WHERE username = '$username1'");
$resultofemail= mysqli_query($conn,"SELECT * FROM customer WHERE email = '$email'");
$resultofphone= mysqli_query($conn,"SELECT * FROM customer WHERE phone = '$phone'");
if(mysqli_num_rows($resultofssn) != 0  ) {
     echo "<h1>SSN is already associated with an account!</h1>
     <h2>you will be redirected to the register page in 5 seconds or click the button below if you are not redirected</h2>
      <form action='http://localhost/CarSystem/customer_reg.php'>
      <input type='submit' value='Register another customer' id='submit'>
      </form>
      </body>

     ";
     $_SESSION["try4"]="SSN is already associated with an account!";

     header("Location: http://localhost/CarSystem/customer_reg.php");
}
if (mysqli_num_rows($resultofusername) != 0) {
  echo "<h1>Username is already associated with an account!</h1>
  <h2>you will be redirected to the register page in 5 seconds or click the button below if you are not redirected</h2>
   <form action='http://localhost/CarSystem/customer_reg.php' method='post'>
   <input type='submit' value='Register another customer' id='submit'>
   </form>
   </body>";
    $_SESSION["try122"]="Username is already associated with an account!";
    header("Location: http://localhost/CarSystem/customer_reg.php");
}

if(mysqli_num_rows($resultofemail) != 0  ) {
  echo "<h1>email is already associated with an account!</h1>
  <h2>you will be redirected to the register page in 5 seconds or click the button below if you are not redirected</h2>
   <form action='http://localhost/CarSystem/customer_reg.php'>
   <input type='submit' value='Register another customer' id='submit'>
   </form>
   </body>";
  $_SESSION["try123"]="Email is already associated with an account!";

  header("Location: http://localhost/CarSystem/customer_reg.php");
}
if(mysqli_num_rows($resultofphone) != 0  ) {
  echo "<h1>Phone is already associated with an account!</h1>
  <h2>you will be redirected to the register page in 5 seconds or click the button below if you are not redirected</h2>
   <form action='http://localhost/CarSystem/customer_reg.php'>
   <input type='submit' value='Register another customer' id='submit'>
   </form>
   </body>

  ";
  $_SESSION["try124"]="Phone number is already associated with an account!";

  header("Location: http://localhost/CarSystem/customer_reg.php");
}

  $sql = "INSERT INTO customer (username, name, password , phone, customer_ssn,country,email)
  VALUES ('$username1', '$name', md5('$password1') , '$phone','$ssn','$country','$email')";

  if ($conn->query($sql) === TRUE) {
   echo "<h1>Customer $name Registered successfully</h1>
   <h2>You will be redirected to the user page in 5 seconds or click the button below if you are not redirected</h2>
    <form action='Customer_login.php' method='post'>
      <input type='hidden' name='ffemail' class='ffemail' id='ffemail' value='$username1'>
      <input type='hidden' name='fpassword' class='fpassword' id='fpassword' value='$password1'>
      <input type='submit' value='Login' id='submit'>
      <script>
      setTimeout(function(){
        document.getElementById('submit').click();
      }, 3000);
      </script>
   <br>";
  } else {
   echo "Error: " . $sql . "<br>" . $conn->error;
  }




$conn->close();
?>
