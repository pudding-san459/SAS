<?php
    include('sad_header.php');
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
  <button type="submit" class="logout">
    <p>LogOut</p>
  </button>
</header>



<h3 class="title">DEBTORS LISTING</h3>
<hr style="width: 80%; margin-left: auto; margin-right: auto;">

<table class="table table-bordered ledger">
  <tr style="background-color: #00F7FF;">
    <th style="width: 100px;">No.</th>
    <th style="width: 700px">Debtors</th>
    <th style="width: 200px">Amount Due</th>
  </tr>
  <?php
  $tempTotal = 0;
  $subTotal = 0;
  $i = 1;
  $query = "SELECT debt_name, SUM(amount) AS total_debt FROM debt GROUP BY LOWER(debt_name)";
  $result = mysqli_query($con, $query);
  while ($row = mysqli_fetch_assoc($result)) {
  ?>
  <tr style="background-color: #FFE6E7;">
    <td><?php echo $i; ?>.</td>
    <td><?php echo $row['debt_name']; ?></td>
    <td><?php echo number_format((double)$row['total_debt'], 2) ?></td>
  </tr>
  <?php

  $i++;
  $tempTotal += $row['total_debt'];
  $subTotal = $tempTotal;
  }
  ?>
  <tr style="background-color: #00F7FF;">
    <th colspan="2" style="text-align: end;">Total:</td>
    <th>RM <?php echo  number_format($subTotal, 2); ?></td>
  </tr>


</table>