
<?php

session_start();
date_default_timezone_set('Africa/Cairo');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental";

$username1=$_POST["ffemail"];
$password1=md5($_POST["fpassword"]);



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$resultofemail = mysqli_query($conn,"SELECT * FROM customer WHERE username = '$username1'");
$sql="SELECT username FROM customer WHERE username = '$username1' ";
$result = $conn->query($sql);
$resultofpassword=mysqli_query($conn,"SELECT * FROM customer WHERE password = '$password1'");
if(empty($username1) || empty($password1))
{
  header("Location: http://localhost/CarSystem/Menu.php");
}
elseif(mysqli_num_rows($resultofemail) == 0 && mysqli_num_rows($resultofpassword) == 0 ) {
  echo "not found";

  $_SESSION["try1"]="Email and password are not found!";

  header("Location: http://localhost/CarSystem/Menu.php");

} elseif (mysqli_num_rows($resultofemail) != 0 && mysqli_num_rows($resultofpassword) != 0 ){
  $_SESSION["username"] = $username1;
  $_SESSION["password"] = $password1;
  while($row = $result->fetch_assoc()) {
    header("Location: http://localhost/CarSystem/customermenu.php");
  }

}
elseif(mysqli_num_rows($resultofemail) != 0 && mysqli_num_rows($resultofpassword) == 0) {
  	echo " password is incorrect";
    echo $password1;
    #$_SESSION["try2"]=" password is incorrect";

    #header("Location: http://localhost/CarSystem/Menu.php ");
}
else {
  echo " email is incorrect";
  $_SESSION["try3"]=" email is  incorrect";
  header("Location: http://localhost/CarSystem/Menu.php ");
}


$conn->close();
?>
