<?php
    include('sad_header.php');
?>

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

  $query = mysqli_query($con,"SELECT * FROM user");
?>
<h4 style="text-align: center;">Pending Approval</h4>
<table class="table table-bordered ledger" style="width: 90%;">
  <tr style="background-color: #00F7FF;">
    <th style="width: 300px;">Company Name</th>
    <th style="width: 200px;">Username</th>
    <th style="width: 200px;">Password</th>
    <th style="width: 200px;">Email</th>
    <th style="width: 150px;">Phone Number</th>
    <th colspan="3">Action</th>
  </tr>
  <?php
    while ($data=mysqli_fetch_array($query)) {
      $dataArray[] = $data;
    }
    foreach ($dataArray as $data):
      if ($data['status'] == "pending"){
  ?>
  <tr>
    <td><?php echo $data['company_name'] ?></td>
    <td><?php echo $data['username'] ?></td>    
    <td><?php echo $data['password'] ?></td>
    <td><?php echo $data['user_email'] ?></td>
    <td><?php echo $data['company_tel'] ?></td>
    <form action="inc/approve.php" method="POST">
      <input type="hidden" value="<?php echo $data['id_user'] ?>" name="id">
      <td><button type="submit" name="approve" class="btn btn-success">Approve</button></td>
    </form>
    <form action="sad_reject.php" method="POST">
      <input type="hidden" value="<?php echo $data['id_user'] ?>" name="id">
      <td><button type="submit" name="uppage" class="btn btn-danger">Reject</button></td>
    </form>
    <form action="sad_delete.php" method="POST">
      <input type="hidden" value="<?php echo $data['id_user'] ?>" name="iduser">
      <td><button class="btn btn-dark" name="del_user">Delete</button></td>
    </form>
  </tr>
  <?php  } else{ ?>
  
  <tr>
    <td colspan="6">No Pending User</td>
  </tr>

<?php } endforeach; ?>
</table>
<br><br>
<hr style="width: 80%; margin-left: auto; margin-right: auto;">

<h4 style="text-align: center;">Approved User</h4>
<table class="table table-bordered ledger" style="width: 90%;">
  <tr style="background-color: #00F7FF;">
    <th style="width: 300px;">Company Name</th>
    <th style="width: 200px;">Username</th>
    <th style="width: 200px;">Password</th>
    <th style="width: 200px;">Email</th>
    <th style="width: 150px;">Phone Number</th>
    <th>Action</th>
  </tr>
  <?php
    foreach ($dataArray as $data):
      if ($data['status'] == "approved"){
  ?>
  <tr>
    <td><?php echo $data['company_name'] ?></td>
    <td><?php echo $data['username'] ?></td>    
    <td><?php echo $data['password'] ?></td>
    <td><?php echo $data['user_email'] ?></td>
    <td><?php echo $data['company_tel'] ?></td>
    <form action="sad_delete.php" method="POST">
      <input type="hidden" value="<?php echo $data['id_user'] ?>" name="iduser">
      <td><button class="btn btn-danger" name="del_user">Delete</button></td>
    </form>
  </tr>
  <?php  } else{ ?>
  
    <tr>
      <td colspan="6">No Approved User</td>
    </tr>

  <?php } endforeach; ?>
</table>
<br><br>
<hr style="width: 80%; margin-left: auto; margin-right: auto;">

<h4 style="text-align: center;">Rejected User</h4>
<table class="table table-bordered ledger" style="width: 90%;">
  <tr style="background-color: #00F7FF;">
    <th style="width: 300px;">Company Name</th>
    <th style="width: 200px;">Username</th>
    <th style="width: 200px;">Password</th>
    <th style="width: 200px;">Email</th>
    <th style="width: 150px;">Phone Number</th>
    <th>Action</th>
  </tr>
  <?php
    foreach ($dataArray as $data):
      if ($data['status'] == "rejected"){
  ?>
  <tr>
    <td><?php echo $data['company_name'] ?></td>
    <td><?php echo $data['username'] ?></td>    
    <td><?php echo $data['password'] ?></td>
    <td><?php echo $data['user_email'] ?></td>
    <td><?php echo $data['company_tel'] ?></td>
    <form action="sad_delete.php" method="POST">
      <input type="hidden" value="<?php echo $data['id_user'] ?>" name="iduser">
      <td><button class="btn btn-danger" name="del_user">Delete</button></td>
    </form>
  </tr>
  <?php  } else{ ?>
  
  <tr>
    <td colspan="6">No Rejected User</td>
  </tr>

<?php } endforeach; ?>
</table>