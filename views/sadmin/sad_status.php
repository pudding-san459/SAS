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
      <li class="active"><a href="sad_main.php" class="nav-link">Main</a></li>
      <li><a href="sad_user.php" class="nav-link">User</a></li>
      <li><a href="sad_admin.php" class="nav-link">Admin</a></li>
    </ul>
  </nav>
  <a href="inc/logout.php" class="logout">
    <p>LogOut</p>
  </a>
</header>

<h3 class="title">INVOICE STATUS</h3>
<hr style="width: 80%; margin-left: auto; margin-right: auto;">

<center>
  <div class="" style=" margin-bottom: 5vh;">
    <a href="?status=completed" class="btn" style="background-color: lightblue;">Completed</a>
    <a href="?status=current" class="btn" style="background-color: lightgreen;">Current</a>
    <a href="?status=pass due" class="btn" style="background-color: salmon;">Pass Due</a>
  </div>
</center>


<table class="table table-bordered ledger">
  <tr style="background-color: #00F7FF;">
    <th style="width: 150px;">Date</th>
    <th style="width: 100px;">Invoice</th>
    <th style="width: 500px">Debtor</th>
    <th style="width: 150px;">Status</th>
    <th style="width: 180px">Amount</th>
    <th style="width: 150px">Days Past Due</th>
  </tr>

  <?php

  // Filter Query
  $filter = '';
  if (isset($_GET['status'])) {
  $status = $_GET['status'];
  if ($status === 'completed' || $status === 'current' || $status === 'pass due') {
    $filter = "WHERE status = '$status'";
  }
  }

  $tempTotal = 0;
  $grandTotal = 0;
  $order = 'CASE WHEN status = "PASS DUE" THEN 1 WHEN status = "CURRENT" THEN 2 WHEN status = "COMPLETED" THEN 3 ELSE 4 END, status';
  $query = mysqli_query($con, "SELECT * FROM debt $filter ORDER BY $order");
  while ($data = mysqli_fetch_array($query)) {
    
    $dueDate = strtotime($data['dueDate']);
    $today = strtotime(date('Y-m-d'));
    $daysOverdue = max(0, ($today - $dueDate) / (60 * 60 * 24));

    $backgroundColor = '';
    switch ($data['status']) {
        case 'CURRENT':
            $backgroundColor = 'lightgreen';
            break;
        case 'PASS DUE':
            $backgroundColor = 'salmon';
            break;
        case 'COMPLETED':
            $backgroundColor = 'lightblue';
            break;
        default:
            $backgroundColor = ''; // Default color
            break;
    }
  ?>  
  <tr>
    <td><?php echo $data['date']; ?></td>
    <td><?php echo $data['debt_invoice']; ?></td>
    <td><?php echo $data['debt_name']; ?></td>
    <td style="background-color: <?php echo $backgroundColor; ?>;"><?php echo $data['status'] ?></td>
    <td><?php echo number_format($data['amount'], 2); ?></td>
    <td><?php echo ($daysOverdue > 0) ? $daysOverdue : '-'; ?></td>
  </tr>
  <?php 

    $tempTotal += $data['amount'];
    $grandTotal = number_format((double)$tempTotal, 2);
    } 
  ?>
  <tr style="background-color: #00F7FF;">
    <th colspan="4" style="text-align: end; border-right: none; "><b>Grand Total</b></th>
    <th style="border-left: none; border-right: none;"><?php echo $grandTotal; ?></th>
    <th style="border-left: none;"></th>
  </tr>
</table>
<center>
<a href="?" class="btn" style="background-color: lightgray;">Clear filter</a>
</center>
