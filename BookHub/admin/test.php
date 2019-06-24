<?php
    /*$issue_date = date('d-m-Y');
    $due_date = date('d-m-Y', strtotime($issue_date. ' + 7 days'));
    echo $issue_date ." ".$due_date;

    //$date1 = "2019-03-09";//new DateTime("May 3, 2012 10:38:22 GMT");
	//$date2 = "2019-03-02"//new DateTime("06 Apr 2012 07:22:21 GMT");
	$start_ts = strtotime($issue_date);
	$end_ts = strtotime($due_date);
	$difference = $end_ts - $start_ts;
	echo "<br>days: ". round($difference / 86400);


	$currdate=strtotime(date('d-m-Y'));
	$due_date=strtotime(date('d-m-Y', strtotime($issue_date.' + 2 days')));
    $difference=$currdate-$due_date;
    $days=round($difference / 86400);
    $fineamt=$days * 2 ;
    echo '<br>Current date '.$currdate.' Due Date '.$due_date;
    if($days < 0)
    {
    	echo 'No fine amt';	
    	echo '<br>No of days: '.$days.' fine amt: '.$fineamt;
    }
    else
    {
    	echo '<br>No of days: '.$days.' fine amt: '.$fineamt;
    }*/
    include("includes/connection.php");
    $select = mysqli_query($con, "SELECT MAX( bid ) AS max FROM book" );
            $row = mysqli_fetch_array( $select );
            $newbookid = $row['max'];
            echo "NEW BOOK ID ".$newbookid;
?>