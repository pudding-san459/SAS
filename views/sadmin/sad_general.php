<?php
    include('sad_header.php');

    // Fetch existing companies from the database
    $query = "SELECT DISTINCT debt_name FROM debt";
    $result = mysqli_query($con, $query);
  
    $existingCompanies = array();
    while ($row = mysqli_fetch_assoc($result)) {
      $existingCompanies[] = $row['debt_name'];
    }

    // Retrieve the company name from the URL parameter, if available
    $company = isset($_GET['company']) ? $_GET['company'] : '';
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

<h3 class="title">GENERAL ENTRY</h3>
<hr style="width: 80%; margin-left: auto; margin-right: auto;">

<center>
    <input type="text" name="company" class="form-select" id="comp_name" list="companyList" style="width:80%;" placeholder="Type or Select Company" value="<?php echo $company; ?>" required>
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

<table class="table table-bordered general">
  <tr style="background-color: #00F7FF;">
    <th style="width: 140px;">Date</th>
    <th style="width: 100px;">Invoice</th>
    <th style="width: 130px;">Payment Of</th>
    <th style="width: 450px;">Debtors</th>
    <th style="width: 200px">Description</th>
    <th style="width: 100px">Amount</th>
    <th style="width: 120px;">Invoice PDF</th>
    <th colspan="2">Action</th>
  </tr>
  <?php
    // Fetch data from both debt and credit tables for the selected company, or all data if no company is selected
    if (!empty($company)) {
      $debt_query = mysqli_query($con, "SELECT * FROM debt WHERE debt_name = '$company'");
      $credit_query = mysqli_query($con, "SELECT * FROM credit WHERE debt_name = '$company'");
    } else {
      $debt_query = mysqli_query($con, "SELECT * FROM debt");
      $credit_query = mysqli_query($con, "SELECT * FROM credit");
    }

    // Combine results from both queries into a single array
    $data = array();
    while ($row = mysqli_fetch_assoc($debt_query)) {
        $data[] = $row;
    }
    while ($row = mysqli_fetch_assoc($credit_query)) {
        $data[] = $row;
    }

    foreach ($data as $row) {
  ?>

  <tr>
    <?php 
      if (isset($row['debt_invoice'])) {
    ?>
    <td><?php echo $row['date'] ?></td>
    <td><?php echo $row['debt_invoice']; ?></td>
    <td>-</td>
    <td><?php echo $row['debt_name']; ?></td>
    <td><?php echo $row['description'] ?></td>
    <td><?php echo $row['amount'] ?></td>
    <td><a href="../invoice_pdf/<?php echo $row['debt_invoice']; ?>.pdf" target="_blank"><?php echo $row['debt_invoice']; ?>.pdf</a></td>
    <td><button>Update</button></td>
    <td>
      <form action="inc/delete_entry.php" method="post">
          <input type="hidden" name="invoice" value="<?php echo $row['debt_invoice']; ?>">
          <button type="submit" name="delete_debt">Delete</button>
      </form>
    </td>
    <?php
      } elseif (isset($row['cred_invoice'])) {
    ?>
    <td><?php echo $row['date'] ?></td>
    <td><?php echo $row['cred_invoice']; ?></td>
    <td><?php echo $row['payment_of']; ?></td>
    <td><?php echo $row['debt_name']; ?></td>
    <td>-</td>
    <td><?php echo $row['amount']; ?></td>
    <td><a href="../payment_pdf/<?php echo $row['cred_invoice']; ?>.pdf" target="_blank"><?php echo $row['cred_invoice']; ?>.pdf</a></td>
    <td><button>Update</button></td>
    <td>
        <form action="inc/delete_entry.php" method="post">
            <input type="hidden" name="invoice" value="<?php echo $row['cred_invoice']; ?>">
            <button type="submit" name="delete_credit">Delete</button>
        </form>
    </td>
  </tr>
  <?php
      }
    }
  ?>
</table>
</center>
