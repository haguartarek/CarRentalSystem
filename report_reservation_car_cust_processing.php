<html>

<head>
  <link rel="stylesheet" href="table1.css">

</head>

<body>
  <?php
  session_start();
  date_default_timezone_set('Africa/Cairo');



  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "car_rental";

  $start_date = $_POST["r1start_date"];
  $start_date = date("Y-m-d", strtotime($start_date));
  $end_date = $_POST["r1end_date"];
  $end_date = date("Y-m-d", strtotime($end_date));

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $error = false;
  $query = "SELECT r.reservation_id, r.reserve_date , r.pickup_date, r.return_date , r.plate_id, c.model, c.color, c.year, c.brand, c.speed, o.office_name,o.office_country,o.office_id, c.daily_price, cu.customer_ssn ,cu.name, cu.phone, cu.country,o.office_id, o.office_name, o.office_country
        FROM reservation as r
        LEFT JOIN car as c
        ON r.plate_id = c.plate_id
        LEFT JOIN customer as cu
        ON r.customer_ssn = cu.customer_ssn
        LEFT JOIN office as o
        ON c.office = o.office_id
        WHERE date(r.reserve_date) BETWEEN '$start_date' AND '$end_date' 
         order by r.reserve_date";

// $query = "SELECT r.reservation_id, r.reserve_date , r.pickup_date, r.return_date , r.plate_id, c.model, c.color, c.year, c.brand, c.speed, o.office_name,o.office_country,o.office_id, c.daily_price, cu.customer_ssn ,cu.name, cu.phone, cu.country,o.office_id, o.office_name, o.office_country
//         FROM reservation as r
//         LEFT JOIN car as c
//         ON r.plate_id = c.plate_id
//         LEFT JOIN customer as cu
//         ON r.customer_ssn = cu.customer_ssn
//         LEFT JOIN office as o
//         ON c.office = o.office_id
//         WHERE( r.pickup_date BETWEEN '$start_date' AND '$end_date') 
//         OR ( r.return_date BETWEEN '$start_date' AND '$end_date') 
//         order by r.pickup_date";


  $result = $conn->query($query);
  echo "<body class='large-screen'>
<div class='wrap'>
<h2 id='payment_header' style='text-align:center'>Reservations between $start_date and $end_date</h1>
      <div class='table-wrapper'>
        <table class='table-responsive card-list-table'>
        <thead>
<tr>
    <th>Reservation ID</th>
    <th>Reserve Date</th>
    <th>Pickup Date</th>
    <th>Return Date</th>
    <th>Plate ID</th>
    <th>Model</th>
    <th>Color</th>
    <th>Year</th>
    <th>Brand</th>
    <th>Speed</th>
    <th>Daily price</th>
    <th>Customer SSN</th>
    <th>Name</th>
    <th>Phone</th>
    <th>Country</th>
    <th>Office ID</th>
    <th>Office City</th>
    <th>Office Country</th>
    </tr>
    </thead>
    <tbody>";

  while ($row = $result->fetch_assoc()) {
    $reservation_id = $row["reservation_id"];
    $reserve_date = $row["reserve_date"];
    $pickup_date = $row["pickup_date"];
    $return_date = $row["return_date"];
    $plate_id = $row["plate_id"];
    $model = $row["model"];
    $color = $row["color"];
    $year = $row["year"];
    $brand = $row["brand"];
    $speed = $row["speed"];
    $daily_price = $row["daily_price"];
    $customer_ssn = $row["customer_ssn"];
    $name = $row["name"];
    $phone = $row["phone"];
    $country = $row["country"];
    $office_id = $row["office_id"];
    $office_name = $row["office_name"];
    $office_country = $row["office_country"];

    echo "<tr>
    <td>$reservation_id</td>
    <td>$reserve_date</td>
    <td>$pickup_date</td>
    <td>$return_date</td>
    <td>$plate_id</td>
    <td>$model</td>
    <td>$color</td>
    <td>$year</td>
    <td>$brand</td>
    <td>$speed</td>
    <td>$daily_price</td>
    <td>$customer_ssn</td>
    <td>$name</td>
    <td>$phone</td>
    <td>$country</td>
    <td>$office_id</td>
    <td>$office_name</td>
    <td>$office_country</td>
    </tr>";
  }
  echo "</tbody>
  </table>
  </div>
  </div>
  </body>";
  $conn->close();

  ?>