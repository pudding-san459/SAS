
<?php

include('sad_header.php');
    
?>
<link rel="stylesheet" href="../../src/css/profile.css">
<header>
  <img src="../../img/Sas logo3.png" alt="" width="100px">
  <nav>
    <ul>
      <li><a href="sad_main.php" class="nav-link">Main</a></li>
      <li class="active"><a href="sad_user.php" class="nav-link">User</a></li>
      <li><a href="sad_admin.php" class="nav-link">Admin</a></li>
    </ul>
  </nav>
  <button type="submit" class="logout">
    <p>LogOut</p>
  </button>
</header>

<h3 class="title">USER MENU</h3>
<hr style="width: 80%; margin-left: auto; margin-right: auto;">
<br>

<?php

    if (isset($_POST['uppage'])) {
        $id = $_POST['id'];
        $query = mysqli_query($con, "SELECT * FROM user WHERE id_user =". $id);
        while($data=mysqli_fetch_array($query)):
    
?>
<div class="main">
        <div class="card">
            <div class="card-body">
                <form method="POST">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                <table>
                    <tr>
                        <td>Company Name</td>
                        <td>:</td>
                        <td><input type="text" name="comp_name" value="<?php echo $data['company_name']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><input type="text" name="comp_email" value="<?php echo $data['user_email']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Phone Number</td>
                        <td>:</td>
                        <td><input type="text" name="comp_tel" value="<?php echo $data['company_tel']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td>
                            <select name="status">
                                <?php 
                                    if ($data['status'] == "pending") :
                                        echo "<option>-- Select Status --</option>";
                                        echo "<option value='approved'>Approved</option>";
                                        echo "<option value='pending' selected>Pending</option>";
                                    endif;
                                ?>
                                <?php 
                                    if ($data['status'] == "approved") :
                                        echo "<option>-- Select Status --</option>";
                                        echo "<option value='approved' selected>approved</option>";
                                        echo "<option value='pending'>pending</option>";
                                    endif;
                                ?>

                            </select>
                        </td>
                    </tr>
                </table>
                <center>
                    <button class="btn btn-warning" name="update">Update</button>
                    <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-secondary">Back</a>

                </center>
                </form>
            </div>
        </div>
    </div>
    <?php endwhile; }?>

    <?php 

        if (isset($_POST['update'])):
            $name = $_POST['comp_name'];
            $email = $_POST['comp_email'];
            $tel = $_POST['comp_tel'];
            $status = $_POST['status'];
            $userId = $_POST['id'];

            // Retrieve current status of the user
            $query = mysqli_query($con, "SELECT status FROM user WHERE id_user =" . $userId);
            $userData = mysqli_fetch_assoc($query);
            $currentStatus = $userData['status'];

            $update = mysqli_query($con, "UPDATE user set company_name='$name', user_email='$email', company_tel='$tel', status='$status' WHERE id_user =".$userId);

            if (!$update) {
                die("Query failed: " . mysqli_error($con));
            } else {
                echo "<script> alert('The user profile has been updated.'); 
                window.location='sad_user.php'; </script>";
                exit; // Stop further execution
            }
        endif;
    ?>
