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

<h3 class="title">GENERAL ENTRY</h3>
<hr style="width: 80%; margin-left: auto; margin-right: auto;">


  <table class="table table-bordered general">
    <tr style="background-color: #00F7FF;">
      <th style="width: 100px;">Date</th>
      <th style="width: 100px;">Invoice</th>
      <th style="width: 130px;">Payment Of</th>
      <th style="width: 450px;">Debtors</th>
      <th style="width: 200px">Description</th>
      <th style="width: 100px">Amount</th>
      <th style="width: 100px;">OutBalance</th>
      <th style="width: 120px;">Invoice PDF</th>
      <th colspan="2">Action</th>
    </tr>
    <tr>
      <td>12/12/2024</td>
      <td>INV001</td>
      <td>INV001</td>
      <td></td>
      <td>Pemasangan elektrik</td>
      <td>237,000.00</td>
      <td>COMPELETED</td>
      <td><a href="#">inv001.pdf</a></td>
      <td><button>Update</button></td>
      <td><button>Delete</button></td>
    </tr>
  </table>
</center>


