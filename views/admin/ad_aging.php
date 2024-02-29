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

<h3 class="title">DEBTORS AGING</h3>
<hr style="width: 80%; margin-left: auto; margin-right: auto;">
  
<select class="form-select" style="width: 80%; margin-left: auto; margin-right: auto; margin-bottom: 3vh;">
  <option selected>Open this select menu</option>
  <option value="1">One</option>
  <option value="2">Two</option>
  <option value="3">Three</option>
</select>

<table class="table table-bordered aging">
  <tr style="background-color: #00F7FF;">
    <th style="width: 100px;">Invoice</th>
    <th style="width: 170px">Amount due</th>
    <th style="width: 180px">Past Due 1 - 30 days</th>
    <th style="width: 185px">Past Due 31 - 60 days</th>
    <th style="width: 185px;">Past Due 61 - 90 days</th>
    <th style="width: 190px;">Past Due 91 - 120 days</th>
    <th style="width: 185px;">Past Due 121+ days</th>
  </tr>
  <tr>
    <td>Inv001</td>
    <td class="text-end">57,000.00</td>
    <td class="text-end" style="background-color: #FFF3F3">33,000.00</td>
    <td class="text-end" style="background-color: #FFE6E7">-</td>
    <td class="text-end" style="background-color: #FFDCDC">-</td>
    <td class="text-end" style="background-color: #FFD1D3">-</td>
    <td class="text-end" style="background-color: #FFC1C2">-</td>
  </tr>
  <tr>
    <th colspan="2" style="text-align: end; background-color: #00F7FF;">57,000.00</th>
    <th class="text-end" style="background-color: #FFF3F3">33,000.00</th>
    <th class="text-end" style="background-color: #FFE6E7">-</th>
    <th class="text-end" style="background-color: #FFDCDC">-</th>
    <th class="text-end" style="background-color: #FFD1D3">-</th>
    <th class="text-end" style="background-color: #FFC1C2">-</th>
  </tr>
</table>