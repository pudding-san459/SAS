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

<h3 class="title">MAIN MENU</h3>
<hr style="width: 80%; margin-left: auto; margin-right: auto;">

<br>
<table border="0" style="margin-left: auto; margin-right:auto; width: 90%;">
  <tr>
    <th style="text-align: center; width: 200px;"><h4>INVOICE</h4></th>
    <td><a href="sad_invoice.php" class="btn main-button2">Invoice KRC <img src="../../img/invoice.png" style="width: 50px;"></a></td>
    <td><a href="sad_payment.php
    " class="btn main-button2">Payment KRC <img src="../../img/receipt.png" style="width: 50px;"></a></td>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td colspan="5" style="height: 30px"></td>
  </tr>
  <tr>
    <th style="text-align: center;"><h4>DATA ENTRY</h4></th>
    <td><a href="sad_general.php" class="btn main-button2">General Entry <img src="../../img/contract.png" style="width: 40px;"></a></td>
    <td><a href="sad_search.php" class="btn main-button2">Search <img src="../../img/magnifying-glass.png" style="width: 40px;"></a></td>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td colspan="5" style="height: 30px"></td>
  </tr>
  <tr>
    <th style="text-align: center;"><h4>REPORT</h4></th>
    <td><a href="sad_listing.php" class="btn main-button2">Debtors Listing <img src="../../img/paper.png" style="width: 40px;"></a></td>
    <td><a href="sad_status.php" class="btn main-button2">Invoice Status <img src="../../img/files.png" style="width: 40px;"></a></td>
    <td><a href="sad_ledger.php" class="btn main-button2">Debtors Ledger <img src="../../img/document.png" style="width: 40px;"></a></td>
    <td><a href="sad_aging.php" class="btn main-button2">Debtors Aging <img src="../../img/age.png" style="width: 40px;"></a></td>
  </tr>
</table>
