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

<h3 class="title">DEBTORS LEDGER</h3>
<hr style="width: 80%; margin-left: auto; margin-right: auto;">

<select class="form-select" style="width: 80%; margin-left: auto; margin-right: auto; margin-bottom: 3vh;">
  <option selected>Open this select menu</option>
  <option value="1">One</option>
  <option value="2">Two</option>
  <option value="3">Three</option>
</select>

<table class="table table-bordered ledger">
  <tr style="background-color: #00F7FF;">
    <th style="width: 100px;">Date</th>
    <th style="width: 700px">Description</th>
    <th style="width: 125px">Debit</th>
    <th style="width: 125px">Credit</th>
    <th style="width: 100px;">Balance</th>
  </tr>
  <tr>
    <td>12/12/2024</td>
    <td>Pemasangan elektrik</td>
    <td>33,000.00</td>
    <td>-</td>
    <td>33,000.00</td>
  </tr>
</table>
</center>
  