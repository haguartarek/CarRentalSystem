<?php
echo "<link rel='stylesheet' type='text/css' href='table1.css'>";
date_default_timezone_set('Africa/Cairo');

// get data from form
$customer_ssn=$_POST["r5ssn"];
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
    $_SESSION["try40y"]="SSN is not found!";
    header("Location: http://localhost/CarSystem/report_customer_reserve.php");
} else {

$sql="SELECT r.customer_ssn,r.reserve_date,r.reservation_id,r.pickup_date,r.return_date,cu.name,cu.country,cu.phone,c.model,c.plate_id
      FROM  reservation as r
      LEFT JOIN customer as cu
      on r.customer_ssn=cu.customer_ssn
      LEFT JOIN car as c
      on r.plate_id=c.plate_id
      WHERE r.customer_ssn='$customer_ssn'";
}

$getcustomername="SELECT name FROM customer WHERE customer_ssn='$customer_ssn'";
$result = $conn->query($getcustomername);
$customer_name=$result->fetch_assoc();
$customer_name=$customer_name['name'];


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
<th>Reservation ID</th>
<th>Reserve Date</th>
<th>Pickup Date</th>
<th>Return Date</th>
</tr>
</thead>
<tbody>";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
    echo "<tr>
    <td>". $row['customer_ssn']."</td>
    <td>". $row['name']."</td>
    <td>".$row['country']. "</td>
    <td>".$row['phone']."</td>
    <td>".$row['model']."</td>
    <td>". $row['plate_id']."</td>
    <td>".$row['reservation_id']."</td>
    <td>". $row['reserve_date']."</td>
    <td>".$row['pickup_date']."</td>
    <td>". $row['return_date']."</td>
    </tr>";
}
echo "</tbody>
</table>
</div>
</div>
</body>";
$conn->close();

?>