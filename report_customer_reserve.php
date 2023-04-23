<?php
 session_start();
 date_default_timezone_set('Africa/Cairo');

?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="style10.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

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
  body{
     width: 100%;
     height: 100%;
     overflow: hidden;
     margin: 0;
  }
  </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        function validateForm(){
            var error=false;
            var x = document.getElementById("r5ssn").value;
            if (x.length == 0 )
            {
                document.getElementById("ssn_error").innerHTML = "SSN must be filled out";
                error=true;
            }
            else {
                document.getElementById("ssn_error").innerHTML = "";
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

<h2 id="customer_header">Customer Report</h2>
<form name="customer_search_form" action="report_customer_reserve_processing.php" onsubmit="return validateForm()" id="searchform" method="post">
    <label for="ssn">Customer SSN:</label>
    <input type="text" name="r5ssn" id="r5ssn">
    <span id="ssn_error" class="error"></span><br><br>
    <button type="submit" value="Generate Report">
     <div class="box-1">
  <div class="btn btn-one">
  <span>Generate Report</span>
  </div>
</div>
    </button>
    
</form><span>
<?php
if(isset($_SESSION['try40y'])){
  // printf("<p style='color:red;'>%s</p>", $_SESSION['try40y']);
  echo "<p style='color:red;'>Customer does not exist</p>";
  unset( $_SESSION['try40y'] );
}
?></span>
</body>
</html>