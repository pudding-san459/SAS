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
  