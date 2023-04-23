<?php
date_default_timezone_set('Africa/Cairo');


?>
<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="style12.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .navbar{
            min-width: 100%;
        }
  body {
    background-image: url('car52.jpg');
    background-repeat: no-repeat;
    background-size: 100% 100%;
    color: black;
    zoom:0.95;
  }
  html,
  body{
     width: 100%;
     height: 100%;
     overflow: hidden;
     margin: 0;
  }
  .error{
        color: red;
  }
  </style>

   <script>
        function validateForm() {
            var plate_id = document.getElementById("plate_id").value;
            var brand = document.getElementById("brand").value;
            var model = document.getElementById("model").value;
            var year = document.getElementById("year").value;
            var color = document.getElementById("color").value;
            var speed = document.getElementById("speed").value;
            var daily_price = document.getElementById("daily_price").value;
            var office = document.getElementById("office").value;
            var reserve_date = document.getElementById("reserve_date").value;
            var customer_ssn = document.getElementById("customer_ssn").value;
            var customer_name = document.getElementById("customer_name").value;
            var customer_username = document.getElementById("customer_username").value;
            var country = document.getElementById("country").value;
            var phone = document.getElementById("phone").value;
            var error=false;
            if (plate_id == "" && brand == "" && model == "" && year == "" && color == "" && speed == ""
             && daily_price == "" && office == "" && reserve_date == "" && customer_ssn == "" && customer_name == ""
              && customer_username == "" && country == "" && phone == "") {
                document.getElementById("empty_error").innerHTML = "Please fill at least one of the fields";
                document.getElementById("empty_error1").innerHTML = "Please fill at least one of the fields";
                error=true;
            }else{
                document.getElementById("empty_error").innerHTML = "";
                document.getElementById("empty_error1").innerHTML = "";
            }
            // year number validation
            if (isNaN(year)&&year!="") {
                document.getElementById("year_error").innerHTML = "Year must be a number";
                
                error=true;
            } else {
                document.getElementById("year_error").innerHTML = "";
            }
            // speed number validation
            if (isNaN(speed)&&speed!="") {
                document.getElementById("speed_error").innerHTML = "Speed must be a number";
                error=true;
            } else {
                document.getElementById("speed_error").innerHTML = "";
            }
            // daily price number validation
            if (isNaN(daily_price)&&daily_price!="") {
                document.getElementById("daily_price_error").innerHTML = "Daily Price must be a number";
                error=true;
            } else {
                document.getElementById("daily_price_error").innerHTML = "";
            }
            // phone number validation
            if (isNaN(phone)&&phone!="") {
                document.getElementById("phone_error").innerHTML = "Phone must be a number";
                error=true;
            } else {
                document.getElementById("phone_error").innerHTML = "";
            }
            return !error;

        }
    </script>
    <title>Advanced Search</title>
</head>

<body>
<nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="Menu.php">Car Rental</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="admin_menu.php">Home</a></li>
                <li><a href="registercar.php">Register Car</a></li>
                <li><a href="updatestatus.php">Update Car Status</a></li>
                <li><a href="showoffices.php">Display Offices</a></li>
                <li><a href="addoffice.php">Add Office</a></li>
                <li><a href="cancelreservation.php">Cancel Reservations</a></li>
            </ul>
        </div>
    </nav>
<h2 id="car_cust_search">Car & Customer Search</h2>
    <!-- System should be able to make advanced search which is searching by any of the car
information, customer information or reservation day and get all information about
the car, customer and reservation -->
    <form action="reservation_advanced_search_processing.php" onsubmit="return validateForm()" method="post">
        <div id="car_info" class="car-info">
        <h2>Car</h2>
        <label for="reserve_date">Reserve Date</label>
            <input type="date" name="reserve_date" id="reserve_date"><br><br>
            <label for="plate_id">Plate ID</label>
            <input type="text" name="plate_id" id="plate_id"><br><br>
            <label for="brand">Brand</label>
            <input type="text" name="brand" id="brand"><br><br>
            <label for="model">Model</label>
            <input type="text" name="model" id="model"><br><br>
            <label for="year">Year</label>
            <input type="text" name="year" id="year"><br>
            <label id="year_error" class="error"></label><br>
            <label for="color">Color</label>
            <input type="text" name="color" id="color"><br><br>
            <label for="speed">Speed</label>
            <input type="text" name="speed" id="speed"><br>
            <label id="speed_error" class="error"></label><br>
            <label for="daily_price">Daily Price</label>
            <input type="text" name="daily_price" id="daily_price"><br>
            <label id="daily_price_error" class="error"></label><br>
            <label for="office">Office Name</label>
            <input type="text" name="office_name" id="office"><br><br>
            <label class="error" id="empty_error1"></label><br>

        </div>
        <div id="customer_info" class="customer-info">
        <h2>Customer</h2>   
        <label for="customer_ssn">SSN</label>
            <input type="text" name="customer_ssn" id="customer_ssn"><br><br>
            <label for="customer_name">Name</label>
            <input type="text" name="customer_name" id="customer_name"><br><br>
            <label for="customer_username">Username</label>
            <input type="text" name="customer_username" id="customer_username"><br><br>
            <label for="country">Country</label>
            <input type="text" name="country" id="country"><br><br>
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone"><br>
            <label id="phone_error" class="error"></label><br>
            <label class="error" id="empty_error"></label><br>
         <button   type="submit" id="rebtn" value="Search">
          <div class="box-1">
  <div class="btn btn-one">
    <span>Generate</span>
  </div>
        </div>
        <!-- <span class="error" id="empty_error" style="color:red"></span><br>
        <input id='submitt' type="submit" value="Search"> -->
    </form>

</body>

</html>