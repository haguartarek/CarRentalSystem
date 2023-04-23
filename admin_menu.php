<?php
    
    date_default_timezone_set('Africa/Cairo');


session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental";


// $conn->close();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dropdown.css">
    
    <title>Document</title>
    <link rel="stylesheet" href="style5.css">
      <style>
  body {
    background-image: url('car60.jpg');
    background-repeat: no-repeat;
    background-size: 100% 100%;
  }
  html,
  body{
     width: 100%;
     height: 100%;
     overflow: hidden;
     margin: 0;
     zoom: 0.88;
  }
  </style>
</head>
<body>
<h2 id="carrentals">CAR RENTALS</h2>
<h4 id="subphrase">Online Car Rental Service</h4>

    <form action="Menu.php" method="post">
        <input type="submit" id="signoutbtn" value="Sign out">
    </form>
</div>    
<div id="buttons-div">

<form id="buttons-form" style="display: flex; flex-direction: column; align-items: center;">
 

<button
          type="button" id = "updatebtn" onclick="window.location.href='updatestatus.php'">
          <div class="box-1">
  <div class="btn btn-one">
    <span>Update Car Status</span>
  </div>
</div>
</button>
<button
     type="button" id="regcarbtn" onclick="window.location.href='registercar.php'">
     <div class="box-2">
  <div class="btn btn-two">
  <span>Register a New Car</span>
  </div>
</div>
    </button>

    <button
     type="button" id="regcarbtn" onclick="window.location.href='reservation_advanced_search.php'">
     <div class="box-1">
  <div class="btn btn-one">
  <span>Advanced Search</span>
  </div>
</div>
    </button>
    <button
     type="button" id="regcarbtn" onclick="window.location.href='addoffice.php'">
     <div class="box-1">
  <div class="btn btn-one">
  <span>Add Office</span>
  </div>
</div>
    </button>
    <button
     type="button" id="regcarbtn" onclick="window.location.href='showoffices.php'">
     <div class="box-1">
  <div class="btn btn-one">
  <span>Display Offices</span>
  </div>
</div>
    </button>
    <button
     type="button" id="regcarbtn" onclick="window.location.href='cancelreservation.php'">
     <div class="box-1">
  <div class="btn btn-one">
  <span>Cancel Reservations</span>
  </div>
</div>
    </button>

    <div class="dropdown">
  <button class="dropbtn" id= "dropdownn">
  <div class="box-3">
  <div class="btn btn-three">
    <span>Reports</span>
  </div>
</div>
  <div class="dropdown-content">
    <a href="report_reservation_car_cust.php">Reservation Search By Date for Customer and Car information</a>
    <a href="report_reservation_car.php">Reservation Search By Date for car information</a>
    <a href="report_status.php">Status Search By Date </a>
    <a href="report_customer_reserve.php">Customer Search</a>
    <a href="report_payments.php">Payment Search</a>
  </div>
</div>
</button>
</form>
</div>
</body>
</html>