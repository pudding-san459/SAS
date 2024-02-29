<?php
  include "../src/header.php";
?>
<title>Admin Login</title>
  <div class="card" style="border: 0px;">
    <div class="card_body" style="margin-top: 15vh;">
      <center>
        <img src="../img/Sas logo.png" class="rounded" style="height: auto; width: 200px; margin-bottom: 40px;">
        <div class="login-card">
            <form method="POST">
                <h3 style="color: white;">Admin Login</h3>
                <input type="text" placeholder="Username" name="username" required>
                <input type="password" placeholder="Password" name="password" required>
                <center>
                  <button class="btn btn-primary" style="width: 80px;" name="login">Login</button> 
                </center>
            </form>
        </div>
      </center>
    </div>
  </div>
  <a href="login.php"><img src="../img/user.png" class="float-end" style="width: 50px; margin-right: 20px; margin-top: 5%;"></a>
  
  <?php
  if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $query = mysqli_query($con,"SELECT * FROM admin WHERE username = '$user'");
    if (!$query) {
      die("Qeury failed: " . mysqli_error($con));
    } 

    if (mysqli_num_rows($query) == 0) {
      $error = "Username or password is invalid";
      echo "<script> alert('".$error."'); </script>";
    } else{
        $data = mysqli_fetch_assoc($query);

        if( $user == $data['username'] && $pass == $data['password']){
          $_SESSION['admin_name'] = $data['admin_name'];
          $privilage = $data['privilage'];

          if ($privilage == 1) {
            echo "<script> alert('Login Successful!'); </script>";
            echo "<script> window.location='admin/ad_main.php'; </script>";
            exit();
          } else if ($privilage == 2) {
            echo "<script> alert('Login Successful!'); </script>";
            echo "<script> window.location='sadmin/sad_main.php'; </script>";
            exit();
          }
        } else {
          $error = "Username or password is invalid";
          echo "<script> alert('".$error."'); </script>";
        }
    }
  }
?>