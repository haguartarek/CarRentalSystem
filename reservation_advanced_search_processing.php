<?php

session_start();
date_default_timezone_set('Africa/Cairo');

echo "<link rel='stylesheet' type='text/css' href='table1.css'>";

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "car_rental";

//get form data
$plate_id = $_POST['plate_id'];
$brand = $_POST['brand'];
$model = $_POST['model'];
$year = $_POST['year'];
$color = $_POST['color'];
$speed = $_POST['speed'];
$daily_price = $_POST['daily_price'];
$office = $_POST['office_name'];
$reserve_date = $_POST['reserve_date'];
$customer_ssn = $_POST['customer_ssn'];
$customer_name = $_POST['customer_name'];
$customer_username = $_POST['customer_username'];
$country = $_POST['country'];
$phone = $_POST['phone'];

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$where = array();
if ($plate_id) {
    $where[] =  "c.plate_id='$plate_id'";
}
if ($brand) {
    $where[] =  "UPPER(c.brand) LIKE UPPER('%$brand%')";
}
if ($model) {
    $where[] =  "UPPER(c.model) LIKE UPPER('%$model%')";
}
if ($year) {
    $where[] =  "UPPER(c.year) LIKE UPPER('$year')";
}
if ($color) {
    $where[] =  "UPPER(c.color) LIKE UPPER('%$color%')";
}
if ($speed) {
    $where[] =  "c.speed >='$speed'";
}
if ($daily_price) {
    $where[] =  "c.daily_price <='$daily_price'";
}
if ($office) {
    $where[] =  "UPPER(o.office_name) LIKE UPPER('%$office%')";
}
if ($reserve_date) {
    $where[] =  "DATE(r.reserve_date) ='$reserve_date'";
}
if ($customer_ssn) {
    $where[] =  "cu.customer_ssn='$customer_ssn'";
}
if ($customer_name) {
    $where[] =  "UPPER(cu.name) LIKE UPPER('%$customer_name%')";
}
if ($customer_username) {
    $where[] =  "UPPER(cu.username) LIKE UPPER('$customer_username')";
}
if ($country) {
    $where[] =  "UPPER(cu.country) LIKE UPPER('%$country%')";
}
if ($phone) {
    $where[] =  "cu.phone='$phone'";
}

$where = implode(' and ', $where);
$sql = "SELECT c.plate_id, c.brand, c.model,c.year, c.color,c.daily_price,c.speed, o.office_name, r.reserve_date, cu.customer_ssn, cu.name, cu.username, cu.country, cu.phone
          FROM reservation as r
          LEFT JOIN car as c 
          ON r.plate_id = c.plate_id
          LEFT JOIN office as o
          ON c.office = o.office_id
          LEFT JOIN customer as cu
          ON r.customer_ssn = cu.customer_ssn
          WHERE $where";
// echo $sql;
$result = $conn->query($sql);

echo "<body class='large-screen'>
<div class='wrap'>
<h1 style='text-align:center'>Advanced Search</h1>
      <div class='table-wrapper'>
        <table class='table-responsive card-list-table'>
        <thead>
        <tr>
            <th>Plate ID</th>
            <th>Brand</th>
            <th>Model</th>
            <th>Year</th>
            <th>Color</th>
            <th>Speed</th>
            <th>Daily Price</th>
            <th>Office</th>
            <th>Reserve Date</th>
            <th>Customer SSN</th>
            <th>Customer Name</th>
            <th>Customer Username</th>
            <th>Country</th>
            <th>Phone</th>
        </tr>
        </thead>";
while($row=$result->fetch_assoc())
{
    $plate_id = $row['plate_id'];
    $brand = $row['brand'];
    $model = $row['model'];
    $year = $row['year'];
    $color = $row['color'];
    $speed = $row['speed'];
    $daily_price = $row['daily_price'];
    $office = $row['office_name'];
    $reserve_date = $row['reserve_date'];
    $customer_ssn = $row['customer_ssn'];
    $customer_name = $row['name'];
    $customer_username = $row['username'];
    $country = $row['country'];
    $phone = $row['phone'];
    echo "<tbody>
    <tr>
            <td>$plate_id</td>
            <td>$brand</td>
            <td>$model</td>
            <td>$year</td>
            <td>$color</td>
            <td>$speed</td>
            <td>$daily_price</td>
            <td>$office</td>
            <td>$reserve_date</td>
            <td>$customer_ssn</td>
            <td>$customer_name</td>
            <td>$customer_username</td>
            <td>$country</td>
            <td>$phone</td>
        </tr>
        </tbody>
        ";
}
echo "  </table>
      </div>
    </div>
</body>";
$conn->close();
