<?php 

    include('../../../src/config.php');
    session_start();


    if(isset($_POST['del_user'])){
        $id = $_POST['iduser'];

        $query = mysqli_query($con, "DELETE FROM user WHERE id_user = $id");
    
        if ($query) {
            echo "<script>alert('User deletion has been successfull');
            window.location='../sad_user.php';</script>";
        }
    }
    
    if(isset($_POST['del_admin'])){
        $id = $_POST['idadmin'];

        $query = mysqli_query($con, "DELETE FROM admin WHERE id_admin = $id");
    
        if ($query) {
            echo "<script>alert('Admin deletion has been successfull');
            window.location='../sad_admin.php';</script>";
        }
    }
    
?>