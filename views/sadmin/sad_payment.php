<?php
    include('sad_header.php');
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

<h3 class="title">RECEIPT CREATION</h3>
<hr style="width: 80%; margin-left: auto; margin-right: auto;">

<?php
  $query = "SELECT DISTINCT debt_name FROM debt";
  $result = mysqli_query($con, $query);

  $existingCompanies = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $existingCompanies[] = $row['debt_name'];
  }

  $query = "SELECT DISTINCT debt_invoice FROM debt WHERE status IN ('CURRENT', 'PASS DUE')";
  $result = mysqli_query($con, $query);
  
  $existingInvoice = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $existingInvoice[] = $row['debt_invoice'];
  }
?>

<form action="sad_pay_pdf.php" method="POST">
<div class="inv-card">
  <div class="card" style="width: 50%;">
    <div class="card-body">
      <table style="width: 100%;">
        <tr>
          <td style="text-align: start; width: 200px;"><p>Company Name</p></td>
          <td style="width: 10px;" ><p>:</p></td>
          <td style="text-align:start;">
            <input type="text" name="comp_name" id="comp_name" list="companyList" style="width:90%;" required>
            <datalist id="companyList" size="5">
              <?php
              // Iterate over existing company names and populate the datalist
              foreach ($existingCompanies as $company) {
                  echo '<option value="' . $company . '">';
              }
              ?>
            </datalist>
          </td>
        </tr>
        <tr>
          <td style="text-align: start;"><p>Payment of</p></td>
          <td>:</td>
          <td style="text-align:start;">
          <input type="text" name="comp_inv" id="comp_inv" list="invoiceList" style="width:90%;" required>
            <datalist id="invoiceList" size="5">
              <?php
              // Iterate over existing debt invoices and populate the datalist
              foreach ($existingInvoice as $invoice) {
                  echo '<option value="' . $invoice . '">';
              }
              ?>
          </td>
        </tr>
        <tr>
          <td style="text-align: start;"><p>Date</p></td>
          <td>:</td>
          <td style="text-align:start;"><input type="date" name="date" style="width:50%;" required></td>
        </tr>
        <tr>
          <td style="text-align: start;"><p>Amount (RM)</p></td>
          <td>:</td>
          <td style="text-align:start;"><input type="number" name="payment" style="width:90%;" required></td>
        </tr>
      </table>
      <button type="submit" name="view">View Invoice</button>
    </div>
  </div>
</div>
</form>
