<head>
<link rel="stylesheet" type="text/css" href="table1.css">

</head>
<?php
date_default_timezone_set('Africa/Cairo');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql="SELECT office_id,office_name,office_country FROM office";
$result = $conn->query($sql);
echo "<body class='large-screen'>";
  echo "<div class='wrap'>
    <h1 style='text-align:center'>Our Offices</h1>
      <div class='table-wrapper'>
        <table class='table-responsive card-list-table'>
        <thead>
        <tr>
        <th>Office ID</th>
        <th>Office Name</th>
        <th>Office Country</th>
        </tr>
        </thead>
        <tbody>";
        
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {

    $office_id = $row["office_id"];
    $office_name = $row["office_name"];
    $office_country = $row["office_country"];
    echo "<tr>
    <td>$office_id</td>
    <td>$office_name</td>
    <td>$office_country</td>
    </tr>";

  }
} else {
  echo "0 results";
}
echo "</tbody>
</table>
</div>
</div>
</body>";
$conn->close();

?>