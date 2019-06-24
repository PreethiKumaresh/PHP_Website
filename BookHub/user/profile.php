<?php
session_start();
if(isset($_GET['update']))
{
  $sid=$_SESSION['sid'];
  $name=$_GET['sname'];
  $mail=$_GET['mail'];
  $pno=$_GET['pno'];
  
  include 'includes/connection.php';
  $update = "UPDATE register SET name='$name' , mail='$mail' , phoneno='$pno' WHERE sid='$sid'";
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
	<title>Online Book Hub</title>
	<link rel="stylesheet" type="text/css" href="Static/admin.css">
	<link rel="stylesheet" href="https://use.typekit.net/wqe7gdm.css">
</head>
<body>
	<header>
    <img src="Images/logo5.png" height="60px" >
    <h3 align="right" style="color: white; position: absolute; top:0px;right: 10px;">Welcome <?php echo $_SESSION['sname'];?></h3>
  </header>

	<section class="menu">
    <nav>
      <a href="profile.php" class="menu-items">My Profile</a>
      <a href="viewbook.php" class="menu-items">View Books</a>
      <a href="booksissued.php" class="menu-items">My Book List</a>
      <!--<a href="buybook.php" class="menu-items"> E-Book</a>-->
      <a href="chpwd.php" class="menu-items">Change Password</a>
      <a href="logout.php" class="menu-items">Logout</a>
    </nav>
  </section>
  <section class="menu-content">
  	<div align="center">
      <?php 
      if(isset($_SESSION['sid']))
        {
          $sid=$_SESSION['sid'];
          include('includes/connection.php'); 
          $query="SELECT * FROM register WHERE sid='$sid'";
          if($res=mysqli_query($con,$query))
          {
            while($row=mysqli_fetch_array($res))
            {
              //echo $row['name'] ."<br>";
          ?>
      <h1>MY PROFILE</h1>
      <form method="get" novalidate>
      <table>
        <tr>
          <td>User ID</td>
          <td><input type="text" id="sid" name="sid" value="<?php echo $row['sid'] ?>" readonly></td>
        </tr>
        <!--<tr><td></td><td><span id="profile_err1"></span></td></tr>-->
        <tr>
          <td>User Name</td>
          <td><input type="text" id="sname" name="sname" value="<?php echo $row['name'] ?>" required></td>
        </tr>
        <tr><td></td><td><span id="profile_err2"></span></td></tr>
        <tr>
          <td>Email ID</td>
          <td><input type="text" id="mail" name="mail" value="<?php echo $row['mail'] ?>" required></td>
        </tr>
        <tr><td></td><td><span id="profile_err3"></span></td></tr>
        <tr>
          <td>Phone Number</td>
          <td><input type="text" id="pno" name="pno" value="<?php echo $row['phoneno'] ?>" required></td>
        </tr>
        <tr><td></td><td><span id="profile_err4"></span></td></tr>
      </table>
      <input type="submit" id="submit" name="update" value="SUBMIT">
      </form><br>
      <span class="errmsg" >
        <?php echo htmlentities($_SESSION['errmsg']); ?>  
        <?php echo htmlentities($_SESSION['errmsg']="");?>
      </span>
      <?php    }
          }
          else
          {
            echo("Error description: " . mysqli_error($res));
          } 
      } ?>
      <script type="text/javascript">
        var submit=document.getElementById("submit");
        submit.onclick=function(e){
          var bool=Myprofile_validate();
          if(!bool){e.preventDefault();}
        }
        function Myprofile_validate(){
          //var v_sid=false;
          var v_sname=false;
          var v_mail=false;
          var v_phno=false;
          /*var sid=document.getElementById("sid");
          if(sid.validity.valueMissing){
            document.getElementById("profile_err1").innerHTML=sid.validationMessage;
          }
          else{
           document.getElementById("profile_err1").innerHTML="";
           v_sid=true; 
          }*/
          var sname=document.getElementById("sname");
          if(sname.validity.valueMissing){
            document.getElementById("profile_err2").innerHTML=sname.validationMessage;
          }
          else{
           document.getElementById("profile_err2").innerHTML="";
           v_sname=true; 
          }
          var mail=document.getElementById("mail");
          if(mail.validity.valueMissing){
            document.getElementById("profile_err3").innerHTML=mail.validationMessage;
          }
          else{
           document.getElementById("profile_err3").innerHTML="";
           v_mail=true; 
          }
          var pno=document.getElementById("pno");
          if(pno.validity.valueMissing){
            document.getElementById("profile_err4").innerHTML=pno.validationMessage;
          }
          else{
           document.getElementById("profile_err4").innerHTML="";
           v_phno=true; 
          }
          if(!v_sid || !v_sname ||!v_mail || !v_phno)
          {
            return false;
          }
          else{return true;}
        }
      </script>
    </div>
  </section>
</body>
</html>