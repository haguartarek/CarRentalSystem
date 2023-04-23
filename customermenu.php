<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental";
date_default_timezone_set('Africa/Cairo');

?>
<html>

<head>
    <link rel="stylesheet" href="style4.css">
    <style>
        body {
            background-image: url('car52.jpg');
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }

        html,
        body {
            width: 100%;
            height: 100%;
            overflow: hidden;
            margin: 0;
        }
    </style>


    <script>
        function validateForm() {
            var start_date = document.forms["searchform"]["fstart"].value;
            var end_date = document.forms["searchform"]["fend"].value;
            var year= document.forms["searchform"]["fyear"].value;
            var price= document.forms["searchform"]["fprice"].value;
            var speed= document.forms["searchform"]["fspeed"].value;
            $error = false;
            if (start_date == "") {
                document.getElementById("start_date_error").innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Start date is required";
                $error = true;
            } else {
                // check if start date is today or later
                var today = new Date();
                today.setHours(0, 0, 0, 0);
                var start_date_date = new Date(start_date);
                start_date_date.setHours(0, 0, 0, 0);
                if (start_date_date < today) {
                    document.getElementById("start_date_error").innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Start date must be today or later";

                    $error = true;
                } else {
                    document.getElementById("start_date_error").innerHTML = "";
                }

            }
            if (end_date == "") {
                document.getElementById("end_date_error").innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;End date is required";
                $error = true;
            } else {
                // check if end date is after start date
                var end_date_date = new Date(end_date);
                end_date_date.setHours(0, 0, 0, 0);
                if (end_date_date < start_date_date) {
                    document.getElementById("end_date_error").innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;End date must be after start date";
                    $error = true;
                } else {
                    document.getElementById("end_date_error").innerHTML = "";
                }
            }
            // check if year is a number
            if (isNaN(year)&&year!="") {
                document.getElementById("year_error").innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Year must be a number";
                $error = true;
            } else {
                document.getElementById("year_error").innerHTML = "";
            }
            // check if price is a number
            if (isNaN(price)&&price!="") {
                document.getElementById("price_error").innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Price must be a number";
                $error = true;
            } else {
                document.getElementById("price_error").innerHTML = "";
            }
            // check if speed is a number
            if (isNaN(speed)&&speed!="") {
                document.getElementById("speed_error").innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Speed must be a number";
                $error = true;
            } else {
                document.getElementById("speed_error").innerHTML = "";
            }
            return !$error;
        }
    </script>


</head>

<body>

    <h2 id="custmenuheader">Book your car now...</h2>


    <form name="searchform" action="customermenuphp.php" id="searchform" onsubmit="return validateForm()" method="post">


        <label id='fromlabel'>From</label> <input type="date" placeholder="start date" id='fstart' class="searchform" name="fstart">
        <span id="start_date_error" class="error"></span><br> <br>
        <label id='untillabel'> Until </label> <input type="date" placeholder="end date" id='fend' class="searchform" name="fend">
        <span id="end_date_error" class="error"></span><br> <br>
        <h3 id="ssearch">Your car specifications:</h3>
        Brand <input type="text" placeholder="brand" id='fbrand' class="searchform" name="fbrand"><br> <br>
        Model <input type="text" placeholder="model" id='fmodel' class="searchform" name="fmodel"><br> <br>
        Car Color <input type="text" placeholder="color" style="text-transform: lowercase" id='fcolor' class="searchform" name="fcolor"><br> <br>
        Year <input type="text" placeholder="year" id='fyear' class="searchform" name="fyear">
        <span id="year_error" class="error"></span><br> <br>
        Office <input type="text" placeholder="office" id='foffice' class="searchform" name="foffice"><br> <br>
        Price <input type="text" placeholder="price" id='fprice' class="searchform" name="fprice">
        <span id="price_error" class="error"></span><br> <br>
        Speed <input type="text" placeholder="speed" id='fspeed' class="searchform" name="fspeed">
        <span id="speed_error" class="error"></span><br> <br>
        <input type="submit" value="Search" id='log'><br> <br>
    </form>


    <form name="paymentform" action="payment.php" id="paymentform" method="post">
        <h4 id="question">You want to do a payment? </h4>
        <input type="submit" class="payment" formaction="payment.php" id='paymentt' value="Click here!">
    </form>


</body>

</html>