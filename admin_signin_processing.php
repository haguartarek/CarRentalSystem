

<?php
session_start();
date_default_timezone_set('Africa/Cairo');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental";

$name=$_POST["adminname"];
$password=$_POST["adminpassword"];

if ($name=="admin" && $password=="123456"){
  header("Location: http://localhost/CarSystem/admin_menu.php");
}

elseif ($name != "admin") {


  $_SESSION["try5"]="Admin not found!";

  header("Location: http://localhost/CarSystem/Menu.php");
}
else {
  $_SESSION["try6"]="Incorrect Password!";

  header("Location: http://localhost/CarSystem/Menu.php");

}
?>
