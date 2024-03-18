<?php
    include('user_header.php');

    session_start(); // Starting the session
    $companyname = $_SESSION['company_name'];

    // Check if the user is not logged in, redirect to the login page
    if (!isset($_SESSION['company_name'])) {
        header("Location: ../login.php");
        exit(); // Ensure script stops here
    }
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


<h3 class="title">DEBTORS LEDGER</h3>
<hr style="width: 80%; margin-left: auto; margin-right: auto;">

<h3 style="text-align: center;">Showing ledger for <?php echo $companyname ?></h3>
<br>

<table class="table table-bordered ledger">
  <tr style="background-color: #00F7FF;">
    <th style="width: 120px;">Date</th>
    <th style="width: 500px">Description</th>
    <th style="width: 125px">Debit</th>
    <th style="width: 125px">Credit</th>
    <th style="width: 100px;">Balance</th>
  </tr>
  <?php
    $selectedCompany = $_SESSION['company_name'];
    if (!empty($selectedCompany)) {
        // Fetch debt data
        $debt_query = mysqli_query($con, "SELECT * FROM debt WHERE debt_name = '$selectedCompany'");
        $debt_rows = mysqli_fetch_all($debt_query, MYSQLI_ASSOC);
    
        // Fetch credit data
        $credit_query = mysqli_query($con, "SELECT * FROM credit WHERE debt_name = '$selectedCompany'");
        $credit_rows = mysqli_fetch_all($credit_query, MYSQLI_ASSOC);
    
        // Merge debt and credit data
        $data = array_merge($debt_rows, $credit_rows);
    
        // Sort data by date
        usort($data, function ($a, $b) {
            return strtotime($a['date']) - strtotime($b['date']);
        });
      
        // Initialize balance
        $balance = 0;
      
        // Display data
        foreach ($data as $row) {
  ?>
    <tr>
      <td><?php echo $row['date'] ?></td>
      <td><?php echo isset($row['description']) ? $row['debt_invoice'] . " : " . $row['description'] : "payment_of : " . $row['payment_of']; ?></td>
      <td><?php echo isset($row['real_debt']) ? number_format($row['real_debt'], 2) : "-"; ?></td>
      <td><?php echo isset($row['real_debt']) ? "-" : number_format($row['amount'], 2); ?></td>
      <td><?php
                // Update balance
                if (isset($row['real_debt'])) {
                    $balance += $row['real_debt'];
                } elseif (isset($row['amount'])) {
                    $balance -= $row['amount'];
                }
                echo number_format($balance, 2);
          ?>
      </td>
    </tr>
<?php
}
}
?>
</table>
  