<?php
    include('user_header.php');
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
  <button type="submit" class="logout">
    <p>LogOut</p>
  </button>
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
                            <td style="width: 240px;">Company Name</td>
                            <td>:</td>
                            <td>ImDezCode</td>
                        </tr>
                        <tr>
                            <td style="width: 240px;">Company Email</td>
                            <td>:</td>
                            <td>imdezcode@gmail.com</td>
                        </tr>
                        <tr>
                            <td style="width: 240px;">Company Phone Number</td>
                            <td>:</td>
                            <td>Bali, Indonesia</td>
                        </tr>
                        <tr>
                            <td style="width: 240px;">Username</td>
                            <td>:</td>
                            <td>Diving, Reading Book</td>
                        </tr>
                        <tr>
                            <td><a href="user_update_profile.php" class="btn btn-primary">Update Profile</a></td>
                        </tr>
                        <!-- <form method="POST">
                        <tr>
                        
                            <td><input type="password" placeholder="Password" name="password" required></td>
                            <td></td>
                            <td><input type="password" placeholder="Comfirm Password" name="password" required></td>
                        </tr>
                        </form> -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>