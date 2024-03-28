<?php
    include('ad_header.php');

    session_start(); // Starting the session

    // Check if the user is not logged in, redirect to the login page
    if (!isset($_SESSION['admin_name'])) {
        header("Location: ../ad_login.php");
        exit(); // Ensure script stops here
    }
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
      <li class="active"><a href="ad_main.php" class="nav-link">Main</a></li>
      <li><a href="ad_user.php" class="nav-link">User</a></li>
    </ul>
  </nav>
  <a href="inc/logout.php" class="logout">
    <p>LogOut</p>
  </a>
</header>

<h3 class="title">DEBTORS AGING</h3>
<hr style="width: 80%; margin-left: auto; margin-right: auto;">

<center>
    <form method="get" action="ad_aging.php">
        <input type="text" name="company" class="form-select" id="comp_name" list="companyList" style="width:80%;" placeholder="Type or Select Company" value="<?php echo isset($_GET['company']) ? htmlspecialchars($_GET['company']) : ''; ?>" required>
        <datalist id="companyList" size="5">
            <?php
            // Iterate over existing company names and populate the datalist
            foreach ($existingCompanies as $companyOption) {
                echo '<option value="' . htmlspecialchars($companyOption) . '">';
            }
            ?>
        </datalist>
        <br>
        <button type="submit" class="btn" style="background-color: #76885B; color: white;">Submit</button>
    </form>
</center>
<br>



<table class="table table-bordered aging">
  <tr style="background-color: #76885B; color: white; border: black;">
    <th style="width: 100px;">Invoice</th>
    <th style="width: 170px">Amount due</th>
    <th style="width: 180px">Past Due 1 - 30 days</th>
    <th style="width: 185px">Past Due 31 - 60 days</th>
    <th style="width: 185px;">Past Due 61 - 90 days</th>
    <th style="width: 190px;">Past Due 91 - 120 days</th>
    <th style="width: 185px;">Past Due 121+ days</th>
  </tr>
  <?php

        // Initialize variables to store column totals
        $totalAmount = 0;
        $totalPastDue1to30 = 0;
        $totalPastDue31to60 = 0;
        $totalPastDue61to90 = 0;
        $totalPastDue91to120 = 0;
        $totalPastDue121plus = 0;

    // Check if a company is selected
    if (isset($_GET['company'])) {
        $selectedCompany = $_GET['company'];
    
        // Query to fetch data for the selected company
        $query = mysqli_query($con, "SELECT * FROM debt WHERE debt_name = '$selectedCompany'");
        while ($row = mysqli_fetch_array($query)) {
          // Calculate days overdue
            $dueDate = strtotime($row['dueDate']);
            $today = time();
            $daysOverdue = max(0, floor(($today - $dueDate) / (60 * 60 * 24)));

          // Update column totals
          $totalAmount += $row['amount'];
          if ($daysOverdue >= 1 && $daysOverdue <= 30) {
              $totalPastDue1to30 += $row['amount'];
          } elseif ($daysOverdue >= 31 && $daysOverdue <= 60) {
              $totalPastDue31to60 += $row['amount'];
          } elseif ($daysOverdue >= 61 && $daysOverdue <= 90) {
              $totalPastDue61to90 += $row['amount'];
          } elseif ($daysOverdue >= 91 && $daysOverdue <= 120) {
              $totalPastDue91to120 += $row['amount'];
          } elseif ($daysOverdue >= 121) {
              $totalPastDue121plus += $row['amount'];
          }
    ?>
  <tr>
    <td><?php echo $row['debt_invoice']; ?></td>
    <td class="text-end"><?php echo $row['amount']; ?></td>
    <td class="text-end" style="background-color: #FFF3F3"><?php echo ($daysOverdue >= 1 && $daysOverdue <= 30) ? $row['amount'] : '-'; ?></td>
    <td class="text-end" style="background-color: #FFE6E7"><?php echo ($daysOverdue >= 31 && $daysOverdue <= 60) ? $row['amount'] : '-'; ?></td>
    <td class="text-end" style="background-color: #FFDCDC"><?php echo ($daysOverdue >= 61 && $daysOverdue <= 90) ? $row['amount'] : '-'; ?></td>
    <td class="text-end" style="background-color: #FFDCDC"><?php echo ($daysOverdue >= 91 && $daysOverdue <= 120) ? $row['amount'] : '-'; ?></td>
    <td class="text-end" style="background-color: #FFD1D3"><?php echo ($daysOverdue >= 121) ? $row['amount'] : '-'; ?></td>
  </tr>
  <?php
        }
    } else {
      ?>
          
              <tr>
                <td colspan="7">Select a Company to Display Information</td>
              </tr>
          
      <?php
          }
  ?>
  <tr>
    <th colspan="2" style="text-align: end; background-color: #76885B; color: white;">Total:</th>
    <th class="text-end" style="background-color: #FFF3F3"><?php echo number_format($totalPastDue1to30, 2); ?></th>
    <th class="text-end" style="background-color: #FFE6E7"><?php echo number_format($totalPastDue31to60, 2); ?></th>
    <th class="text-end" style="background-color: #FFDCDC"><?php echo number_format($totalPastDue61to90, 2); ?></th>
    <th class="text-end" style="background-color: #FFD1D3"><?php echo number_format($totalPastDue91to120, 2); ?></th>
    <th class="text-end" style="background-color: #FFC1C2"><?php echo number_format($totalPastDue121plus, 2); ?></th>
  </tr>
</table>