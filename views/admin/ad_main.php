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

<h3 class="title">MAIN MENU</h3>
<hr style="width: 80%; margin-left: auto; margin-right: auto;">
<br>
<table border="0" style="margin-left: auto; margin-right:auto; width: 90%;">
  <tr>
    <th style="text-align: center; width: 200px"><h4>INVOICE</h4></th>
    <td><a href="ad_invoice.php" class="btn btn-secondary main-button2">Invoice KRC <img src="../../img/invoice.png" style="width: 50px;"></a></td>
    <td><a href="ad_payment.php
    " class="btn btn-secondary main-button2">Payment KRC <img src="../../img/receipt.png" style="width: 50px;"></a></td>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td colspan="5" style="height: 30px"></td>
  </tr>
  <tr>
    <th style="text-align: center;"><h4>DATA ENTRY</h4></th>
    <td><a href="ad_general.php" class="btn btn-secondary main-button2">General Entry <img src="../../img/contract.png" style="width: 40px;"></a></td>
    <td><a href="ad_search.php" class="btn btn-secondary main-button2">Search <img src="../../img/magnifying-glass.png" style="width: 40px;"></a></td>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td colspan="5" style="height: 30px"></td>
  </tr>
  <tr>
    <th style="text-align: center;"><h4>REPORT</h4></th>
    <td><a href="ad_listing.php" class="btn btn-secondary main-button2">Debtors Listing <img src="../../img/paper.png" style="width: 40px;"></a></td>
    <td><a href="ad_status.php" class="btn btn-secondary main-button2">Invoice Status <img src="../../img/files.png" style="width: 40px;"></a></td>
    <td><a href="ad_ledger.php" class="btn btn-secondary main-button2">Debtors Ledger <img src="../../img/document.png" style="width: 40px;"></a></td>
    <td><a href="ad_aging.php" class="btn btn-secondary main-button2">Debtors Aging <img src="../../img/age.png" style="width: 40px;"></a></td>
  </tr>
</table>
