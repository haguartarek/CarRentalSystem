<?php
session_start();
date_default_timezone_set('Africa/Cairo');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental";

# get the form data
$reserve_date=$_POST["reserve_date"];
$pickup_date=$_POST["pickup_date"];
$return_date=$_POST["return_date"];
$plate_id=$_POST["plate_id"];
$customer_ssn=$_SESSION["c_ssn"];
echo "<link rel='stylesheet' href='transaction_success.css'>";

# print the form data
// echo "reserve_date: $reserve_date <br>";
// echo "pickup_date: $pickup_date <br>";
// echo "return_date: $return_date <br>";
// echo "plate_id: $plate_id <br>";
// echo "customer_ssn: $customer_ssn <br>";

# select the car from the database and insert it into the reservation table
$conn = new mysqli($servername, $username, $password, $dbname);
# Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "INSERT INTO `reservation`(`reserve_date`, `pickup_date`, `return_date`, `plate_id`, `customer_ssn`) 
        VALUES ('$reserve_date','$pickup_date','$return_date','$plate_id','$customer_ssn')";

if ($conn->query($sql) === TRUE) {
  echo "<h1>You have successfully reserved the car with plate id: $plate_id <br></h1>
  <h2>You can pick it up on $pickup_date and return it on $return_date <br></h2>
  <h2>you will be redirected to the home page in 5 seconds or click the button below if you are not redirected</h2>
  <form action='http://localhost/CarSystem/customermenu.php'>
  <input type='submit' value='Go to home page' id='submit'>
  </form>";
  header("refresh:5;url=http://localhost/CarSystem/customermenu.php");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}


?>