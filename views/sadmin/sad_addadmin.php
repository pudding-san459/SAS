<?php
    include('sad_header.php');
?>
<link rel="stylesheet" href="../../src/css/profile.css">
<header>
  <img src="../../img/Sas logo3.png" alt="" width="100px">
  <nav>
    <ul>
      <li><a href="sad_main.php" class="nav-link">Main</a></li>
      <li><a href="sad_user.php" class="nav-link">User</a></li>
      <li class="active"><a href="sad_admin.php" class="nav-link">Admin</a></li>
    </ul>
  </nav>
  <button type="submit" class="logout">
    <p>LogOut</p>
  </button>
</header>

<h3 class="title">ADMIN MENU</h3>
<hr style="width: 80%; margin-left: auto; margin-right: auto;">
<br>

<div class="main">
        <div class="card">
            <div class="card-body">
                <form method="POST">
                <table>
                    <tr>
                        <td>Name</td>
                        <td>:</td>
                        <td><input type="text" name="name" placeholder="Admin Name..."></td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td>:</td>
                        <td><input type="text" name="username" placeholder="Username..."></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td>:</td>
                        <td><input type="text" name="password" placeholder="Password..."></td>
                    </tr>
                    <tr>
                        <td>Confirm Password</td>
                        <td>:</td>
                        <td><input type="text" name="con_password" placeholder="Confirm password..."></td>
                    </tr>
                </table>
                <center>
                    <button class="btn btn-warning" name="add">Add</button>
                    <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-secondary">Back</a>

                </center>
                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['add'])):
            $name = $_POST['name'];
            $user = $_POST['username'];
            $pass = $_POST['password'];
            $conpass = $_POST['con_password'];
            $privilage = 1;


            if ($pass == $conpass) {
                $insert = mysqli_query($con, "INSERT INTO admin(admin_name, username, password, privilage) VALUES ('$name','$user','$pass', '$privilage') ");

                if (!$insert) {
                    die("Query failed: " . mysqli_error($con));
                } else {
                    echo "<script> alert('The admin profile has been created.'); 
                    window.location='sad_admin.php'; </script>";
                    exit; // Stop further execution
                }
            } else{
                echo "<script> alert('The password is not a match'); 
                    window.location='sad_addadmin.php'; </script>";
                    exit; // Stop further execution
            }
            
        endif;

        ?>