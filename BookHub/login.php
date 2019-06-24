<?php
session_start();
error_reporting(0);
if(isset($_GET['submit']))
{
  $name=$_GET['name'];
  $pwd=$_GET['pwd'];
  $mail=$_GET['name'];
  if($name=="admin" && $pwd=="admin123")
  {
    $extra="admin/stu_reg.php";
    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
    header("location:http://$host$uri/$extra");
    exit();
  }
  else
  {
    include("includes/connection.php");
    $query="SELECT sid,name,mail,password from register WHERE name='$name' OR mail='$mail'";
    if($result = mysqli_query($con, $query))
    {
      if (mysqli_num_rows($result) > 0) 
      {
        while($row = mysqli_fetch_assoc($result)) 
        {
          //echo ($row["mail"]."<br>");
          //echo ($row["password"]);
          if($name==$row["name"] || $mail==$row["mail"])
          {
            if($pwd==$row["password"])
            {
              $extra="user/chpwd.php";
              $host  = $_SERVER['HTTP_HOST'];
              $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
              $_SESSION['sid']=$row['sid'];
              $_SESSION['sname']=$row['name'];
              header("location:http://$host$uri/$extra");
              exit(); 
            }
            else
            {
              $_SESSION['errmsg']="Invalid Password !!";
            }
          }
          else
          {
            $_SESSION['errmsg']="Invalid Username !!";
          }
        }
      } 
      else 
      {
        //echo "<br><div class='failmsg'>NO SUCH USER<br>PLEASE GO REGISTERED!!</div>";
        $_SESSION['errmsg']="No Such User..Please Go and Register!!";

      }
    }
    else
    {
      //echo("Error description: " . mysqli_error($con));
      $_SESSION['errmsg']="Error description: " . mysqli_error($con);
    }
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="Static/loginstyle.css">
  <link rel="stylesheet" href="https://use.typekit.net/wqe7gdm.css">
  <title>Login</title>
</head>
<body>
  <div class="split left">
    <div>
      <img class="my_img" src="Images/b1.jpg" alt="background image">
    </div>
  </div>

  <div class="split right">
    <ul class="split-right-menu">
      <li><a href="index.html">Home</a></li>
      <li><a href="aboutus.html">About Us</a></li>
      <li><a href="login.php">Login</a></li>
      <li><a href="signup.php">Sign up</a></li>
      <li><a href="contactus.html">Contact Us</a></li>
    </ul>
    <div class="centered">
      <form method="GET" novalidate>
        <table>
          <tr>
            <td><h1 align="center"><b>LOGIN</b></h1></td>
          </tr>
          <tr>
            <td><input type="text" id="name" name="name" placeholder="Name" required><br><span id="err1"></span></td>
          </tr>
          <tr>
            <td><input type="password" id="pwd" name="pwd" placeholder="Password" required><br><span id="err2"></span></td>
          </tr>
          <!--<tr>
            <td align="right"><a href="#">* Forgot Password</a></td>
          </tr>-->
          <tr>
            <td>
              <input type="submit" id="submit" name="submit" value="Submit">
            </td>
          </tr>
        </table>
    </form>
    </div>
    <div align="center"><br>
      <span class="errmsg" >
        <?php echo htmlentities($_SESSION['errmsg']); ?>  
        <?php echo htmlentities($_SESSION['errmsg']="");?>
        </span>
    </div>
  </div>
  <script type="text/javascript">
    var btn=document.getElementById("submit");
    btn.onclick=function(e){
      var bool=validation();
      if(!bool){
        e.preventDefault();
      }
    }
    function validation(){
      var v_name=false;
      var v_pwd=false;
      var name=document.getElementById("name");
      if(name.validity.valueMissing){
        document.getElementById("err1").innerHTML="* Please fill out this field";
      }
      else{
          document.getElementById("err1").innerHTML=" ";
            v_name=true;
        }
        var pwd=document.getElementById("pwd");
      if(pwd.validity.valueMissing){
        document.getElementById("err2").innerHTML="* Please fill out this field";
      }
      else{
        document.getElementById("err2").innerHTML=" ";
        v_pwd=true;
      }
        if(!v_name || !v_pwd){
            return false;    
        }
        else{
           return true;
        }
    }
  </script>
</body>
</html> 
