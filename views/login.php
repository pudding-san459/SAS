<?php
  include "../src/header.php";
  session_start();
?>
<title>Login</title>
  <div class="card" style="border: 0px;">
    <div class="card_body" style="margin-top: 15vh;">
      <center>
        <img src="../img/Sas logo.png" class="rounded" style="height: auto; width: 200px; margin-bottom: 40px;">
        <div class="login-card">
            <form method="POST">
                <h3 style="color: white;">User Login</h3>
                <input type="text" placeholder="Username" name="username" required>
                <input type="password" placeholder="Password" name="password" required>
                <div class="button-container">
                    <button class="btn btn-primary" style="width: 80px;" name="login">Login</button>
                    <a class="btn btn-outline-primary" href="register.php" >Register</a>
                </div>
            </form>
        </div>
      </center>
    </div>
  </div>
  <a href="ad_login.php"><img src="../img/user.png" class="float-end" style="width: 50px; margin-right: 20px; margin-top: 5%;"></a>
  
<?php
  if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $query = mysqli_query($con,"SELECT * FROM user WHERE username = '$user'");
    if (!$query) {
      die("Qeury failed: " . mysqli_error($con));
    } 

    if (mysqli_num_rows($query) == 0) {
      $error = "Username or password is invalid";
      echo "<script> alert('".$error."'); </script>";
    } else{
      $data = mysqli_fetch_assoc($query);

      if ( $data['status'] == "pending"){

        $error = "Your account havent been approved. Please contact 013-818 8105 to confirm your account approval";
        echo "<script> alert('".$error."'); </script>";
      } else if( $data['status'] == "approved"){
          if( $user == $data['username'] && $pass == $data['password']){
            $_SESSION['company_name'] = $data['company_name'];
            $_SESSION['user_email'] = $data['user_email'];
            $_SESSION['company_tel'] = $data['company_tel'];
            $_SESSION['username'] = $data['username'];

            echo "<script> alert('Login Successful!'); </script>";
            echo "<script> window.location='user/user_main.php'; </script>";
            exit();
          } else {
            $error = "Username or password is invalid";
            echo "<script> alert('".$error."'); </script>";
          }
      }
    }
  }
?>