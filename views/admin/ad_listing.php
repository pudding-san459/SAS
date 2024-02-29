<?php
    include('ad_header.php');
?>

<header>
  <img src="../../img/Sas logo3.png" alt="" width="100px">
  <nav>
    <ul>
      <li class="active"><a href="ad_main.php" class="nav-link">Main</a></li>
      <li><a href="ad_user.php" class="nav-link">User</a></li>
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
    <th style="width: 125px">Amount Due</th>
  </tr>
  <tr style="background-color: #FFE6E7;">
    <td>1.</td>
    <td>Pemasangan elektrik</td>
    <td>33,000.00</td>
  </tr>
</table>