<?php
    include('sad_header.php');

    session_start(); // Starting the session

    // Check if the user is not logged in, redirect to the login page
    if (!isset($_SESSION['admin_name'])) {
        header("Location: ../ad_login.php");
        exit(); // Ensure script stops here
    }

?>
<link rel="stylesheet" href="../../src/css/search.css">
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

<h3 class="title">GENERAL ENTRY</h3>
<hr style="width: 80%; margin-left: auto; margin-right: auto;">

<center>
    <input placeholder="Search the database...." type="text" name="text" id="myInput" onkeyup="myFunction()" class="search">
</center>
<br>

<table class="table table-bordered general" id="myTable">
  <tr style="background-color: #00F7FF;">
    <th style="width: 140px;">Date</th>
    <th style="width: 100px;">Invoice</th>
    <th style="width: 130px;">Payment Of</th>
    <th style="width: 450px;">Debtors</th>
    <th style="width: 200px">Description</th>
    <th style="width: 100px">Amount</th>
    <th style="width: 120px;">Invoice PDF</th>
    <th>Action</th>
  </tr>
  <?php

    $data = array(); // Initialize the data array outside the loop

    // Fetch data from both debt and credit tables
    $debt_query = mysqli_query($con, "SELECT * FROM debt");
    $credit_query = mysqli_query($con, "SELECT * FROM credit");

    // Combine results from both queries into a single array
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

<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, j, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows except the first one (header row)
  for (i = 1; i < tr.length; i++) {
    // Reset display property for each row
    tr[i].style.display = "";

    // Loop through all table cells in current row
    var found = false;
    for (j = 0; j < tr[i].cells.length; j++) {
      td = tr[i].cells[j];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          found = true;
          break;  // Break loop if match found in any cell
        }
      }
    }
    if (!found) {
      tr[i].style.display = "none";  // Hide row if no match found in any cell
    }
  }
}
</script>