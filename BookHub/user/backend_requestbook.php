<?php
session_start();
if(isset($_GET['bookid']))
{
	$new=true;
	$bookid = $_GET['bookid'];
	$sid= $_SESSION['sid'];
	include("includes/connection.php");
	$select =mysqli_query($con,"SELECT status FROM book WHERE bid='$bookid'");
	while ($row=mysqli_fetch_array($select)) 
    {
    	if($row['status']==0)
    	{
    		echo "Sorry!! This book is not available now";
    	}
    	else
    	{
    		$select2="SELECT * FROM request WHERE sid='$sid'";
    		if($result = mysqli_query($con, $select2))
    		{if (mysqli_num_rows($result) > 0) 
    			{while($row = mysqli_fetch_assoc($result)){
    				if($row['bid']==$bookid && $row['status']==0)
    				{
    					echo "You have already requeted this book!!";
    					$new=false;
    				}
    			}}
    		}
	    	if($new)
	    	{
		    	$insert="INSERT into request (sid,bid) VALUES ('$sid','$bookid')";
		        if(mysqli_query($con,$insert))
		        {
		          //echo "Affected rows: " . mysqli_affected_rows($con);  
		          if(mysqli_affected_rows($con)>0)
		          {
		          	echo "Thank you!! The Book has been Requested..!!";
		          }
		    	}
	    	}
	    }
	}
}

?>