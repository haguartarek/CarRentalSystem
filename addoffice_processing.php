<?php
session_start();
date_default_timezone_set('Africa/Cairo');

$servername = "localhost";
$username="root";
$password="";
$dbname="car_rental";
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
$office_name = $_POST["office_name"];
$office_country = $_POST["office_country"];
$office=$_POST["officeID"];

// check if the office already exists
$sql = "SELECT * FROM office WHERE office_id='$office'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
$_SESSION["officeIDduplicate"] = "Office ID ".$office." already exists";
header("Location: addoffice.php");
}
else {
$sql="INSERT INTO office (office_id,office_name,office_country) VALUES ('$office','$office_name','$office_country')";

if ($conn->query($sql) === TRUE) {
echo "
<body>
<h1>Office $office registered successfully</h1>
<h2>you will be redirected to the add office page in 5 seconds or click the button below if you are not redirected</h2>
<form action='addoffice.php'>
<input type='submit' value='Add another office' id='submit'>
</form>
</body>
";
header("refresh:5;url=addoffice.php");
}
}

# get the form data

?>