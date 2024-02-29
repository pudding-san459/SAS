<?php
    include('user_header.php');
?>

<header>
  <img src="../../img/Sas logo3.png" alt="" width="100px">
  <nav>
    <ul>
      <li class="active"><a href="user_main.php" class="nav-link">Main</a></li>
      <li><a href="user_profile.php" class="nav-link">Profile</a></li>
    </ul>
  </nav>
  <button type="submit" class="logout">
    <p>LogOut</p>
  </button>
</header>

<h3 class="title">INVOICE STATUS</h3>
<hr style="width: 80%; margin-left: auto; margin-right: auto;">

<h3 style="text-align: center;">Company Name</h3>
<br>
<div class="d-flex justify-content-center" style="gap: 20vh; margin-bottom: 5vh;">
  <button type="button" class="btn btn-success"><h5>Complete</h5></button>
  <button type="button" class="btn btn-primary"><h5>Current</h5></button>
  <button type="button" class="btn btn-danger"><h5>Pass Due</h5></button>
</div>


<table class="table table-bordered ledger">
  <tr style="background-color: #00F7FF;">
    <th style="width: 100px;">Date</th>
    <th style="width: 100px;">Invoice</th>
    <th style="width: 500px">Debtor</th>
    <th style="width: 150px;">Status</th>
    <th style="width: 125px">Amount</th>
    <th style="width: 200px">Days Past Due</th>
  </tr>
  <tr>
    <td>12/12/2024</td>
    <td>Inv001</td>
    <td>Pemasangan elektrik</td>
    <td style="background-color: salmon;">Pass Due</td>
    <td>33,000.00</td>
    <td>-</td>
  </tr>
  <tr style="background-color: #00F7FF;">
    <th colspan="4" style="text-align: start; border-right: none; "><b>Grand Total</b></th>
    <th style="border-left: none; border-right: none;">33,000.00</th>
    <th style="border-left: none;"></th>
  </tr>
</table>