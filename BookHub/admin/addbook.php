<?php
session_start();
error_reporting(0);
include("includes/connection.php");
if(isset($_GET['submit']))
{
  $bid=$_GET["bid"];
  $category=$_GET["category"];
  $author=$_GET["bauthor"];
  $name=$_GET["bname"];
  $query="INSERT INTO book (bid,category,author,name) VALUES ('$bid','$category','$author','$name')";
  if(mysqli_query($con,$query))
  {
    //echo "Affected rows: " . mysqli_affected_rows($con);  
    if(mysqli_affected_rows($con)>0)
    {
      //echo "<br><div class='successmsg'>SUCCESSFULLY REGISTERED!!</div>";
      $_SESSION['errmsg']="Successfully Added!!";
    }
  }
  else
  {
    //echo("Error description: " . mysqli_error($con));     
    $_SESSION['errmsg']="Error description: " . mysqli_error($con);
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin | Add Book</title>
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
<!--  	<div align="center">
  		<h1>ADD</h1>
  		<form>
  		<select id="select_add" name="select_add" style="width: 15%">
  			<option value="none">---- Please Select ----</option>
            <option value="addcategory">Category</option>
            <option value="addbook">Book</option>
  		</select>
  	</form>
  	</div>
  	<script>
  		var select_add=document.getElementById("select_add");
        if(select_add.value == "none")
        {
        	document.getElementById('addcategory').style.display='none';
        	document.getElementById('addbook').style.display='none';
        }
        if(select_add.value == "addbook"){
           document.getElementById('addbook').style.display='block';
           document.getElementById('addcategory').style.display='none';
        }
        if(select_add.value == "addcategory"){
           document.getElementById('addcategory').style.display='block';
           document.getElementById('addbook').style.display='none';
        }
  	</script>
  	<div id="addcategory" align="center">
  		<h1>ADD CATEGORY</h1>
  		<form novalidate method="get">
  			<label>Category</label>
  			<input type="text" name="category" id="category" required style="width: 15%">
  			<input type="submit" name="btnadd" value="ADD" id="add">
  		</form>
  	</div> --->
    <div align="center" id="addbook">
      <h1>ADD BOOKS</h1>
      <form novalidate method="GET">
      <table>
      	<?php 
      		$select = mysqli_query($con, "SELECT MAX( bid ) AS max FROM book" );
			$row = mysqli_fetch_array( $select );
			$newbookid = $row['max']+1;
			//echo "NEW BOOK ID ".$newbookid;
      	?>
        <tr>
          <td>Category</td>
          <td><select id="category" name="category" required>
            <option value="none">---- Please Select ----</option>
            <option value="cs">Computer Science</option>
            <option value="genderal">Genderal Knowledge</option>
            <option value="app">Other Skills</option> 
          </select></td>
        </tr>
        <tr><td></td><td><span id="add_err1"></span></td></tr>
        <tr>
          <td>Book ID</td>
          <td><input type="text" id="bid" name="bid" value="<?php echo $newbookid; ?>" readonly></td>
          <!--<td><input type="button" name="random" value="Generate ID"></td>-->
        </tr>
        <tr><td></td><td><span id="add_err2"></span></td></tr>
        <tr>
          <td>Author Name</td>
          <td><input type="text" id="bauthor" name="bauthor" required></td>
        </tr>
        <tr><td></td><td><span id="add_err3"></span></td></tr>
        <tr>
          <td>Book Name</td>
          <td><input type="text" id="bname" name="bname" required></td>
        </tr>
        <tr><td></td><td><span id="add_err4"></span></td></tr>
      </table>
      <p style="padding-right: 100px;">
        <input type="submit" id="btnadd" name="submit" value="ADD">
      </p>
      <div align="center">
        <span class="errmsg" >
          <?php echo htmlentities($_SESSION['errmsg']); ?>  
          <?php echo htmlentities($_SESSION['errmsg']="");?>
          </span>
        </div>
      </form>
      <script type="text/javascript">
        var btnadd=document.getElementById("btnadd");
        btnadd.onclick=function(e){
          var bool=add_book_validate();
          if(!bool){e.preventDefault();}
        }
        function add_book_validate(){
          var v_cat=false;
          //var v_bid=false;
          var v_author=false;
          var v_bname=false;

          var category=document.getElementById("category");
          if(category.value == "none"){
            document.getElementById("add_err1").innerHTML="Please select the category";
          }
          else{
            document.getElementById("add_err1").innerHTML=" ";  
            v_cat=true;
          }
          /*var bid=document.getElementById("bid");
          if(bid.validity.valueMissing){
            document.getElementById("add_err2").innerHTML=bid.validationMessage;
          }
          else{
           document.getElementById("add_err2").innerHTML="";
           v_bid=true; 
          }*/
          var bauthor=document.getElementById("bauthor");
          if(bauthor.validity.valueMissing){
            document.getElementById("add_err3").innerHTML=bauthor.validationMessage;
          }
          else{
           document.getElementById("add_err3").innerHTML="";
           v_author=true; 
          }
          var bname=document.getElementById("bname");
          if(bname.validity.valueMissing){
            document.getElementById("add_err4").innerHTML=bname.validationMessage;
          }
          else{
           document.getElementById("add_err4").innerHTML="";
           v_bname=true; 
          }
          if(!v_cat || !v_author || !v_bname){return false;}
          else{return true;}
        }
      </script>
    </div>
  </section>
  <!--<footer>
    <h3 class="footer">Copyright &copy; 2019, MK Preethi of Stella Maris College II MSc IT</h3> 
  </footer>-->

</body>
</html>