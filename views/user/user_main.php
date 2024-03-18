<?php
    include('user_header.php');
    
    session_start();
    $companyname = $_SESSION['company_name'];

    $query = mysqli_query($con, "SELECT SUM(amount) AS totalDebt FROM debt WHERE debt_name = '$companyname'");
    $row = mysqli_fetch_array($query);
?>

<header>
  <img src="../../img/Sas logo3.png" alt="" width="100px">
  <nav>
    <ul>
      <li class="active"><a href="user_main.php" class="nav-link">Main</a></li>
      <li><a href="user_profile.php" class="nav-link">Profile</a></li>
    </ul>
  </nav>
  <a href="inc/logout.php" class="logout">
    <p>LogOut</p>
  </a>
</header>

<h3 class="title">MAIN MENU</h3>
<hr style="width: 80%; margin-left: auto; margin-right: auto;">

<div class="d-flex justify-content-center" style=" margin-bottom: 3vh;">
    <h4><b>SHOWING REPORT FOR <?php echo strtoupper($companyname); ?></b></h4>
</div>

<div class="main-button d-flex justify-content-center" style="margin-bottom: 5vh;">
    <div class="d-flex flex-row" style="height: auto; width: 1000px; gap: 10vh;">
        <a href="user_status.php" class="btn btn-secondary main-button2">Invoice Status <img src="../../img/files.png" style="width: 40px;"></a>
        <a href="user_ledger.php" class="btn btn-secondary main-button2">Debtors Ledger <img src="../../img/document.png" style="width: 35px;"></a>
        <a href="user_aging.php" class="btn btn-secondary main-button2">Debtors Aging <img src="../../img/age.png" style="width: 35px;"></a>
    </div>
</div>

<div class="d-flex justify-content-center">
  <div class="info-user">
    <h5>Total Debt Balance : <b>RM <?php echo number_format($row['totalDebt'], 2); ?></b></h5>
  </div>
</div>
