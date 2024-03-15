<?php 
    include ("../../../src/config.php");

    if (isset($_POST["approve"])) {
        $id = $_POST['id'];

        $approve = mysqli_query($con, "UPDATE user set status='approved' WHERE id_user =".$id);

        if (!$approve) {
            die("Query failed: " . mysqli_error($con));
        } else {
            echo "<script> alert('The user has been approved.'); 
            window.location='../ad_user.php'; </script>";
            exit; // Stop further execution
        }
    }

?>