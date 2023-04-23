<?php
  
  session_start();
  date_default_timezone_set('Africa/Cairo');

  echo "<link rel='stylesheet' type='text/css' href='table1.css'>";
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "car_rental";
  
  # get the form data
  $specific_date=$_POST["r4date"];

 $specific_date=date("Y-m-d", strtotime($specific_date));

$sql="SELECT c.brand,c.model,c.color,s1.plate_id, s1.status_date, s1.car_status 
FROM (SELECT plate_id, status_date, car_status 
      FROM status
      WHERE date(status_date) <= '$specific_date'
      ) as s1 
LEFT JOIN (SELECT plate_id, status_date, car_status 
           FROM status
           WHERE date(status_date) <= '$specific_date'
           ) as s2 
ON s1.plate_id = s2.plate_id 
AND s1.status_date < s2.status_date
LEFT JOIN car as c on c.plate_id=s1.plate_id
WHERE s2.status_date IS NULL
ORDER BY s1.status_date DESC";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

echo "<body class='large-screen'>";
echo "<div class='wrap'>
<h1 style='text-align:center ;font-family: RlFreight, HoeflerText-Black, Times New Roman, serif;'>
STATUS REPORT FOR $specific_date</h1>
      <div class='table-wrapper'>
        <table class='table-responsive card-list-table'>
<thead>
<tr>
<th>Brand</th>
<th>Model</th>
<th>Color</th>
<th>Plate ID</th>
<th>Status Date</th>
<th>Car Status</th>
</tr>
</thead>";

$result = $conn->query($sql);
echo "<tbody>";
while($row=$result->fetch_assoc())
{
    $brand=$row["brand"];
    $model=$row["model"];
    $color=$row["color"];
    $plate_id=$row["plate_id"];
    $status_date=$row["status_date"];
    $car_status=$row["car_status"];
    echo "<tr>";
    echo "<td>$brand</td>";
    echo "<td>$model</td>";
    echo "<td>$color</td>";
    echo "<td>$plate_id</td>";
    echo "<td>$status_date</td>";
    echo "<td>$car_status</td>";
    echo "</tr>";
}    echo "</tbody>";


echo "</table>
</div>";
echo "</div>";

echo "</body>";
$conn->close();
