<?php
    include('ad_header.php');
?>

<header>
  <img src="../../img/Sas logo3.png" alt="" width="100px">
  <nav>
    <ul>
      <li class="active"><a href="ad_main.php" class="nav-link">Main</a></li>
      <li><a href="ad_user.php" class="nav-link">User</a></li>
    </ul>
  </nav>
  <button type="submit" class="logout">
    <p>LogOut</p>
  </button>
</header>


<h3 class="title">INVOICE CREATION</h3>
<hr style="width: 80%; margin-left: auto; margin-right: auto;">

<form action="../sadmin/sad_pdf.php" method="POST">
<div class="inv-card">
  <div class="card" style="width: 50%;">
    <div class="card-body">
      <p>Company Name:</p>
      <input type="text" name="comp_name">
      <p>Company Address:</p>
      <input type="text" name="comp_address">
      <p>Date:</p>
      <input type="text" name="date">
      <p>Terms (Days):</p>
      <input type="text" name="terms">
      <br><br>
      <center>

        <table style="border: 2px solid black;">
        <tr style="text-align:center;">
          <th>No.</th>
          <th>Particular</th>
          <th>Qtty</th>
          <th>Price/Unit</th>
          <th>Total (RM)</th>
        </tr>
        <?php
          for ($i=0; $i < 5; $i++) { 
        ?>
        <tr>
          <td><input type="text" style="width: 30px;" value="<?php echo $i+1; ?>."></td>
          <td><input type="text" style="width: 300px;" name="particular<?php echo $i+1; ?>"></td>
          <td><input type="text" style="width: 50px;" name="qtty<?php echo $i+1; ?>"></td>
          <td><input type="text" style="width: 100px;" name="price<?php echo $i+1; ?>"></td>
          <td><input type="text" style="width: 90px;" name="total<?php echo $i+1; ?>"></td>
        </tr>
        <?php
          }
        ?>
        </table>
      </center>
      <br>
      <button type="submit" name="view">View Invoice</button>
    </div>
  </div>
</div>
</form>
