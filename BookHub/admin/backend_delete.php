<?php

if(isset($_GET['bookid']))
{
	$bookid = $_GET['bookid'];
	include("includes/connection.php");
	$delete = "DELETE FROM book WHERE bid='$bookid'";
	if(mysqli_query($con,$delete)){
		echo "Successfully Deleted!!";
	}
	else{
		echo "Error updating record: " . mysqli_error($con);
	}
}

?>