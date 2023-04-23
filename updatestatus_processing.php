<?php
session_start();
date_default_timezone_set('Africa/Cairo');

$servername = "localhost";
$username="root";
$password="";
$dbname="car_rental";
echo "<head>
<link rel='stylesheet' href='transaction_success.css'>
<link href='https://fonts.googleapis.com/css?family=Poppins:100,300,400,500,600,700,800,900&display=swap' rel='stylesheet'>
</head>


";

date_default_timezone_set('Africa/Cairo');

# get the form data
$plate_id=$_POST["plate_id"];
$status=$_POST["status"];
$status_date=$_POST["status_date"];
echo 
$error=false;
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$result_plate_id=mysqli_query($conn,"SELECT * FROM car WHERE plate_id = '$plate_id'");
if(mysqli_num_rows($result_plate_id) == 0  ) {
     $_SESSION["plate_id"]="Plate ID does not exist!";
     header("Location: http://localhost/CarSystem/updatestatus.php");
     $error=true;
}

if($error==false){

$SQL_Query_car_status="INSERT INTO `status`(`plate_id`, `status_date`, `car_status`)
VALUES('$plate_id','$status_date','$status')";

if ($conn->query($SQL_Query_car_status)==TRUE) {
  echo "<body>
  <h1>Car $plate_id Status Updated successfully to $status</h1>
  <h2>you will be redirected to the update status page in 5 seconds or click the button below if you are not redirected</h2>
  <form action='http://localhost/CarSystem/updatestatus.php'>
  <input type='submit' value='Update another car status' id='submit'>
  </form>
  </body>
    ";
  header("refresh:5;url=http://localhost/CarSystem/updatestatus.php");
  
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}}
?>