
<?php

session_start();
date_default_timezone_set('Africa/Cairo');
# add css 
// foreach(glob("*.css") as $css_file)
//      {
//         echo '<link rel="stylesheet" href="'.$css_file.'" type="text/css" media="screen"  />';
//      }
echo '<link rel="stylesheet" href="car_stats.css" type="text/css" media="screen"  />';
# add font Roboto
echo '<link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700" rel="stylesheet">';
# add font awesome
echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental";


$color = $_POST["fcolor"];
$startdate = $_POST["fstart"];
# reformate the date
$startdate = date("Y-m-d", strtotime($startdate));
$enddate = $_POST["fend"];
# reformate the date from mm/dd/yyyy to yyyy-mm-dd
$enddate = date("Y-m-d", strtotime($enddate));
$model = $_POST["fmodel"];
$year = $_POST["fyear"];
$office = $_POST["foffice"];
$speed = $_POST["fspeed"];
$brand = $_POST["fbrand"];
$price = $_POST["fprice"];

# check if the user is signed in
if (!isset($_SESSION["username"]) || !isset($_SESSION["password"])) {
    echo "You are not signed in!";
    echo "Redirecting to login page...";
    header("refresh:3;url=Menu.php");
    exit();
}
# get the form data
$customer_username = $_SESSION["username"];
$customer_password = $_SESSION["password"];

echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">';
//navbar
echo '<nav class="navbar navbar-inverse">
<div class="container-fluid">
<div class="navbar-header">
<a class="navbar-brand" href="customermenu.php">CAR RENTAL</a>
</div>
<ul class="nav navbar-nav navbar-right">
<li><a href="customermenu.php"><span class="glyphicon glyphicon-search"></span> Search</a></li>
<li><a href="payment.php"><span class="glyphicon glyphicon-credit-card"></span> Payment</a></li>
<li><a href="Menu.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
</ul>
</div>
</nav>';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

# get customer ssn
$sql = "SELECT customer_ssn FROM customer WHERE username = '$customer_username' and password = '$customer_password'";
$resultofssn = $conn->query($sql);
if ($resultofssn->num_rows > 0) {
    while ($row = $resultofssn->fetch_assoc()) {
        $ssn = $row["customer_ssn"];
    }
} else {
    echo "0 results";
}

$_SESSION["c_ssn"] = $ssn;
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
if ($year) {
    $where[] =  "c.year='$year'";
}
if ($year) {
    $where[] =  "c.daily_price <=$price";
}
if ($office) {
    $where[] =  "UPPER(o.office_name) LIKE UPPER('%$office%')";
}

$where = implode(' and ', $where);
# check if where is empty
if (empty($where)) {
    $SQL_QUERY = "SELECT DISTINCT c.plate_id ,c.model,c.brand,c.daily_price,c.year,c.color,c.speed,o.office_name,o.office_country
    FROM car as c 
    LEFT JOIN  reservation as r 
    on r.plate_id=c.plate_id 
    LEFT JOIN office as o
    on c.office=o.office_id
    WHERE c.plate_id not in(
        SELECT plate_id 
        FROM reservation as r
        WHERE ('$startdate' Between date(r.pickup_date) and date(r.return_date)) or ('$enddate' Between date(r.pickup_date) and date(r.return_date)))
    AND c.plate_id in(
        SELECT s1.plate_id
        FROM status s1
        LEFT JOIN status s2
        ON s1.plate_id = s2.plate_id
        AND s1.status_date < s2.status_date
        WHERE s2.status_date IS NULL and s1.car_status='active'
        ORDER BY s1.status_date DESC)";
} else {
    $SQL_QUERY = "SELECT DISTINCT c.plate_id ,c.model,c.brand,c.daily_price,c.year,c.color,c.speed,o.office_name,o.office_country
    FROM car as c 
    LEFT JOIN  reservation as r 
    on r.plate_id=c.plate_id 
    LEFT JOIN office as o
    on c.office=o.office_id
    WHERE $where and c.plate_id not in(
        SELECT plate_id 
        FROM reservation as r
        WHERE ('$startdate' Between date(r.pickup_date) and date(r.return_date)) or ('$enddate' Between date(r.pickup_date) and date(r.return_date)))
    AND c.plate_id in(
        SELECT s1.plate_id
        FROM status s1
        LEFT JOIN status s2
        ON s1.plate_id = s2.plate_id
        AND s1.status_date < s2.status_date
        WHERE s2.status_date IS NULL and s1.car_status='active'
        ORDER BY s1.status_date DESC)";
}
// show cars 3 cards per row using bootstrap
echo "<div class='container'>
<div class='row'>";

$result = $conn->query($SQL_QUERY);
if ($result->num_rows > 0) {
    // output data of each row  
    while ($row = $result->fetch_assoc()) {
        # display 3 cars per row
        echo "<div class='col-md-4'>";
        echo "<div class='card' style='width: 35rem; margin: 10px; border-radius: 10px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); padding: 10px;'>";
        echo "<img src='car.jpg' class='card-img-top' alt='...'>
        <div class='card-body'>
        <h5 class='card-title'>" . $row["brand"] . "</h5>
        <p class='card-text'> <i class='fa fa-solid fa-car'></i>  " . $row["model"] . "</p>
        <p class='card-text'> Plate ID: " . $row["plate_id"] 
        . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <i class='fa fa-calendar' aria-hidden='true'></i>   " . $row["year"] . "</p>
        <p class='card-text'><i class='fa fa-tachometer' aria-hidden='true'></i>   " 
        . $row["speed"] . "km/h
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        <i class='fa fa-paint-brush' aria-hidden='true'></i>   " . $row["color"] . "</p>
        <p class='card-text'><i class='fa fa-building' aria-hidden='true'></i>   " . $row["office_name"] . 
        "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <i class='fa fa-globe' aria-hidden='true'></i>   " . $row["office_country"] . "</p>
        <p class='card-text'><i class='fa fa-money' aria-hidden='true'></i>   " . $row["daily_price"] . "</p>
        <div class='car__button'>
        <form action='selectcar.php' method='post' id='selectcar' class=>
        <input type='hidden' name='plate_id' value='" . $row["plate_id"] . "'>
        <input type='hidden' name='pickup_date' value='" . $startdate . "'>
        <input type='hidden' name='return_date' value='" . $enddate . "'>
        <input type='hidden' name='reserve_date' value='" . date("Y-m-d H:i:s") . "'>
        <input type='submit' value='Select'>
        </form>
        </div>
        </div>
        </div>
        </div>";
    }
} else {
    echo "0 results";
}
// echo "<div class='car__container'>
//     <style>
//     'font-family: 'Poppins', sans-serif;'
//     </style>";
// while($row = $result->fetch_assoc()) {
//     echo "<div class='car'>
//     <img src='car.jpg' alt='car' class='car__image'>
//     <div class='car__stats'>
//     <p class='car__stats__model'>".$row["brand"]."</p>
//     <p>Model: ".$row["model"]."</p>
//     <p>Plate ID: ".$row["plate_id"]."</p>
//     <p><i class='fa fa-calendar' aria-hidden='true'></i>   ".$row["year"]."</p>
//     <p>Color: ".$row["color"]."</p>
//     <p>Speed: ".$row["speed"]."km/h</p>
//     <p>Office: ".$row["office_name"]."</p>
//     <p>Country: ".$row["office_country"]."</p>
//     <p>Price: ".$row["daily_price"]."</p>";

//     echo "</div>
//     </div>
//     </div>";
// }


$conn->close();
?>
