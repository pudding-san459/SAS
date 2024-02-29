<?php 
    include ("../../../src/config.php");

    if (isset($_POST["reject"])) {
        $id = $_POST['id'];

        $reject = mysqli_query($con, "UPDATE user set status='rejected' WHERE id_user =".$id);

        if (!$reject) {
            die("Query failed: " . mysqli_error($con));
        } else {
            echo "<script> alert('The user has been rejected.'); 
            window.location='../sad_user.php'; </script>";
            exit; // Stop further execution
        }
    }

?>