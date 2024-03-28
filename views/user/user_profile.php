<?php
    include('user_header.php');

    session_start();
    $id_user = $_SESSION['id_user'];

    $query = mysqli_query($con, "SELECT * FROM user WHERE id_user = '$id_user'");
    $row = mysqli_fetch_array($query);
?>
<link rel="stylesheet" href="../../src/css/profile.css">

<header>
  <img src="../../img/Sas logo3.png" alt="" width="100px">
  <nav>
    <ul>
      <li><a href="user_main.php" class="nav-link">Main</a></li>
      <li class="active"><a href="user_profile.php" class="nav-link">Profile</a></li>
    </ul>
  </nav>
  <a href="inc/logout.php" class="logout">
    <p>LogOut</p>
  </a>
</header>

<h3 class="title">USER PROFILE</h3>
<hr style="width: 80%; margin-left: auto; margin-right: auto;">

    <!-- Main -->
    <div class="main">
        <div class="card">
            <div class="card-body">
                <table>
                    <tbody>
                        <tr>
                            <td style="width: 180px;">Company Name</td>
                            <td>:</td>
                            <td><?php echo $row['company_name']; ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><?php echo $row['user_email']; ?></td>
                        </tr>
                        <tr>
                            <td>Phone Number</td>
                            <td>:</td>
                            <td>+6<?php echo $row['company_tel']; ?></td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td>:</td>
                            <td><?php echo $row['username']; ?></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td>:</td>
                            <td><?php echo $row['password']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>