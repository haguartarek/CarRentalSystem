<?php
session_start();
date_default_timezone_set('Africa/Cairo');

if(isset($_SESSION['ssnnotfound'])){
    echo "<p style='color:red;'>".$_SESSION['ssnnotfound']."</p>";
    unset($_SESSION['ssnnotfound']);
}
    
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style14.css">
    <!-- <link rel="stylesheet" href="register_car.css"> -->
    <style>
        .navbar{
            min-width: 100%;
        }

    </style>
    <script>
        function validateForm(){
            var cust_ssn=document.forms["cancelReservations"]["cust_ssn"].value;
            var error=false;
            if (cust_ssn=="") {
                document.getElementById("cust_ssn_error").innerHTML="Customer SSN is required";
                error=true;
            }else{
                document.getElementById("cust_ssn_error").innerHTML="";
            }
            return !error;
        }

    </script>
    <title>Cancel Reservations</title>
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
    <div id=formandheader>
    <h2 id="header">Cancel Reservations</h2>
    <form name="cancelReservations" id="cancelReservations" action="cancelreservation_processing.php" method="post" onsubmit="return validateForm()">
        <div class="form-group">
            <label for="cust_ssn">Customer SSN</label>
            <input type="text" class="form-control" id="cust_ssn" name="cust_ssn" placeholder="Enter Customer SSN">
            <p id="cust_ssn_error" style="color:red;"></p>
        </div>
        <button type="submit" value="Show Reservations">
            <div class="box-1">
                <div class="btn btn-one">
                    <span>Show Reservations</span>
                </div>
            </div>
        </button>


    </form>
    </div>
</body>

</html>