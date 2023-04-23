<?php
date_default_timezone_set('Africa/Cairo');

?>
<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="style9.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

      <style>
        .navbar{
          min-width: 100%;
          transform: translate(0, -20px);
        }
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
     color: black;
  }
  </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Status</title>
    <script>
        function validateForm2() {
            var error = false;
            var x = document.getElementById("r4date").value;
            if (x.length == 0) {
                document.getElementById("date_error").innerHTML = "Date Must be filled out";
                error = true;
            } else {
                document.getElementById("date_error").innerHTML = "";
            }
            return !error;
        }
    </script>
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

<h2 id ="updateheader">Status Report</h2>
    <form name="searchform" action="report_status_processing.php" onsubmit="return validateForm2()" id="searchform" method="post">
        <label for="date">Date:</label>
        <input type="date" name="r4date" id="r4date">
        <span id="date_error" class="error"></span><br><br>
        <button
        type="submit" value="Generate Report">
          <div class="box-1">
  <div class="btn btn-one">
    <span>Generate Report</span>
  </div>
</div>
</button>
         
    
</body>

</html>