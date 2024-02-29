<?php
    include('ad_header.php');
?>

<header>
  <img src="../../img/Sas logo3.png" alt="" width="100px">
  <nav>
    <ul>
      <li><a href="ad_main.php" class="nav-link">Main</a></li>
      <li class="active"><a href="ad_user.php" class="nav-link">User</a></li>
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
  $query = mysqli_query($con,"SELECT * FROM user");
?>
<h4 style="text-align: center;">Pending Approval</h4>
<table class="table table-bordered ledger">
  <tr style="background-color: #00F7FF;">
    <th style="width: 300px;">Company Name</th>
    <th style="width: 200px;">Username</th>
    <th style="width: 200px;">Password</th>
    <th style="width: 200px;">Email</th>
    <th style="width: 150px;">Phone Number</th>
    <th style="width: 100px;">Status</th>
    <th colspan="2">Action</th>
  </tr>
  <?php
    while ($data=mysqli_fetch_array($query)) {
      $dataArray[] = $data;
    }
    foreach ($dataArray as $data):
      if ($data['status'] == "pending"):
  ?>
  <tr>
    <td><?php echo $data['company_name'] ?></td>
    <td><?php echo $data['username'] ?></td>    
    <td><?php echo $data['password'] ?></td>
    <td><?php echo $data['user_email'] ?></td>
    <td><?php echo $data['company_tel'] ?></td>
    <td><?php echo $data['status'] ?></td>
    <td><a href="../sadmin/sad_update_user.php?id=<?php echo $data['id_user']; ?>" class="btn btn-warning">Update</a></td>
    <form action="../sadmin/sad_delete.php" method="POST">
      <input type="hidden" value="<?php echo $data['id_user'] ?>" name="iduser">
      <td><button class="btn btn-danger" name="del_user">Delete</button></td>
    </form>
  </tr>
  <?php  endif; endforeach; ?>
</table>
<br><br>
<hr style="width: 80%; margin-left: auto; margin-right: auto;">

<h4 style="text-align: center;">Approved User</h4>
<table class="table table-bordered ledger">
  <tr style="background-color: #00F7FF;">
    <th style="width: 300px;">Company Name</th>
    <th style="width: 200px;">Username</th>
    <th style="width: 200px;">Password</th>
    <th style="width: 200px;">Email</th>
    <th style="width: 150px;">Phone Number</th>
    <th colspan="2">Action</th>
  </tr>
  <?php
    foreach ($dataArray as $data):
      if ($data['status'] == "approved"):
  ?>
  <tr>
    <td><?php echo $data['company_name'] ?></td>
    <td><?php echo $data['username'] ?></td>    
    <td><?php echo $data['password'] ?></td>
    <td><?php echo $data['user_email'] ?></td>
    <td><?php echo $data['company_tel'] ?></td>
    <td><a href="../sadmin/sad_update_user.php?id=<?php echo $data['id_user']; ?>" class="btn btn-warning">Update</a></td>
    <form action="../sadmin/sad_delete.php" method="POST">
      <input type="hidden" value="<?php echo $data['id_user'] ?>" name="iduser">
      <td><button class="btn btn-danger" name="del_user">Delete</button></td>
    </form>
  </tr>
  <?php  endif; endforeach; ?>
</table>