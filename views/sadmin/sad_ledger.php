<?php
    include('sad_header.php');
?>

<?php
  $query = "SELECT DISTINCT debt_name FROM debt";
  $result = mysqli_query($con, $query);

  $existingCompanies = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $existingCompanies[] = $row['debt_name'];
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
  <button type="submit" class="logout">
    <p>LogOut</p>
  </button>
</header>

<h3 class="title">DEBTORS LEDGER</h3>
<hr style="width: 80%; margin-left: auto; margin-right: auto;">

<center>
    <input type="text" name="company" class="form-select" id="comp_name" list="companyList" style="width:80%;" placeholder="Type or Select Company" value="<?php if (isset($_GET['company'])) { $company = $_GET['company']; echo $company; }  ?>" required>
    <datalist id="companyList" size="5">
      <?php
      // Iterate over existing company names and populate the datalist
      foreach ($existingCompanies as $company) {
          echo '<option value="' . $company . '">';
      }
      ?>
    </datalist>
    <br>
  <a href="?company=<?php echo $company; ?>" class="btn btn-primary">Submit</a>
</center>
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
    if (isset($_GET['company'])) {
      $selectedCompany = mysqli_real_escape_string($con, $_GET['company']);
    } else {
      $selectedCompany = ""; // Initialize $company to prevent errors
    }
    
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
    usort($data, function($a, $b) {
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
</center>
  