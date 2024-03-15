<?php 

    include('../../src/config.php');


    if(isset($_POST['del_user'])){
        $id = $_POST['iduser'];

        $query = mysqli_query($con, "DELETE FROM user WHERE id_user = $id");
    
        if ($query) {
            echo "<script>alert('User deletion has been successfull');
            window.location='ad_user.php';</script>";
        }
    }

?>