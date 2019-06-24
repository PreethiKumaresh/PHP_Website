<?php
session_start();
if(isset($_GET['submit']))
{
  $sid=$_GET['sid'];
  $bid=$_GET['bid'];
  $issue_date = date('Y-m-d');
  $due_date = date('Y-m-d', strtotime($issue_date. ' + 7 days'));
  include("includes/connection.php");
  $query="INSERT INTO issue (sid,bid,issue_date,due_date) VALUES ('$sid','$bid','$issue_date','$due_date')";
  if(mysqli_query($con,$query))
  {
    //echo "Affected rows: " . mysqli_affected_rows($con);  
    if(mysqli_affected_rows($con)>0)
    {
      //echo "<br><div class='successmsg'>SUCCESSFULLY REGISTERED!!</div>";
      $_SESSION['errmsg']="Successfully Issued!!";
      $update="UPDATE book SET status=0 WHERE bid='$bid'";
      if (mysqli_query($con, $update)) {
      echo "Successfully Updated!!";
   } else {
      echo "Error updating record: " . mysqli_error($con);
   }
    }
  }
  else
  {
    //echo("Error description: " . mysqli_error($con));
    //echo "<br><div class='failmsg'>EMAIL IS ALREADY IN USE!!</div>";
    $_SESSION['errmsg']="Error description: " . mysqli_error($con);
  }

  //delete ones requested
  $delete="DELETE FROM request  WHERE sid='$sid' AND bid='$bid'";
  if (mysqli_query($con, $delete)) {
      //echo "Successfully Updated!!";
      //$_SESSION['errmsg']="Successfully Updated!!";
   } else {
      echo "Error updating record: " . mysqli_error($con);
      //$_SESSION['errmsg']="Error updating record: " . mysqli_error($con);
   }

//displaying the name of student and book
  $select_stuname="SELECT name from register WHERE sid='$sid'";
  $select_bname="SELECT name from book WHERE bid='$bid'";
  $res_stuname=mysqli_query($con,$select_stuname);
  while($row1 = mysqli_fetch_assoc($res_stuname)) 
  {
    $stuname=$row1["name"];
  }
  $res_bookname=mysqli_query($con,$select_bname);
  while($row2 = mysqli_fetch_assoc($res_bookname)) 
  {
    $bookname=$row2["name"];
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin | Issue Book</title>
  <link rel="stylesheet" type="text/css" href="Static/admin.css">
  <link rel="stylesheet" href="https://use.typekit.net/wqe7gdm.css">
  <style type="text/css">
    .table_info td{
      text-align: right;
      padding: 10px;
    }
    .table_info{
      width: 50%;
    }

  </style>
</head>
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
      <h1>ISSUE BOOK</h1>
      <form id="f2" novalidate>
      <table>
        <tr>
          <td>Student ID</td>
          <td><input type="text" id="sid" name="sid" required></td>
        </tr>
        <tr><td></td><td><span id="issue_err1"></span></td></tr>
        <tr>
          <td>Book ID</td>
          <td><input type="text" id="bid" name="bid" required></td>
        </tr>
        <tr><td></td><td><span id="issue_err2"></span></td></tr>
      </table>
      <input type="submit" id="btnissue"name="submit" value="ISSUE" onclick="display();"><br>
      </form>
      <br>
      <span class="errmsg">
        <?php echo htmlentities($_SESSION['errmsg']); ?>  
        <?php echo htmlentities($_SESSION['errmsg']="");?>
      </span>
      <script type="text/javascript">
        var btnissue=document.getElementById("btnissue");
        btnissue.onclick=function(e){
          var bool=issue_book_validate();
          if(!bool){e.preventDefault();}
        }
        function issue_book_validate(){
          var v_sid=false;
          var v_bid=false;
          var sid=document.getElementById("sid");
          if(sid.validity.valueMissing){
            document.getElementById("issue_err1").innerHTML=sid.validationMessage;
          }
          else{
           document.getElementById("issue_err1").innerHTML=" "; 
           v_sid=true;
          }
          var bid=document.getElementById("bid");
          if(bid.validity.valueMissing){
            document.getElementById("issue_err2").innerHTML=bid.validationMessage;
          }
          else{
           document.getElementById("issue_err2").innerHTML=" ";
           v_bid=true; 
          }
          if(!v_sid || !v_bid)
          {
            return false;
          }
          else
          {
            return true;
          }
        }
      </script>
    </div>
    <?php if(isset($_GET['submit'])){ ?>
    <div align="center">
      <h3> -------------------------------------- Issued Information -------------------------------------- </h3>
      <table class="table_info">
      <tr>
        <td><b>Student ID: </b></td>
        <td><?php echo $sid; ?></td>
        <td></td>
        <td><b>Student Name:</b> </td>
        <td><?php echo $stuname; ?></td>
      </tr>
      <tr>
        <td><b>Book ID: </b></td>
        <td><?php echo $bid; ?></td>
        <td></td>
        <td><b>Book Name: </b></td>
        <td><?php echo $bookname; ?></td>
      </tr>
      <tr>
        <td><b>Issued Date: </b></td>
        <td><?php echo $issue_date; ?></td>
        <td></td>
        <td><b>Due Date: </b></td>
        <td><?php echo $due_date; ?></td>
      </tr>
      </table>
    </div>
  <?php }?>
  </section>
  <!--<footer>
    <h3 class="footer">Copyright &copy; 2019, MK Preethi of Stella Maris College II MSc IT</h3> 
  </footer>-->

</body>
</html>