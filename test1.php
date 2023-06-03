<?php

// Make a MySQL Connection
$conn = mysqli_connect("localhost", "root", "", "test");


$checkBox = implode(',', $_POST['Days']);

if (isset($_POST['submit'])) {
    $query = "INSERT INTO testTb VALUES ('" . $checkBox . "')";

    mysqli_query($conn, $query);


    echo "Complete";

}

?>

