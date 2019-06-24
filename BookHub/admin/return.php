<?php
session_start();
include("includes/connection.php");
if(isset($_GET['bid']))
{
  $bid=$_GET['bid'];
  $query="SELECT * from issue WHERE bid='$bid'";
  if($result = mysqli_query($con, $query))
  {
    if (mysqli_num_rows($result) > 0) 
    {
      while($row = mysqli_fetch_assoc($result)) 
      {
        $sid=$row['sid'];
        $issue_date=$row['issue_date'];
        $due_date=$row['due_date'];
      }
      $currdate=strtotime(date('Y-m-d'));
      $difference=$currdate-strtotime($due_date);
      $days=round($difference / 86400);
      $fineamt=$days * 2 ;
      if($fineamt < 0 ){$fineamt=0; $days=0;}
    }
  }
  //set available to 1
  $update1="UPDATE book SET status=1 WHERE bid='$bid'";
  if (mysqli_query($con, $update1)) {
      //echo "Successfully Updated!!";
      //$_SESSION['errmsg']="Successfully Updated!!";
   } else {
      echo "Error updating record: " . mysqli_error($con);
      //$_SESSION['errmsg']="Error updating record: " . mysqli_error($con);
   }
  //update fine amt
  $update2="UPDATE issue SET fineamt='$fineamt' WHERE bid='$bid'";
  if (mysqli_query($con, $update2)) {
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
  <title>Admin | Book Return</title>
  <link rel="stylesheet" type="text/css" href="Static/admin.css">
  <link rel="stylesheet" href="https://use.typekit.net/wqe7gdm.css">
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
      <h1>RETURN BOOK</h1>
      <form novalidate method="get">
      <table>
        <tr>
          <td>Book ID</td>
          <td><input type="text" id="bid" name="bid" required></td>
          <tr><td></td><td><span id="return_err1"></span></td></tr>
        </tr>
      </table>
      <input type="submit" id="btnreturn" name="submit" value="RETURN"><br>
      </form>
      <script type="text/javascript">
        var btnreturn=document.getElementById("btnreturn");
        btnreturn.onclick=function(e){
         var bid=document.getElementById("bid");
          if(bid.validity.valueMissing){
            document.getElementById("return_err1").innerHTML=bid.validationMessage;
            e.preventDefault();
          }
          else{
           document.getElementById("return_err1").innerHTML=" ";
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
      <tr>
        <td><b>No of Days: </b></td>
        <td><?php echo $days; ?></td>
        <td></td>
        <td><b>Fine Amount: </b></td>
        <td><?php echo $fineamt; ?></td>
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