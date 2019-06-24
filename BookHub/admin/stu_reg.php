<!DOCTYPE html>
<html>
<head>
  <title>Admin | Student Registered</title>
  <link rel="stylesheet" type="text/css" href="Static/admin.css">
  <link rel="stylesheet" href="https://use.typekit.net/wqe7gdm.css">
  <style type="text/css">
    table{
      border-collapse: collapse; 
      width:50%;
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
</head>
<body>
  <header>
  <img src="Images/logo5.png" height="5%" width="10%"> 
  </header>

  <section class="menu">
    <nav>
      <a href="addbook.php" class="menu-items">Add</a>
      <a href="issue.php" class="menu-items">Issue</a>
      <a href="return.php" class="menu-items">Return</a>
      <a href="bookdetail.php" class="menu-items">Book Depository</a>
      <a href="bookrequested.php" class="menu-items">Books Requested</a>
      <a href="books_issued.php" class="menu-items">Books Issued</a>
      <a href="stu_reg.php" class="menu-items">Students Registered</a>
      <a href="logout.php" class="menu-items">Logout</a>
    </nav>
  </section>

  <section class="menu-content">
    <div align="center">
      <h1>Students Registered</h1>
      <div>
        <?php
        include("includes/connection.php");
        $query="SELECT * FROM register";
        if($queryres=mysqli_query($con,$query))
        { 
          $count=1;
          echo "<table>
          <tr>
          <th>SNo</th>
          <th>Name</th>
          <th>Email ID</th>
          <th>Phone Number</th>
          </tr>";
          $row=mysqli_fetch_row($queryres);
          do{
            echo "<tr><td>".$count."</td>";
            echo "<td>$row[0]</td>";
            echo "<td>$row[1]</td>";
            echo "<td>$row[2]</td></tr>";
            $row=mysqli_fetch_row($queryres);
            $count++;
          }while($row);
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
  <!--<footer>
    <h3 class="footer">Copyright &copy; 2019, MK Preethi of Stella Maris College II MSc IT</h3> 
  </footer>-->

</body>
</html>