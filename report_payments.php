<?php
session_start();
date_default_timezone_set('Africa/Cairo');

?>
<html>

<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="style11.css">

  <style>
    .navbar {
      min-width: 100%;
      transform: translate(0, -20px);
    }
    body {
      background-image: url('car60.jpg');
      background-repeat: no-repeat;
      background-size: 100% 100%;
      color:black;
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
      let x = document.forms["report_reservation"]["r6start_date"].value;
      let y = document.forms["report_reservation"]["r6end_date"].value;
      var error = false;
      if (x == "") {
        document.getElementById("start_date_error").innerHTML = "Start date must be filled out";
        error = true;
      } else {
        document.getElementById("start_date_error").innerHTML = "";
      }
      if (y == "") {
        document.getElementById("end_date_error").innerHTML = "End date must be filled out";
        error = true;

      } else {
        //compare dates
        if (x > y) {
          document.getElementById("end_date_error").innerHTML = "End date must be greater than start date";
          error = true;
        } else {
          document.getElementById("end_date_error").innerHTML = "";
        }

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

  <h2>Payments Report</h2>
  <form name="report_reservation" action="report_payments_processing.php" id="report_reservation" onsubmit="return validateForm()" method="post">
    <label for="start_date">Start Date:</label>
    <input type="date" name="r6start_date" id="r6start_date"><br>
    <label id="start_date_error" class="error"></label><br>
    <label for="end_date">End Date:</label>
    <input type="date" name="r6end_date" id="r6end_date"><br>
    <label id="end_date_error" class="error"></label><br>
    <button type="submit" value="Generate Report">
      <div class="box-1">
        <div class="btn btn-one">
          <span>Generate Report</span>
        </div>
      </div>
    </button>
  </form>
</body>

</html>