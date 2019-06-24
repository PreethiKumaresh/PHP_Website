<?php
session_start();
if(isset($_GET['save']))
{
	$bid=$_GET['bid'];
	$category=$_GET['category'];
	$author=$_GET['author'];
	$bname=$_GET['bname'];
	$status=$_GET['status'];

	include 'includes/connection.php';
	$update = "UPDATE book SET category='$category' , author='$author' , name='$bname' WHERE bid='$bid'";
	if (mysqli_query($con, $update)) {
      //echo "Successfully Updated!!";
      $_SESSION['errmsg']="Successfully Updated!!";
   } else {
      echo "Error updating record: " . mysqli_error($con);
      $_SESSION['errmsg']="Error updating record: " . mysqli_error($con);
   }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>TEST POPUP</title>
	<link rel="stylesheet" type="text/css" href="static/popup.css">
	<style type="text/css">
		.errmsg{
			color: red;
			padding: 5px;
		}
	</style>

</head>
<body>
<div id="id01" class="modal">
    <span onclick="exit();" class="close" title="Close">&times;</span>
    <form class="modal-content" method="GET">
      <div class="container">
        <h2>Book Information</h2>
        <p>Please provide changes if needed.</p>
        <hr>
        <span class="errmsg" >
        <?php echo htmlentities($_SESSION['errmsg']); ?>  
        <?php echo htmlentities($_SESSION['errmsg']="");?>
        </span>
        <?php
        if(isset($_GET['bookid']))
        {
        	$bookid=$_GET['bookid'];
	        include('includes/connection.php'); 
	        $query="SELECT * FROM book WHERE bid='$bookid'";
	        if($res=mysqli_query($con,$query))
	        {
	          while($row=mysqli_fetch_array($res))
	          {
	            //echo $row['name'] ."<br>";
	        ?>
	        <label><b>Book ID</b></label>
	        <input type="text" id="bid" name="bid" value="<?php echo $row['bid'] ?>" readonly>
	        <label><b>Category</b></label>
	        <input type="text" id="category" name="category" value="<?php echo $row['category'] ?>">
	        <label><b>Author</b></label>
	        <input type="text" id="author" name="author" value="<?php echo $row['author'] ?>">
	        <label><b>Book Name</b></label>
	        <input type="text" id="bname" name="bname" value="<?php echo $row['name'] ?>">
	        <label><b>Availability</b></label>
	        <input type="text" id="status" name="status" value="<?php echo $row['status'] ?>" readonly>
	        
	    <?php    }
	        }
	        else
	        {
	          echo("Error description: " . mysqli_error($res));
	        } 
	    } ?>

        <div class="clearfix">
          <button type="button" onclick="exit();" class="cancelbtn">Cancel</button>
          <button type="submit" class="signupbtn" name="save" value="save" onclick="save();">Save</button>
        </div>
      </div>
    </form>
  </div>

<script type="text/javascript">
function PopUp(){
	document.getElementById('id01').style.display='block';
}
window.onload = function () {
    setTimeout(function () {
        PopUp('show');
    },500);
}

function exit(){
	document.getElementById('id01').style.display='none';
	window.location.href = "bookdetail.php";
}

function save(){
	document.getElementById('id02').style.display='block';
}
</script>
</body>
</html>