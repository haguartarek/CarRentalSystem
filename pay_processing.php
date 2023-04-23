<?php
session_start();
$servername = "localhost";
$username="root";
$password="";
$dbname="car_rental";
echo "<link rel='stylesheet' href='transaction_success.css'>";
# get the form data
$reserve_date=$_POST["reserve_date"];
$payment_date=$_POST["payment_date"];
$amount=$_POST["amount"];
$customer_ssn=$_SESSION["c_ssn"];
$plate_id=$_POST["plate_id"];
$model=$_POST["model"];

$sql="INSERT INTO `payment`(`customer_ssn`, `amount`, `payment_date`, `reserve_date`, `plate_id`) 
VALUES ('$customer_ssn','$amount','$payment_date','$reserve_date','$plate_id')";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if ($conn->query($sql) === TRUE){
    echo "<h1>You paid $amount for $model $plate_id on $payment_date!</h1>
    <h2>You will be redirected to Payment page in 5 seconds or click the button below if you are not redirected</h2>
     <form action='http://localhost/CarSystem/payment.php'>
     <input type='submit' value='Payment' id='submit'>
     </form>
     </body>
    ";
    header("Refresh: 5; url=http://localhost/CarSystem/payment.php");

}
?>