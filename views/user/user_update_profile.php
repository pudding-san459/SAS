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
                            <td><input type="text" placeholder="Company Name..." readonly></td>
                        </tr>
                        <tr>
                            <td style="width: 240px;">Company Email</td>
                            <td>:</td>
                            <td><input type="text" placeholder="Company Email..."></td>
                        </tr>
                        <tr>
                            <td style="width: 240px;">Company Phone Number</td>
                            <td>:</td>
                            <td><input type="text" placeholder="Company Phone Number..."></td>
                        </tr>
                        <tr>
                            <td style="width: 240px;">Username</td>
                            <td>:</td>
                            <td><input type="text" placeholder="Username..."></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td>:</td>
                            <td><input type="text" placeholder="Password..."></td>
                        </tr>
                        <tr>
                            <td>Confirm Password</td>
                            <td>:</td>
                            <td><input type="text" placeholder="Confirm Password..."></td>
                        </tr>
                        <tr>
                            <td><button class="btn btn-warning">Update Profile</button></td>
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