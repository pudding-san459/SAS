<?php
    include('sad_header.php');

    session_start(); // Starting the session

    // Check if the user is not logged in, redirect to the login page
    if (!isset($_SESSION['admin_name'])) {
        header("Location: ../ad_login.php");
        exit(); // Ensure script stops here
    }
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
  <a href="inc/logout.php" class="logout">
    <p>LogOut</p>
  </a>
</header>

<h3 class="title">ADMIN MENU</h3>
<hr style="width: 80%; margin-left: auto; margin-right: auto;">
<br>

<?php
    $query = mysqli_query($con,"SELECT * FROM admin WHERE id_admin=".$_GET['id']);
    while($data = mysqli_fetch_assoc($query)){
?>


<div class="main">
        <div class="card">
            <div class="card-body">
                <form method="POST">
                <table>
                    <tr>
                        <td>Name</td>
                        <td>:</td>
                        <td><input type="text" name="name" placeholder="Admin Name..." value="<?php echo $data['admin_name']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td>:</td>
                        <td><input type="text" name="username" placeholder="Username..." value="<?php echo $data['username']; ?>"></td>
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
                    <button class="btn btn-warning" name="update">Update</button>
                    <a href="sad_admin.php" class="btn btn-secondary">Back</a>

                </center>
                </form>
            </div>
        </div>
    </div>
    <?php
    }
    
    if (isset($_POST['update'])):
            $name = $_POST['name'];
            $user = $_POST['username'];
            $pass = $_POST['password'];
            $conpass = $_POST['con_password'];


            if ($pass == $conpass) {
                $passwordUpdate = !empty($pass) ? ", password='$pass'" : "";
                $insert = mysqli_query($con, "INSERT INTO admin(admin_name, username, password, privilage) VALUES ('$name','$user','$pass', '$privilage') ");

                if (!$insert) {
                    die("Query failed: " . mysqli_error($con));
                } else {
                    echo "<script> alert('The admin profile has been updated.'); 
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