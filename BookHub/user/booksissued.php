<?php
session_start();
$sid=$_SESSION['sid'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Online Book Hub</title>
	<link rel="stylesheet" type="text/css" href="Static/admin.css">
	<link rel="stylesheet" href="https://use.typekit.net/wqe7gdm.css">
</head>
<style type="text/css">
table{
      border-collapse: collapse; 
      border:1px solid black;
    }
    th{
      background-color: #ffbc4b;
      padding: 10px;
    }
    td{
      padding:10px;
      text-align: center;
    }
  </style>
<body>
	<header>
    <img src="Images/logo5.png" height="60px" >
    <h3 align="right" style="color: white; position: absolute; top:0px;right: 10px;">Welcome <?php echo $_SESSION['sname'];?></h3>
  </header>

	<section class="menu">
    <nav>
      <a href="profile.php" class="menu-items">My Profile</a>
      <a href="viewbook.php" class="menu-items">View Books</a>
      <a href="booksissued.php" class="menu-items">My Book List</a>
      <!--<a href="buybook.php" class="menu-items"> E-Book</a>-->
      <a href="chpwd.php" class="menu-items">Change Password</a>
      <a href="logout.php" class="menu-items">Logout</a>
    </nav>
  </section>
  <section class="menu-content">
    <div align="center">
      <h1>MY BOOK LIST</h1>
      <h3>Requested Books</h3>
      <div>
        <?php
        include("includes/connection.php");
        $query="SELECT * FROM request WHERE sid='$sid'";
        if($queryres=mysqli_query($con,$query))
        { 
          $count=1;
          $row=mysqli_fetch_row($queryres);
          if($row > 0){
          echo "<table>
          <tr>
          <th>SNo</th>
          <th>Book ID</th>
          <th>Status</th>
          </tr>";
        
          do{
            echo "<tr><td>".$count."</td>";
            echo "<td>$row[1]</td>";
            echo "<td>$row[2]</td></tr>";
            $row=mysqli_fetch_row($queryres);
            $count++;
          }while($row);}else {echo " --------------- No Data Available --------------- ";}
          echo "</table>";
        }
        else
        {
          //echo("Error description: " . mysqli_error($con));
          $_SESSION['errmsg']="Error description: " . mysqli_error($con);
        }
        ?>
      </div>
      <h3>Issued Books</h3>
      <div>
        <?php
        include("includes/connection.php");
        $query="SELECT * FROM issue WHERE sid='$sid'";
        if($queryres=mysqli_query($con,$query))
        { 
          $count=1;
          $row=mysqli_fetch_row($queryres);
          if($row > 0 ){
          echo "<table>
          <tr>
          <th>SNo</th>
          <th>Student ID</th>
          <th>Book ID</th>
          <th>Issue Date</th>
          <th>Due Date</th>
          <th>Fine Amount</th>
          </tr>";
          
          do{
            echo "<tr><td>".$count."</td>";
            echo "<td>$row[0]</td>";
            echo "<td>$row[1]</td>";
            echo "<td>$row[2]</td>";
            echo "<td>$row[3]</td>";
            echo "<td>$row[4]</td></tr>";
            $row=mysqli_fetch_row($queryres);
            $count++;
          }while($row); }else{echo " --------------- No Data Available --------------- ";}
          echo "</table>";
        }
        else
        {
          //echo("Error description: " . mysqli_error($con));
          $_SESSION['errmsg']="Error description: " . mysqli_error($con);
        }
        ?>
      </div>
    </div>
  </section>

</body>
</html>