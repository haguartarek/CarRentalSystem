<?php
echo "<link rel='stylesheet' type='text/css' href='table1.css'>";
date_default_timezone_set('Africa/Cairo');

// get data from form
$customer_ssn=$_POST["cust_ssn"];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental";

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
$resultofssn = mysqli_query($conn,"SELECT * FROM customer WHERE customer_ssn = '$customer_ssn'");
if(mysqli_num_rows($resultofssn) == 0) {
    $_SESSION["ssnnotfound"] = "Customer with SSN ".$customer_ssn." does not exist";
    header("refresh:0.5;url=cancelreservation.php");
}
else{
$sql="SELECT r.customer_ssn,r.reserve_date,r.reservation_id,r.pickup_date,r.return_date,cu.name,cu.country,cu.phone,c.model,c.plate_id,p.amount
      FROM  reservation as r
      LEFT JOIN customer as cu
      on r.customer_ssn=cu.customer_ssn
      LEFT JOIN car as c
      on r.plate_id=c.plate_id
      LEFT JOIN payment as p
        on r.customer_ssn=p.customer_ssn AND r.plate_id=p.plate_id AND r.reserve_date=p.reserve_date
      WHERE r.customer_ssn='$customer_ssn' AND p.amount IS NULL";

$getcustomername="SELECT name FROM customer WHERE customer_ssn='$customer_ssn'";
$result = $conn->query($getcustomername);
$customer_name=$result->fetch_assoc();
$customer_name=$customer_name['name'];
//start table
echo '<link rel="stylesheet" href="car_stats.css" type="text/css" media="screen"  />';

echo "<body class='large-screen'>";
echo "<div class='wrap'>
<h1 style='text-align:center'>Reservations for $customer_name</h1>
      <div class='table-wrapper'>
        <table class='table-responsive card-list-table'>
        <thead>
<tr>
<th>Customer SSN</th>
<th>Customer Name</th>
<th>Customer Country</th>
<th>Customer Phone</th>
<th>Car Model</th>
<th>Car Plate ID</th>
<th>Reserve Date</th>
<th>Pickup Date</th>
<th>Return Date</th>
<th>Cancel Reservation</th>
</tr>
</thead>
<tbody>";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['customer_ssn'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['country'] . "</td>";
    echo "<td>" .$row['phone']."</td>";
    echo "<td>" . $row['model'] . "</td>";
    echo "<td>" . $row['plate_id'] . "</td>";
    echo "<td>" . $row['reserve_date'] . "</td>";
    echo "<td>" . $row['pickup_date'] . "</td>";
    echo "<td>" . $row['return_date'] . "</td>";
    echo "<td>
    <form action='cancelreservation_processing_cancel.php' method='post'>
    <input type='hidden' name='reservation_id' id='reservation_id'value='".$row['reservation_id']."'>
    <input type='submit' name='cancel' value='Cancel'>
    </form>
    </td>
    </tr>";

    
    




}}