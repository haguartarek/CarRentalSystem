<?php
session_start();
date_default_timezone_set('Africa/Cairo');

echo "<link rel='stylesheet' type='text/css' href='table1.css'>";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental";

$start_date=$_POST["r6start_date"];
$start_date = date("Y-m-d", strtotime($start_date));

$end_date=$_POST["r6end_date"];
$end_date = date("Y-m-d", strtotime($end_date));

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$error=false;
//query payments per customer
// $query="SELECT cu.customer_ssn,cu.name,c.model,c.plate_id,p.amount,p.payment_date
//         FROM payment as p
//         LEFT JOIN car as c
//         ON p.plate_id = c.plate_id
//         LEFT JOIN customer as cu
//         ON p.customer_ssn = cu.customer_ssn
//         WHERE date(p.payment_date) BETWEEN '$start_date' AND '$end_date' ";
       
      $query=" SELECT SUM(p.amount) as total,date(p.payment_date) as paydate ,o.office_name
       FROM payment as p 
       LEFT JOIN car as c
       ON p.plate_id=c.plate_id
       LEFT JOIN office as o 
       ON o.office_id=c.office 
       WHERE date(p.payment_date)BETWEEN '$start_date' AND '$end_date'
       GROUP BY date(p.payment_date),o.office_name";

$result = $conn->query($query);

//table for payments per customer
// echo "<body class='large-screen'>
// <div class='wrap'>
// <h2 id='payment_header' style='text-align:center'>Report for Daily payments between $start_date and $end_date</h1>
//       <div class='table-wrapper'>
//         <table class='table-responsive card-list-table'>
//         <thead>
//         <tr>
//         <th>Customer SSN</th>
//         <th>Name</th>
//         <th>Model</th>
//         <th>Plate ID</th>
//         <th>Amount</th>
//         <th>Payment Date</th>
//         </tr>
//     </thead>
//     <tbody>";

echo "<body class='large-screen'>
<div class='wrap'>
<h2 id='payment_header' style='text-align:center'>Report for Daily payments between $start_date and $end_date</h1>
      <div class='table-wrapper'>
        <table class='table-responsive card-list-table'>
        <thead>
        <tr>
        <th>Office</th>
        <th>Date</th>
        <th>Total Payments</th>
        </tr>
    </thead>
    <tbody>";
    
    // table 
while($row = $result->fetch_assoc()) {
    // echo "<tr>
    // <td>" . $row['customer_ssn'] . "</td>
    // <td>" . $row['name'] . "</td>
    // <td>" . $row['model'] . "</td>
    // <td>" .$row['plate_id'] . "</td>
    // <td>" . $row['amount'] . "</td>
    // <td>" . $row['payment_date'] . "</td>
    // </tr>";

    echo "<tr>
    <td>" . $row['office_name'] . "</td>
    <td>" . $row['paydate'] . "</td>
    <td>" . $row['total'] . "</td>
    </tr>";

}   
echo "</tbody>
</table>
</div>
</div>
</body>";

$conn->close();
?>