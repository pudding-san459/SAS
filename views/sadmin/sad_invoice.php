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

<h3 class="title">INVOICE CREATION</h3>
<hr style="width: 80%; margin-left: auto; margin-right: auto;">

<?php
  $query = "SELECT DISTINCT debt_name FROM debt";
  $result = mysqli_query($con, $query);

  $existingCompanies = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $existingCompanies[] = $row['debt_name'];
  }
?>

<form action="sad_inv_pdf.php" method="POST">
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
          <td style="text-align: start;"><p>Company Address</p></td>
          <td>:</td>
          <td style="text-align:start;">
            <textarea type="text" name="comp_address" style="width:90%;" required></textarea>
          </td>
        </tr>
        <tr>
          <td style="text-align: start;"><p>Date</p></td>
          <td>:</td>
          <td style="text-align:start;"><input type="date" name="date" style="width:50%;" required></td>
        </tr>
        <tr>
          <td style="text-align: start;"><p>Terms (Days)</p></td>
          <td>:</td>
          <td style="text-align:start;"><input type="text" name="terms" style="width:90%;" required></td>
        </tr>
        <tr>
          <td style="text-align: start;"><p>Description</p></td>
          <td>:</td>
          <td style="text-align:start;"><textarea type="text" name="desc" style="width:90%;" required></textarea></td>
        </tr>
      </table>
      <br>
      <center>

        <table style="border: 2px solid black; width: 100%; border-spacing: 0;">
        <tr style="text-align:center;">
          <th>No.</th>
          <th>Particular</th>
          <th>Qtty</th>
          <th>Price/Unit</th>
        </tr>
        <?php
          for ($i=0; $i < 5; $i++) { 
        ?>
        <tr>
          <td><input type="text" style="width: 40px; text-align: center;" value="<?php echo $i+1; ?>."></td>
          <td><input type="text" style="width: 415px;" name="particular<?php echo $i+1; ?>"></td>
          <td><input type="text" style="width: 50px;" name="qtty<?php echo $i+1; ?>"></td>
          <td><input type="text" style="width: 125px;" name="price<?php echo $i+1; ?>"></td>
        </tr>
        <?php
          }
        ?>
        </table>
      </center>
      <br>
      <button type="submit" name="view"  class="btn" style="background-color: #627254; color: white;">View Invoice</button>
    </div>
  </div>
</div>
</form>
