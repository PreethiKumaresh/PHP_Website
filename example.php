<?php
session_start();
//creating connection obj
$con = mysqli_connect ("localhost","root","","demo");

if (!$con)
{
	die('Could not connect: ' . mysqli_error());
}
if(isset($_GET['submit']))
{
	$id=$_GET['id'];
	$name=$_GET['name'];
	$product=$_GET['product'];
	$cost=$_GET['cost'];
	$qty=$_GET['qty'];
 	$totcost=$_GET['totcost'];
	$insert_sql="INSERT INTO items (id,name,product,cost,qty,totcost) VALUES 
	('$id','$name','$product','$cost','$qty','$totcost')";
	if(mysqli_query($con,$insert_sql)){
		$r=mysqli_affected_rows($con);
		if($r>0){	
			//echo "insert"; 
			$_SESSION['msg']="Successfully Inserted!!";
		}
	}
	else{
		//echo "Error Description".mysqli_error($con);
		 $_SESSION['errmsg']="Error description: " . mysqli_error($con);
	}
}

if(isset($_GET['delete']))
{
	$id=$_GET['id'];
	$delete=mysqli_query($con,"DELETE FROM items WHERE id='$id'");
	$r=mysqli_affected_rows($con);
	if($r>0){
		$_SESSION['msg']="Successfully Deleted!!";
	}
	else{
		$_SESSION['errmsg']="No Such ID!!";
	}
}

if(isset($_GET['update'])){
	$id=$_GET['id1'];
	$name=$_GET['name1'];
 	$update=mysqli_query($con,"UPDATE items SET name='$name' WHERE id='$id'");
 	$r=mysqli_affected_rows($con);
	if($r>0){
		$_SESSION['msg']="Successfully Updated!!";
	}
	else{
		$_SESSION['errmsg']="Error description: " . mysqli_error($con);
	}
}
?>

