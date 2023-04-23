<?php
session_start();
date_default_timezone_set('Africa/Cairo');

$servername = "localhost";
$username="root";
$password="";
$dbname="car_rental";
$reservation_id = $_POST["reservation_id"];
echo "
<head>
<link rel='stylesheet' href='transaction_success.css'>
</head>";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
// check if the reservation already exists
$sql = "DELETE FROM reservation WHERE reservation_id='$reservation_id'";

if ($conn->query($sql) === TRUE) {
echo "
<body>
<h1>Reservation $reservation_id cancelled successfully</h1>
<h2>you will be redirected to the cancel reservation page in 5 seconds or click the button below if you are not redirected</h2>
<form action='cancelreservation.php'>
<input type='submit' value='Cancel another reservation' id='submit'>
</form>
</body>
";
header("refresh:5;url=cancelreservation.php");

}
else {
$_SESSION["reservationIDduplicate"] = "Reservation ID ".$reservation_id." does not exist";
echo "
<body>
<h1>Reservation $reservation_id does not exist</h1>
<h2>you will be redirected to the cancel reservation page in 5 seconds or click the button below if you are not redirected</h2>
<form action='cancelreservation.php'>
<input type='submit' value='Cancel another reservation' id='submit'>
</form>
</body>
";
header("refresh:5;url=cancelreservation.php");
}
?>