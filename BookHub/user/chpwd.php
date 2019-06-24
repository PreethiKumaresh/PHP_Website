<?php
session_start();
//error_reporting(0);
if(isset($_GET['submit']))
{
  $currpwd=$_GET['currpwd'];
  $chpwd=$_GET['pwd1'];
  $sid=$_SESSION['sid'];
  include("includes/connection.php");
  //get the username from session 
    $query="SELECT password from register WHERE sid='$sid'";
    if($result = mysqli_query($con, $query))
    {
      if (mysqli_num_rows($result) > 0) 
      {
        while($row = mysqli_fetch_assoc($result)) 
        {
          if($currpwd==$row['password'])
          {
            $update = "UPDATE register SET password='$chpwd' WHERE sid='$sid'";
            if (mysqli_query($con, $update)) {
                //echo "Successfully Updated!!";
                $_SESSION['errmsg']="Successfully Updated!!";
             } 
          }
          else
          {
            $_SESSION['errmsg']="Sorry!! Current Password does not match!!";
          } 
        }
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
  <title>User | Change Password</title>
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
      <h1>Change password</h1>
      <form method="GET" novalidate>
      <table>
        <tr>
          <td>Current Password</td>
          <td><input type="password" id="currpwd" name="currpwd" required></td>
        </tr>
        <tr><td></td><td><span id="chpwd_err1"></span></td></tr>
        <tr>
          <td>Change Password</td>
          <td><input type="password" id="pwd1" name="pwd1" required></td>
        </tr>
        <tr><td></td><td><span id="chpwd_err2"></span></td></tr>
        <tr>
          <td>Confirm Password</td>
          <td><input type="password" id="pwd2" name="pwd2" required></td>
        </tr>
        <tr><td></td><td><span id="chpwd_err3"></span></td></tr>
      </table>
      <input type="submit" id="btnChPwd" name="submit" value="SUBMIT"><br>
      </form>
      <br><br>
      <span class="errmsg" ><b>
        <?php echo htmlentities($_SESSION['errmsg']); ?>  
        <?php echo htmlentities($_SESSION['errmsg']="");?></b>
        </span>
      <script type="text/javascript">
        var btnChPwd=document.getElementById("btnChPwd");
        btnChPwd.onclick=function(e){
          var bool=changepwd_validate();
          if(!bool){
            e.preventDefault();
          }
        }
        function changepwd_validate(){
          var currpwd=document.getElementById("currpwd");
          var pwd1=document.getElementById("pwd1");
          var pwd2=document.getElementById("pwd2");
          var v_pwd1=false;
          var v_pwd2=false;
          var v_currpwd=false;
          if(currpwd.validity.valueMissing){
            document.getElementById("chpwd_err1").innerHTML=currpwd.validationMessage;
          }
          else{
            document.getElementById("chpwd_err1").innerHTML=" ";
            v_currpwd=true;
          }
          if(pwd1.validity.valueMissing){
            document.getElementById("chpwd_err2").innerHTML=pwd1.validationMessage;
          }
          else{
            document.getElementById("chpwd_err2").innerHTML=" ";
            v_pwd1=true;
          }
          if(pwd2.validity.valueMissing){
            document.getElementById("chpwd_err3").innerHTML=pwd2.validationMessage;
          }
          else{
            document.getElementById("chpwd_err3").innerHTML=" ";
            v_pwd2=true;
          }
          if(pwd1.value != pwd2.value)
          {
          document.getElementById("chpwd_err3").innerHTML="Password Not Equal";
          v_pwd2=false;
          }
          if(!v_pwd1 || !v_pwd1 || !v_currpwd)
          {
            return false;
          }
          else{
            return true;
          }
        }
      </script>
    </div>
  </section>
  <!--<footer>
    <h3 class="footer">Copyright &copy; 2019, MK Preethi of Stella Maris College II MSc IT</h3> 
  </footer>-->

</body>
</html>