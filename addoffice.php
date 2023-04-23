<?php
session_start();

date_default_timezone_set('Africa/Cairo');

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style13.css">
    <!-- <link rel="stylesheet" href="register_car.css"> -->
    <style>
        .navbar{
            min-width: 100%;
        }

    </style>
    <script>
        function validateForm(){
            var officeID=document.forms["addofficeForm"]["officeID"].value;
            var office_name=document.forms["addofficeForm"]["officename"].value;
            var office_country=document.forms["addofficeForm"]["officecountry"].value;
            var error=false;
            if (officeID=="") {
                document.getElementById("officeID_error").innerHTML="Office ID is required";
                error=true;
            }else{
                if(isNaN(officeID)){
                    document.getElementById("officeID_error").innerHTML="Office ID must be a number";
                    error=true;
                }
                else{
                    document.getElementById("officeID_error").innerHTML="";
                }
            }
            if (office_name=="") {
                document.getElementById("office_name_error").innerHTML="Office Name is required";
                error=true;
            }else{
                document.getElementById("office_name_error").innerHTML="";
            }
            if (office_country=="") {
                document.getElementById("office_country_error").innerHTML="Office Country is required";
                error=true;
            }else{
                document.getElementById("office_country_error").innerHTML="";
            }
            return !error;
        }

    </script>
    <title>Add Office</title>
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
    <h2 id="addofficeheader">Add A New Office</h2>
    <form action="addoffice_processing.php" onsubmit="return validateForm()" method="post" id="addofficeForm" name="addofficeForm">
        <label for="Office ID">Office</label><br>
        <input type="text" name="officeID" id="officeID"><br>
        <label id="officeID_error" class="error"></label><br>
        <label for="Office Name">Office Name</label><br>
        <input type="text" name="office_name" id="officename"><br>
        <label id="office_name_error" class="error"></label><br>
        <label for="Office country">Office Country</label><br>
        <input type="text" name="office_country" id="officecountry"><br>
        <label id="office_country_error" class="error"></label><br>
        <?php
        if(isset($_SESSION['officeIDduplicate'])){
            echo "<p style='color:red;'>".$_SESSION['officeIDduplicate']."</p>";
            unset($_SESSION['officeIDduplicate']);
        }
        ?>
        <button type="submit" value="Update Status">
            <div class="box-1">
                <div class="btn btn-one">
                    <span>Add Office</span>
                </div>
            </div>
        </button>


    </form>
    </div>
</body>

</html>