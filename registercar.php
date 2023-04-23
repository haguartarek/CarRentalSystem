
<?php
date_default_timezone_set('Africa/Cairo');
  session_start();

  if(isset($_SESSION["plate_id"])){
    echo "<p style='color:red;'>Car already exists</p>";
    unset($_SESSION["plate_id"]);
  }
  if(isset($_SESSION["office_id"])){
    echo "<p style='color:red;'>Office ID does not exist</p>";
    unset($_SESSION["office_id"]);
  }

 ?>

<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="register_car.css">
      <style>
  body {
    background-image: url('car60.jpg');
    background-repeat: no-repeat;
    background-size: 100% 100%;
    zoom : 95%;
  }
  html,
  body{
     width: 100%;
     height: 100%;
     overflow: hidden;
     margin: 0;
  }
  </style>

<script>

function validateForm2() {
var error=false;
var x = document.getElementById("modelid").value;
var y = document.getElementById("colorid").value;
var z = document.getElementById("yearid").value;
var a = document.getElementById("daily_priceid").value;
var b = document.getElementById("plate_id_id").value;
var c = document.getElementById("office_id_id").value;
var d = document.getElementById("speedid").value;
var e= document.getElementById("statusid").value;
var f= document.getElementById("brandid").value;
if (x.length == 0 )
{
    document.getElementById("model-error").innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Model must be filled out";
    error=true;
}
else {
    document.getElementById("model-error").innerHTML = "";
}

if (y == "" )
{
    document.getElementById("color_error").innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Color must be filled out";
    error=true;
}
else {
    document.getElementById("color_error").innerHTML = "";
}
if (z == "" )
{
    document.getElementById("year_error").innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Year must be filled out";

    error=true;}
else {
    if (isNaN(z)) {
        document.getElementById("year_error").innerHTML
    document.getElementById("year_error").innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Year must be a number";
        error=true;
    }
    else {
        document.getElementById("year_error").innerHTML = "";
    }
}
if (a == "" )
{
    document.getElementById("daily_price_error").innerHTML = "&nbsp;&nbsp;&nbsp;Daily Price must be filled out";
    error=true;
}
else {
    if (isNaN(a)) {
        document.getElementById("daily_price_error").innerHTML = "&nbsp;&nbsp;&nbsp;Daily Price must be a number";
        error=true;
    }
    else {
        document.getElementById("daily_price_error").innerHTML = "";
    }
}
if (b == "" )
{
    document.getElementById("plate_id_error").innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Plate ID must be filled out";
    error=true;
}
else {
    document.getElementById("plate_id_error").innerHTML = "";
}
if (c == "" )
{
    document.getElementById("office_id_error").innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Office ID must be filled out";
    error=true;
}
else {
    document.getElementById("office_id_error").innerHTML = "";
}
if (d == "" )
{
    document.getElementById("speed_error").innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Speed must be filled out";
    error=true;
}
else {
    if (isNaN(d)) {
        document.getElementById("speed_error").innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Speed must be a number";
        error=true;
    }
    else {
        document.getElementById("speed_error").innerHTML = "";
    }
}
if(e == "" )
{
    document.getElementById("status_error").innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status must be filled out";
    error=true;
}
else {
    document.getElementById("status_error").innerHTML = "";
}
if(f == "" )
{
    document.getElementById("brand_error").innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Brand must be filled out";
    error=true;
}
else {
    document.getElementById("brand_error").innerHTML = "";
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
<h2 id ="carregheader">Car Registration</h2>

<form name="registercar" action="registercar_processing.php" id="carRegisterForm" onsubmit="return validateForm2()" method="post" >

<label  for="brand">Brand:</label>
<input id="brandid" type="text" name="brand"  >
<span id="brand_error" class="error"></span><br><br>
<label  for="model">Model:</label>
<input id="modelid" type="text" name="model"  >
<span id="model-error" class="error"></span><br><br>
<label  for="year">Year:</label>
<input id="yearid" type="text" name="year"  >
<span id="year_error" class="error"></span><br><br>
<label  for="plate_id">Plate ID:</label>
<input id="plate_id_id" type="text" name="plate_id"  >
<span id="plate_id_error" class="error"></span><br><br>
<label  for="color">Color:</label>
<input id="colorid" type="text" name="color"  >
<span id="color_error" class="error"></span><br><br>
<label  for="daily_price">Daily Price:</label>
<input id="daily_priceid" type="text" name="daily_price"  >
<span id="daily_price_error" class="error"></span><br><br>
<label  for="office_id">Office ID:</label>
<input  id="office_id_id" type="text" name="office_id"  >
<span id="office_id_error" class="error"></span><br><br>
<label  for="speed">Speed:</label>
<input id="speedid" type="text" name="speed"  >
<span id="speed_error" class="error"></span><br><br>
<label for="status">Status:</label>
<select id="statusid" name="status">
<option value="active">Active</option>
<option value="out of service">Out of Service</option>
<option value="maintenance">Maintenance</option>
</select>
<span id="status_error" class="error"></span><br><br>
<button
type="submit"  value="Register Car">
          <div class="box-1">
  <div class="btn btn-one">
    <span>Register Car</span>
  </div>
</div>
</button>
</form>
</body>
</html>
