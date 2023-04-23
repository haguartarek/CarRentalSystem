<html>

<head>
  <link rel="stylesheet" type="text/css" href="table1.css">
  <style>
    /* @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
    *{
      margin: 0;
      padding: 2px;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
       font-size: 30px;

    }
    html,body{
        display: grid;
  height: 100%;
  width: 100%;
  place-items: center;
    }
    tr:hover {background-color: #D6EEEE;} */
  </style>
</head>

<body>

  <?php

date_default_timezone_set('Africa/Cairo');


  session_start();


  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "car_rental";

  # get the form data
  $color = $_POST["r2car_color"];
  $speed = $_POST["r2car_speed"];
  $model = $_POST["r2car_model"];
  $year = $_POST["r2car_year"];
  $office = $_POST["r2car_office"];
  $brand = $_POST["r2car_brand"];
  $price = $_POST["r2car_price"];
  $start_date = $_POST["r2start_date"];
  $end_date = $_POST["r2end_date"];





  $where = array();
  if ($color) {
    $where[] =  "UPPER(c.color) LIKE UPPER('$color')";
  }
  if ($speed) {
    $where[] =  "c.speed>='$speed'";
  }
  if ($model) {
    $where[] =  "UPPER(c.model) LIKE UPPER('%$model%')";
  }
  if ($brand) {
    $where[] =  "UPPER(c.brand) LIKE UPPER('%$brand%')";
  }
  if ($price) {
    $where[] =  "c.daily_price<='$price'";
  }

  if ($year) {
    $where[] =  "c.year='$year'";
  }
  if ($office) {
    $where[] =  "UPPER(o.office_name) LIKE UPPER('%$office%')";
  }

  $where = implode(" AND ", $where);
  //query by reserve date
  if (empty($where)) {
    $sql = "SELECT DISTINCT r.customer_ssn,r.pickup_date,r.return_date,r.reserve_date,c.plate_id ,c.model,c.brand,c.year,c.color,c.speed,o.office_name,o.office_country
          FROM reservation as r
          LEFT JOIN car as c
          on r.plate_id=c.plate_id
          LEFT JOIN office as o
          on c.office=o.office_id
          WHERE date(r.reserve_date) BETWEEN '$start_date' and '$end_date' 
          order by r.reserve_date";
  } else {
    $sql = "SELECT DISTINCT  r.customer_ssn,r.pickup_date,r.return_date,r.reserve_date,c.plate_id ,c.model,c.brand,c.year,c.color,c.speed,o.office_name,o.office_country
          FROM reservation as r
          LEFT JOIN car as c
          on r.plate_id=c.plate_id
          LEFT JOIN office as o
          on c.office=o.office_id
          WHERE date(r.reserve_date) BETWEEN '$start_date' and '$end_date'
          AND $where order by r.reserve_date";
  }


  //query by pickup ad return date
  // if (empty($where)) {
  //   $sql = "SELECT DISTINCT r.customer_ssn,r.pickup_date,r.return_date,r.reserve_date,c.plate_id ,c.model,c.brand,c.year,c.color,c.speed,o.office_name,o.office_country
  //         FROM reservation as r
  //         LEFT JOIN car as c
  //         on r.plate_id=c.plate_id
  //         LEFT JOIN office as o
  //         on c.office=o.office_id
  //         WHERE (r.pickup_date BETWEEN '$start_date' and '$end_date') 
  //         OR (r.return_date BETWEEN '$start_date' and '$end_date') 
  //         order by r.pickup_date";
  // } else {
  //   $sql = "SELECT DISTINCT  r.customer_ssn,r.pickup_date,r.return_date,r.reserve_date,c.plate_id ,c.model,c.brand,c.year,c.color,c.speed,o.office_name,o.office_country
  //         FROM reservation as r
  //         LEFT JOIN car as c
  //         on r.plate_id=c.plate_id
  //         LEFT JOIN office as o
  //         on c.office=o.office_id
  //         WHERE ((r.pickup_date BETWEEN '$start_date' and '$end_date')
  //          OR (r.return_date BETWEEN '$start_date' and '$end_date'))
  //         AND $where 
  //         order by r.pickup_date";
  // }

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  echo "<body class='large-screen'>";
  echo "<div class='wrap'>
    <h1 style='text-align:center'>Car Reservation Between '$start_date' and '$end_date'</h1>
      <div class='table-wrapper'>
        <table class='table-responsive card-list-table'>
        <thead>
          <tr>
          <th>Customer SSN</th>
          <th>Reservation Date</th>
          <th>Pickup Date</th>
          <th>Return Date</th>
          <th>Plate ID</th>
          <th>Brand</th>
          <th>Model</th>
          <th>Year</th>
          <th>Color</th>
          <th>Speed</th>
          <th>Office Name</th>
          <th>Office Country</th>
          </tr>
        </thead>
        <tbody>";

  $result = $conn->query($sql);

  while ($row = $result->fetch_assoc()) {
    $plate_id = $row["plate_id"];
    $brand = $row["brand"];
    $model = $row["model"];
    $year = $row["year"];
    $color = $row["color"];
    $speed = $row["speed"];
    $office_name = $row["office_name"];
    $office_country = $row["office_country"];
    $reserve_date=$row["reserve_date"];
    $customer_ssn=$row["customer_ssn"];
    $pickup_date=$row["pickup_date"];
    $return_date=$row["return_date"];

    echo "<tr>
    <td>$customer_ssn</td>
    <td>$reserve_date</td>
    <td>$pickup_date</td>
    <td>$return_date</td>
    <td>$plate_id</td>
    <td>$brand</td>
    <td>$model</td>
    <td>$year</td>
    <td>$color</td>
    <td>$speed</td>
    <td>$office_name</td>
    <td>$office_country</td>
    </tr>";
  }

  echo "</tbody>
</table>
</div>
</div>
</body>
</html>";
  $conn->close();

  ?>