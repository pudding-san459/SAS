<?php
    include('sad_header.php');
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
  <button type="submit" class="logout">
    <p>LogOut</p>
  </button>
</header>

<h3 class="title">SEARCH</h3>
<hr style="width: 80%; margin-left: auto; margin-right: auto;">

<center>
    <input placeholder="Search the database...." type="text" name="text" class="search">
</center>