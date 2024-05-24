<?php
header("Content-Type: application/json");
include('db.php');

$order_id = $_GET['order_id'];
$result = mysqli_query($con, "SELECT * FROM `transactions2` WHERE order_id=$order_id");
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

unset($row['id']);
echo json_encode($row);
mysqli_close($con);
?>