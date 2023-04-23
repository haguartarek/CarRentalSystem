<?php


session_start();
$servername = "localhost";
$username = 'root';
$password = '';
$dbname = 'car_rental';



// css

// echo '<style>
// body {
//   font-family: "Poppins", sans-serif;
//     }
//     </style>';

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
    echo '<link rel="stylesheet" href="car_stats.css" type="text/css" media="screen"  />';
# add font Roboto
 echo '<link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700" rel="stylesheet">';
 # add font awesome
 echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';

 echo '<link rel="stylesheet" href="table1.css" type="text/css" media="screen"  />';
    

if(!isset($_SESSION["username"]) || !isset($_SESSION["password"])){
    echo "You are not signed in!";
    echo "Redirecting to login page...";
    header("refresh:3;url=Menu.php");
    exit();
}
//get customer ssn
$customer_ssn_query="SELECT customer_ssn FROM customer WHERE username='".$_SESSION["username"]."' and password='".$_SESSION["password"]."'";
$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
$resultofssn=$conn->query($customer_ssn_query);
if ($resultofssn->num_rows > 0) {
  while($row = $resultofssn->fetch_assoc()) {
    $c_ssn=$row["customer_ssn"];
    $_SESSION["c_ssn"]=$c_ssn;

  }
} else {
  echo "0 results";
}

$query="SELECT r.reserve_date, r.pickup_date, r.return_date, r.plate_id, c.model,c.brand,c.year,c.color,c.daily_price
        FROM reservation  as r  
        LEFT JOIN payment as p
        ON r.customer_ssn=p.customer_ssn and r.plate_id=p.plate_id and r.reserve_date=p.reserve_date
        LEFT JOIN car as c
        ON r.plate_id=c.plate_id
        WHERE r.customer_ssn='$c_ssn' and p.amount is null";
$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
$result = $conn->query($query);

echo "<body class='large-screen'>
    <div class='wrap'>
    <h2 id='payment_header' style='text-align:center'>Payments Due </h2>
          <div class='table-wrapper'>
            <table class='table-responsive card-list-table'>
            <thead>
    <tr>
    <th>Brand</th>
    <th>Model</th>
    <th>Plate ID</th>
    <th>Year</th>
    <th>Color</th>
    <th>Amount due</th>
    <th>Pay</th>
    </tr>
    </thead>
    <tbody>
    ";
while($row = $result->fetch_assoc()){

    $pickup_date = $row["pickup_date"];
    $return_date = $row["return_date"];
    $date1 = new DateTime($pickup_date);
    $date2 = new DateTime($return_date);
    // calculate the price
    $diff = $date2->diff($date1)->format("%a");
    $price = ($diff+1) * $row["daily_price"];
    echo "<tr>
    <td>".$row["brand"]."</td>
    <td>".$row["model"]."</td>
    <td>".$row["plate_id"]."</td>
    <td>".$row["year"]."</td>
    <td>".$row["color"]."</td>
    <td>$".$price."</td>
    <td>
    <form action='pay_processing.php' method='post'>
    <input type='hidden' name='reserve_date' value='".$row["reserve_date"]."'>
    <input type='hidden' name='amount' value='".$price."'>
    <input type='hidden' name='plate_id' value='".$row["plate_id"]."'>
    <input type='hidden' name='customer_ssn' value='".$c_ssn."'>
    <input type='hidden' name='payment_date' value='".date("Y-m-d H:i:s")."'>
    <input type='hidden' name='model' value='".$row["model"]."'>
    <input type='submit' value='Pay'>
    </form>
    </td>
    </tr>";

    
    
    // echo "<div class='car__container'>
    // <style>
    // font-family: 'Poppins', sans-serif;
    // </style>
    // <div class='car'>
    // <div class='car__stats'>
    // <p class='car__stats__model'>".$row["brand"]."</p>
    // <p>Model: ".$row["model"]."</p>
    // <p>Plate ID: ".$row["plate_id"]."</p>
    // <p><i class='fa fa-calendar' aria-hidden='true'></i>   ".$row["year"]."</p>
    // <p>Color: ".$row["color"]."</p>
    // <p>Amount due: ".$price."</p>
    // <div class='car__button'>
    
    // <form action='pay_processing.php' method='post'>
    // <input type='hidden' name='reserve_date' value='".$row["reserve_date"]."'>
    // <input type='hidden' name='amount' value='".$price."'>
    // <input type='hidden' name='plate_id' value='".$row["plate_id"]."'>
    // <input type='hidden' name='customer_ssn' value='".$c_ssn."'>
    // <input type='hidden' name='payment_date' value='".date("Y-m-d H:i:s")."'>
    // <input type='hidden' name='model' value='".$row["model"]."'>
    // <input type='submit' value='Pay'>
    // </form>
    // </div>
    // </div>
    // </div>
    // </div>";
}

$conn->close();

?>