<html>
<head>
	<title>PHP Basic Example</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header>PHP Basic Example</header>
	<section class="sec1">
		<form class="f1" novalidate>
			<div align="center">
			<table class="tbl1">
				<tr>
					<td><label>ID</label></td>
					<td><input type="text" name="id" id="id" required pattern="[a-zA-Z0-9]*" autocomplete="off" autofocus="on"></td>
					<td><span id="err1"></span></td>
				</tr>
				<tr>
					<td><label>Name</label></td>
					<td><input type="text" name="name" id="name" required pattern="[a-zA-Z]*" autocomplete="off"></td>
					<td><span id="err2"></span></td>
				</tr>
				<tr>
					<td><label>Product List</label></td>
					<td>
						<select name="product" id="product" required  onchange="getcost()">
							<option value="none">--select--</option>
							<option value="soap">Soap</option>
							<option value="sampoo">Sampoo</option>
						</select>
					</td>
					<td><span id="err3"></span></td>
				</tr>
				<tr>
					<td><label>Cost</label></td>
					<td><input type="text" name="cost" id="cost" readonly class="read"></td>
				</tr>
				<tr>
					<td><label>Quantity</label></td>
					<td><input type="number" name="qty" id="qty" min="0" max="20" required oninput="gettotal()"></td>
					<td><span id="err4"></span></td>
				</tr>
				<tr>
					<td><label>Total Cost</label></td>
					<td><input type="text" name="totcost" id="totcost" readonly class="read"></td>
				</tr>
			</table>
			<input type="submit" name="submit" id="submit" value="Submit">
			<input type="button" name="cancel" id="cancel" value="Clear" formnovalidate>
			<input type="submit" name="find" id="find" value="FindByID" formnovalidate>
			<input type="submit" name="delete" id="delete" value="DeleteByID" formnovalidate>
			<input type="submit" name="view" id="view" value="View" formnovalidate>
			<div id="msg">
				<div class="message">
					<?php echo htmlentities($_SESSION['msg']); ?>  
          			<?php echo htmlentities($_SESSION['msg']="");?>
				</div>
				<div class="errmessage" >
					<?php echo htmlentities($_SESSION['errmsg']); ?>  
          			<?php echo htmlentities($_SESSION['errmsg']="");?>
          		</div>
			</div>
		</div>
		</form>
		<script type="text/javascript">

			var id=document.getElementById('id');
			//var name=document.getElementById('name');
			var prd=document.getElementById('product');
			var qty=document.getElementById('qty');

			var cancel=document.getElementById('cancel');
			cancel.onclick=function(e){
				clear();
			}

			function getcost(){
				//alert("getcost");
				//var prd=document.getElementById('product');
				if(prd.value=="soap")
				{
					document.getElementById("cost").value=10;
				}
				else if(prd.value=="sampoo")
				{
					document.getElementById("cost").value=20;
				}
			}

			function gettotal(){
				//alert('gettotal');
				var cost = document.getElementById('cost').value;
				var qty = document.getElementById('qty').value;
				var totcost = parseInt(cost) * parseInt(qty);
				document.getElementById('totcost').value=totcost;
			}

			function clear(){
				//alert("hai");
				document.getElementById('id').value="";
				//document.getElementById('id').autofocus="on";
				document.getElementById('err1').innerHTML="";
				document.getElementById('name').value="";
				document.getElementById('err2').innerHTML="";
				document.getElementById("product").selectedIndex  = 0;
				document.getElementById('err3').innerHTML="";
				document.getElementById('cost').value="";
				document.getElementById('qty').value="";
				document.getElementById('err4').innerHTML="";
				document.getElementById('totcost').value="";
				document.getElementById('viewdiv').innerHTML="";
			}

			var submit=document.getElementById('submit');
			submit.onclick=function(e){
				var bool=validation();
				if(!bool){
					e.preventDefault();
				}
			}

			function validation(){
				//alert('validation');
				var count=1;
				if(id.checkValidity)
				{
					document.getElementById('err1').innerHTML=id.validationMessage;
					if(id.validationMessage.toString().length!=0)count=0;
				}
				var name=document.getElementById('name');
				if(name.checkValidity)
				{
					document.getElementById('err2').innerHTML=name.validationMessage;
					if(name.validationMessage.toString().length!=0)count=0;
				}
				if(prd.value=="none")
				{
					document.getElementById('err3').innerHTML="Please select a value";
					if(prd.validationMessage.toString().length!=0)count=0;
				}
				if(qty.checkValidity)
				{
					document.getElementById('err4').innerHTML=qty.validationMessage;
					if(qty.validationMessage.toString().length!=0)count=0;
				}
				if(count==0)
				{
					return false;
				}
				else{
					return true;
				}
			}

			var find=document.getElementById('find');
			find.onclick=function(e){
				//alert("find fun");
				var bool=IDValidation();
				if(!bool){e.preventDefault();}
			}

			var del=document.getElementById('delete');
			del.onclick=function(e){
				var bool=IDValidation();
				if(!bool){e.preventDefault();}
			}

			function IDValidation(){
				//alert("IDValidation");
				var count=1;
				if(id.checkValidity)
				{
					document.getElementById('err1').innerHTML=id.validationMessage;
					if(id.validationMessage.toString().length!=0)count=0;
				}
				if(count==0)
				{
					return false;
				}
				else{
					return true;
				}
			}
		</script>
	</section>
	<section>
		<div align="center" id="viewdiv">
        <?php
        if(isset($_GET['view'])){
        $select =mysqli_query($con,"SELECT * FROM items");
        ?>
        <table align="center" cellpadding="10" border="1" class="viewtbl">
        <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Product</th>
        <th>Cost</th>
        <th>Quantity</th>
        <th>Total Cost</th>
        </tr>
        <?php
        while ($row=mysqli_fetch_array($select)) 
        {
         ?>
         <tr>
          <td><?php echo $row['id'];?></td>
          <td><?php echo $row['name'];?></td>
          <td><?php echo $row['product'];?></td>
          <td><?php echo $row['cost'];?></td>
          <td><?php echo $row['qty'];?></td>
          <td><?php echo $row['totcost'];?></td>
         </tr>
         <?php
        }
        ?>
        </table>

    <?php } ?>

    <?php
    if(isset($_GET['find']))
    {
    	$id=$_GET['id'];
    	$find=mysqli_query($con,"SELECT * FROM items WHERE id='$id'");
    	$row=mysqli_fetch_array($find);
    	//print_r("ans ".$row);
    	if($row==null){
    		echo "<div class='errmessage'>No such ID!!</div>";
    	}
    	else{
    ?>
    <form>
    <label>ID</label>
    <input type="text" name="id1" value="<?php echo $row['id'] ?>" readonly class="read" >
    <label>Name</label>
    <input type="text" name="name1" value="<?php echo $row['name'] ?>" >
    <label>Cost</label>
    <input type="text" name="cost1" value="<?php echo $row['cost'] ?>" readonly class="read">
    <label>Quantity</label>
    <input type="text" name="qty1" value="<?php echo $row['qty'] ?>" readonly class="read">
    <label>Total Cost</label>
    <input type="text" name="totcost1" value="<?php echo $row['totcost'] ?>" readonly class="read">
    <input type="submit" name="update" id="update" value="Update">
    <form>
    <br><br>
    <?php }
	}
	
    ?>
      </div>
	</section>
	<footer>Done by MK Preethi</footer>
</body>
</html>