<!DOCTYPE html>
<html>
<head>
  <title>Admin | Book Issed</title>
  <link rel="stylesheet" type="text/css" href="Static/admin.css">
  <link rel="stylesheet" href="https://use.typekit.net/wqe7gdm.css">
</head>
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
<body>
  <header>
  <img src="Images/logo5.png" height="5%" width="10%"> 
  <!-- <i class="fa fa-book fa-3x" aria-hidden="true"></i> -->
  </header>

  <section class="menu">
    <nav>
      <a href="addbook.php" class="menu-items">Add</a>
      <a href="issue.php" class="menu-items">Issue</a>
      <a href="return.php" class="menu-items">Return</a>
      <a href="bookdetail.php" class="menu-items">Book Depository</a>
      <a href="bookrequested.php" class="menu-items">Books Requested</a>
      <a href="books_issued.php" class="menu-items">Books Issued</a>
      <a href="stu_reg.php" class="menu-items">Registered User</a>
      <a href="logout.php" class="menu-items">Logout</a>
    </nav>
  </section>

  <section class="menu-content">
    <div align="center">
      <h1>BOOK ISSUED</h1>
      <div>
        <?php
        include("includes/connection.php");
        $query="SELECT * FROM issue";
        if($queryres=mysqli_query($con,$query))
        { 
          $row=mysqli_fetch_row($queryres);
          if($row > 0)
          {
          $count=1;
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
          }while($row);
          }
          else{ echo "<b> --------------- No Data Available --------------- <b>";}
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