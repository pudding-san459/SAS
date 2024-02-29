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

<div class="d-flex justify-content-center" style="gap: 45vh; margin-bottom: 5vh;">
    <h4>INVOICE</h4>
    <h4>DATA ENTRY</h4>
    <h4>REPORT</h4>
</div>

<div class="main-button d-flex justify-content-center" style="gap: 28vh; margin-bottom: 5vh;">
    <div class="main-button-div" style="height: 360px;">
        <a href="ad_invoice.php" class="btn btn-secondary main-button2">Invoice KRC <img src="../../img/invoice.png" style="width: 50px;"></a>
        <br>
        <a href="#" class="btn btn-secondary main-button2">Payment KRC <img src="../../img/receipt.png" style="width: 50px;"></a>
        <br>
        <a href="#" class="btn btn-secondary main-button2">Invoice Library <img src="../../img/server-storage.png" style="width: 40px;"></a>
    </div>
    <div class="main-button-div" style="height: 230px;">
        <a href="ad_general.php" class="btn btn-secondary main-button2">General Entry <img src="../../img/contract.png" style="width: 40px;"></a>
        <br>
        <a href="ad_search.php" class="btn btn-secondary main-button2">Search <img src="../../img/magnifying-glass.png" style="width: 40px;"></a>
    </div>
    <div class="main-button-div" style="height: 430px;">
        <a href="ad_listing.php" class="btn btn-secondary main-button2">Debtors Listing <img src="../../img/paper.png" style="width: 40px;"></a>
        <br>
        <a href="ad_status.php" class="btn btn-secondary main-button2">Invoice Status <img src="../../img/files.png" style="width: 40px;"></a>
        <br>
        <a href="ad_ledger.php" class="btn btn-secondary main-button2">Debtors Ledger <img src="../../img/document.png" style="width: 35px;"></a>
        <br>
        <a href="ad_aging.php" class="btn btn-secondary main-button2">Debtors Aging <img src="../../img/age.png" style="width: 35px;"></a>
    </div>
</div>
