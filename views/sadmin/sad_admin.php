<?php
    include('sad_header.php');

    session_start(); // Starting the session

    // Check if the user is not logged in, redirect to the login page
    if (!isset($_SESSION['admin_name'])) {
        header("Location: ../ad_login.php");
        exit(); // Ensure script stops here
    }
?>

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

<?php
  $query = mysqli_query($con,"SELECT * FROM admin");
?>

<br>
<center>
  <h4>Admin</h4>
</center>


<table class="table table-bordered ledger">
  <tr style="background-color: #76885B; color:white; border-color: black;">
    <th style="width: 40%;">Name</th>
    <th style="width: 25%;">Username</th>
    <th style="width: 25%;">Password</th>
    <th colspan="2">Action</th>
  </tr>
  <?php
    while ($data=mysqli_fetch_assoc($query)) :
      if ($data['privilage'] == 1) :
  ?>
  <tr>
    <td><?php echo $data['admin_name'] ?></td>
    <td><?php echo $data['username'] ?></td>
    <td><?php echo $data['password'] ?></td>
    <td><a href="sad_update_admin.php?id=<?php echo $data['id_admin']; ?>" class="btn btn-warning">Update</a></td>
    <form action="sad_delete.php" method="POST">
      <input type="hidden" value="<?php echo $data['id_admin'] ?>" name="idadmin">
      <td><button class="btn btn-danger" name="del_admin">Delete</button></td>
  </tr>
  <?php
    endif;
    endwhile;
  ?>
</table>
<center>
  <a href="sad_addadmin.php" class="btn" style="background-color: #627254; color: white;">Add user</a>
</center>
