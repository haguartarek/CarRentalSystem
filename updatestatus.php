
<?php

session_start();

date_default_timezone_set('Africa/Cairo');

?>

<html>
<head>
<link rel="stylesheet" href="style7.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <style>
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
<link rel="stylesheet" href="register_car.css">

<script>

function validateForm2() {
  var plate_id=document.forms["updatestatus"]["plate_id"].value;
  var status=document.forms["updatestatus"]["status"].value;
  var error=false;
  if (plate_id==null || plate_id=="") {
    document.getElementById("plate_id_error").innerHTML="Plate ID is required";
    error=true;
  }else{
    document.getElementById("plate_id_error").innerHTML="";
  }

  if (status==null || status=="") {
    document.getElementById("status_error").innerHTML="Status is required";
    error=true;
  }else{
    document.getElementById("status_error").innerHTML="";
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

<h2 id ="updateheader">Update Car Status</h2>

<form name="updatestatus" action="updatestatus_processing.php" id="StatusUpdateForm" onsubmit="return validateForm2()" method="post" >

<label for="plate_id">Plate ID:</label>
<input type="text" name="plate_id" id="plate_id" >
<span id="plate_id_error" class="error"></span><br><br>
<label for="status">Status:</label>
<select name="status" id="status">
<option value="active">Active</option>
<option value="out of service">Out Of Service</option>
<!-- <option value="rented">Rented</option> -->
<option value="maintenance">Maintenance</option>
</select>
<span id="status_error" class="error"></span><br><br>
<input type="hidden" name="status_date" id="status_date" value="<?php echo date("Y-m-d H:i:s"); ?>">
<button
 type="submit" value="Update Status">
          <div class="box-1">
  <div class="btn btn-one">
    <span>Update Status</span>
  </div>
</div>
</button>

</form>
</body>
</html>
