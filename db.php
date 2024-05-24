<?php
define("databaseserveraddr", "fdb1028.awardspace.net");
define("username", "4301310_antoni123");
define("password", "Dosiaczek12");
define("database", "4301310_antoni123");

$con = mysqli_connect(databaseserveraddr, username, password, database);

if (!$con) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

$reset_query = "ALTER TABLE transactions2 AUTO_INCREMENT = 1";
mysqli_query($con, $reset_query);

if (isset($_POST['order_id']) && isset($_POST['amount']) && isset($_POST['paid'])) {
    $order_id = $_POST['order_id'];
    $amount = $_POST['amount'];
    $paid = $_POST['paid'];

    echo "Order id: " . $order_id . "<br>";
    echo "Amount: " . $amount . "<br>";
    echo "Paid?: " . $paid . "<br>";

    // Check if the order ID already exists
    $check_query = "SELECT * FROM transactions2 WHERE order_id = '$order_id'";
    $check_result = mysqli_query($con, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "Order id already exists.";
    } else {
        if ($paid == "yes") {
            $response_code = 1;
            $response_desc = "Paid";
        } else {
            $response_code = 0;
            $response_desc = "Not Paid";
        }

        $sql = "INSERT INTO transactions2 VALUES (NULL, '$order_id', '$amount', '$response_code', '$response_desc')";

        if (mysqli_query($con, $sql)) {
            echo "<br>New transaction added successfully<br>You can check JSON encode here: http://antoni123.atwebpages.com/rest2/api.php?order_id=$order_id";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    }
}
?>