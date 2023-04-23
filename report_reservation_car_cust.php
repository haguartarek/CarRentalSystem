<!-- All reservations within a specified period including all car and customer
information. -->

<?php
session_start();
date_default_timezone_set('Africa/Cairo');


?>
<html>

<head>
  <link rel="stylesheet" href="style6.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  <style>
    .navbar {
      min-width: 100%;
    }
    body {
      background-image: url('car74.jpg');
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

    .error {
      color: red;
    }
  </style>
  <script>
    function validateForm2() {
      var start_date = document.forms["report_reservation"]["r1start_date"].value;
      var end_date = document.forms["report_reservation"]["r1end_date"].value;
      var error = false;
      if (start_date.length == 0) {
        document.getElementById("start_date_error").innerHTML = "Start Date is required";
        error = true;
      } else {
        document.getElementById("start_date_error").innerHTML = "";
      }

      if (end_date.length == 0) {
        document.getElementById("end_date_error").innerHTML = "End Date is required";
        error = true;
      } else {

        if (start_date > end_date) {
          document.getElementById("end_date_error").innerHTML = "End Date must be after or equal Start Date ";
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
  <h2 id="resheader">Car & Customer Reservation Report</h2>
  <form name="report_reservation" action="report_reservation_car_cust_processing.php" onsubmit="return validateForm2()" id="report_reservation" method="post">
    <label id="frommlabel" for="start_date">From:</label>
    <input type="date" name="r1start_date" id="r1start_date"><br>
    <label id="start_date_error" class="error"></label><br>
    <label id="untilllabel" for="end_date">Until:</label>
    <input type="date" name="r1end_date" id="r1end_date"><br>
    <label id="end_date_error" class="error"></label><br>
    <button type="submit" id="rebtn" value="Generate Report">
      <div class="box-1">
        <div class="btn btn-one">
          <span>Generate Report</span>
        </div>
      </div>
    </button>

    </button>

  </form>
</body>

</html>