<!DOCTYPE html>
<html>
<head>
  <title>Admin | Book Detail</title>
  <link rel="stylesheet" type="text/css" href="Static/admin.css">
  <link rel="stylesheet" type="text/css" href="Static/popup.css">
  <link rel="stylesheet" href="https://use.typekit.net/wqe7gdm.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
      <a href="stu_reg.php" class="menu-items">User Registered</a>
      <a href="logout.php" class="menu-items">Logout</a>
    </nav>
  </section>
  <section class="menu-content">
    <div align="center">
      <div>
      <h1>Books Requested By User</h1>
      <div class="result" style="color:red;padding: 10px;"></div>
      <div id="tblbookdetail">
        <?php
        include("includes/connection.php");

        $select =mysqli_query($con,"SELECT * FROM request");
        ?>
        <table align="center" cellpadding="10" border="1" id="user_table">
        <tr>
        <th>User ID</th>
        <th>Book ID</th>
        <th>Status</th>
        </tr>
        <?php
        while ($row=mysqli_fetch_array($select)) 
        {
         ?>
         <tr>
          <td><?php echo $row['sid'];?></td>
          <td><?php echo $row['bid'];?></td>
          <td><?php echo $row['status'];?></td>
         </tr>
         <?php
        }
        if($row<0){echo " --------------- No Data Available --------------- ";}
        ?>
        </table>
      </div>
      </div>
    </div>
  </section>
<script>
/*function IssueBook(clicked_id)
{
  var bookid=clicked_id;
  var mydata="bookid="+bookid;
  $.ajax({
      type: "GET",
      url: 'backend_issue.php',
      data: mydata,
      success: function(data){
          $(".result").html(data); 
      }
  });
}*/
</script>
  <!--<footer>
    <h3 class="footer">Copyright &copy; 2019, MK Preethi of Stella Maris College II MSc IT</h3> 
  </footer>-->
</body>
</html>