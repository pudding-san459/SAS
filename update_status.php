<?php
// Connect to the database
$con = mysqli_connect("localhost", "root", "", "simplified");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Get current date
$currentDate = date('Y-m-d');

// Query payments with due dates that have passed and amount is not 0
$query = "UPDATE debt SET status = 'PASS DUE' WHERE dueDate < '$currentDate' AND status != 'COMPLETE' AND amount != 0";
$result = mysqli_query($con, $query);

if (!$result) {
    echo "Error updating record: " . mysqli_error($con);
}

mysqli_close($con);
?>