<?php
session_start();
$servername = "localhost";
$username="root";
$password="";
$dbname="car_rental";
echo "
<head>
<link rel='stylesheet' href='transaction_success.css'>
</head>";
date_default_timezone_set('Africa/Cairo');
# get the form data
$model=$_POST["model"];
$plate_id=$_POST["plate_id"];
$color=$_POST["color"];
$year=$_POST["year"];
$office=$_POST["office_id"];
$speed=$_POST["speed"];
$price=$_POST["daily_price"];
$status=$_POST["status"];
$brand=$_POST["brand"];

$status_date=date("Y/m/d H:i:s");
$error=false;
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$result_plate_id=mysqli_query($conn,"SELECT * FROM car WHERE plate_id = '$plate_id'");
if(mysqli_num_rows($result_plate_id) != 0  ) {
     $_SESSION["plate_id"]="Plate ID is already used!";
     header("Location: http://localhost/CarSystem/registercar.php");
     $error=true;
}

$result_office=mysqli_query($conn,"SELECT * FROM office WHERE office_id = '$office'");
if(mysqli_num_rows($result_office) == 0  ) {
     $_SESSION["office_id"]="Office ID does not exist!";
     header("Location: http://localhost/CarSystem/registercar.php");
    $error=true;
}

if($error==false){
$SQL_Query_car="INSERT INTO `car`(`model`, `plate_id`, `color`, `year`, `brand`, `speed`, `office`, `daily_price`) 
VALUES('$model','$plate_id','$color','$year','$brand','$speed','$office','$price')";
$SQL_Query_car_status="INSERT INTO `status`(`plate_id`, `status_date`, `car_status`)
VALUES('$plate_id','$status_date','$status')";


if ($conn->query($SQL_Query_car)==TRUE && $conn->query($SQL_Query_car_status)==TRUE) {
  echo "
  <body>
  <h1>Car $plate_id Registered successfully</h1>
  <h2>you will be redirected to the register car page in 5 seconds or click the button below if you are not redirected</h2>
  <form action='http://localhost/CarSystem/registercar.php'>
  <input type='submit' value='Register another car' id='submit'>
  </form>
  </body>
    ";
  header("refresh:5;url=http://localhost/CarSystem/registercar.php");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}}
?>