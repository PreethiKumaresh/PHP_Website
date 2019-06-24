<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Online Book Hub</title>
	<link rel="stylesheet" type="text/css" href="Static/admin.css">
	<link rel="stylesheet" href="https://use.typekit.net/wqe7gdm.css">
</head>
<body>
	<header>
    <img src="Images/logo5.png" height="60px" >
    <h3 align="right" style="color: white; position: absolute; top:0px;right: 10px;">Welcome <?php echo $_SESSION['sname'];?></h3>
  </header>

	<section class="menu">
    <nav>
      <a href="profile.php" class="menu-items">My Profile</a>
      <a href="viewbook.php" class="menu-items">View Books</a>
      <a href="booksissued.php" class="menu-items">Books Issued</a>
      <a href="buybook.php" class="menu-items"> E-Book</a>
      <a href="chpwd.php" class="menu-items">Change Password</a>
      <a href="logout.php" class="menu-items">Logout</a>
    </nav>
  </section>
  <section class="menu-content">
  	<div align="center">
      <h1>ONLINE BOOK</h1>
      <h4>you can view and download book pdf</h4>
    </div>
  </section>
</body>
</html>