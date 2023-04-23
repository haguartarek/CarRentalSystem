<?php
date_default_timezone_set('Africa/Cairo');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style8.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <style>
        .navbar {
            min-width: 100%;
            font-size:15px;
        }
        body {
            background-image: url('car74.jpg');
            background-repeat: no-repeat;
            background-size: 100% 100%;
            color:black;
            zoom: 88%;
        }

        html,
        body {
            width: 100%;
            height: 100%;
            overflow: hidden;
            margin: 0;
        }
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script>
        function validateForm() {
            var start_date = document.forms["searchform"]["r2start_date"].value;
            var end_date = document.forms["searchform"]["r2end_date"].value;
            var year = document.forms["searchform"]["r2car_year"].value;
            var price = document.forms["searchform"]["r2car_price"].value;
            var speed = document.forms["searchform"]["r2car_speed"].value;
            $error = false;
            if (start_date == "") {
                document.getElementById("start_date_error").innerHTML = " &nbsp;&nbsp;&nbsp; Start date is required";
                $error = true;
            } else {
                document.getElementById("start_date_error").innerHTML = "";
            }
            if (end_date == "") {
                document.getElementById("end_date_error").innerHTML = " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; End date is required";
                $error = true;

            } else {
                if (start_date > end_date) {
                    document.getElementById("end_date_error").innerHTML = " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; End date must be after or equal Start date";
                    $error = true;
                } else {
                    document.getElementById("end_date_error").innerHTML = "";
                }
            }
            // if year is not a number
            if (isNaN(year) && year != "") {
                document.getElementById("car_year_error").innerHTML = " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Year must be a number";
                $error = true;
            } else {
                document.getElementById("car_year_error").innerHTML = "";
            }
            
            // if speed is not a number
            if (isNaN(speed) && speed != "") {
                document.getElementById("car_speed_error").innerHTML = " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Speed must be a number";
                $error = true;
            } else {
                
                document.getElementById("car_speed_error").innerHTML = "";
            }
            // if price is not a number
            if (isNaN(price) && price!="") {
                document.getElementById("car_price_error").innerHTML = " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Price must be a number";
                $error = true;
            } else {
                document.getElementById("car_price_error").innerHTML = "";
            }


            return !$error;
        }
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
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

    <h2 id="resheader">Car Reservation Report</h2>
    <form name="searchform" action="report_reservation_car_processing.php" id="searchform" onsubmit="return validateForm()" method="post">

        <label for="start_date">Start Date:</label>
        <input type="date" name="r2start_date" id="r2start_date"><br>
        <label id="start_date_error" class="error"></label><br>
        <label for="end_date">End Date:</label>
        <input type="date" name="r2end_date" id="r2end_date"><br>
        <label id="end_date_error" class="error"></label><br>
        <label for="brand">Car Brand:</label>
        <input type="text" name="r2car_brand" id="r2car_brand"><br><br>
        <label for="car_model">Car Model:</label>
        <input type="text" name="r2car_model" id="r2car_model"><br><br>
        <label for="car_color">Car Color:</label>
        <input type="text" name="r2car_color" id="r2car_color"><br><br>
        <label for="car_year">Car Year:</label>
        <input type="text" name="r2car_year" id="r2car_year"><br>
        <label id="car_year_error" class="error"></label><br>
        <label for="car_office">Car Office:</label>
        <input type="text" name="r2car_office" id="r2car_office"><br><br>
        <label for="car_speed">Car Speed:</label>
        <input type="text" name="r2car_speed" id="r2car_speed"><br>
        <label id="car_speed_error" class="error"></label><br>
        <label for="car_price">Car Price:</label>
        <input type="text" name="r2car_price" id="r2car_price"><br>
        <label id="car_price_error" class="error"></label><br>
        <button type="submit" id="rebtn" value="Generate Report">
            <div class="box-1">
                <div class="btn btn-one">
                    <span>Generate Report</span>
                </div>
            </div>
        </button>


    </form>



</body>

</html>