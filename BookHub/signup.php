<?php
session_start();
error_reporting(0);
include("includes/connection.php");
if(isset($_GET['submit']))
{
  $name = $_GET['name'];
  $mail = $_GET['mail'];
  $mobnum = $_GET['phone'];
  $pwd = $_GET['pwd1'];

  //check if mail and name already present
  $query="SELECT name,mail from register WHERE name='$name' OR mail='$mail'";
  if($result = mysqli_query($con, $query))
  {
    if (mysqli_num_rows($result) > 0) 
    {
      while($row = mysqli_fetch_assoc($result)) 
      {
        if($name==$row["name"])
        {
          $_SESSION['errmsg_name']="Name is already in use!!";
        }
        if($mail==$row["mail"])
        {
          $_SESSION['errmsg_mail']="Email ID is already in use!!";
        }
      }
    }
    else
    {//insert
    $query="INSERT INTO register (name,mail,phoneno,password) VALUES ('$name','$mail','$mobnum','$pwd')";
        if(mysqli_query($con,$query))
        {
          echo "Affected rows: " . mysqli_affected_rows($con);  
          if(mysqli_affected_rows($con)>0)
          {
            //echo "<br><div class='successmsg'>SUCCESSFULLY REGISTERED!!</div>";
            $extra="login.php";
            $host  = $_SERVER['HTTP_HOST'];
            $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
            header("location:http://$host$uri/$extra");
            $_SESSION['errmsg']="Successfully Registered!!";
            exit();
          }
        }
        else
        {
          //echo("Error description: " . mysqli_error($con));
          //echo "<br><div class='failmsg'>EMAIL IS ALREADY IN USE!!</div>";
          $_SESSION['errmsg']="Insert-Error description: " . mysqli_error($con);
        }
      }
    }
    else
    {
      //echo("Error description: " . mysqli_error($con));
      $_SESSION['errmsg']="Select-Error description: " . mysqli_error($con);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="Static/loginstyle.css">
<link rel="stylesheet" href="https://use.typekit.net/wqe7gdm.css">
<title>Sign Up</title>
</head>
<body>
  <div class="split left">
    <div>
      <img id="bgimage" class="my_img" src="Images/b1.jpg" alt="background image">
    </div>
  </div>

  <div class="split right">
    <div align="right">
      <ul class="split-right-menu">
      <li><a href="index.html" style="margin-right: 40px;">Back</a></li>
      </ul>
    </div>
    <div class="centered">
      <form novalidate method="GET">
        <table>
          <tr>
            <td><h1 align="center"><b>SIGN UP</b></h1></td>
          </tr>
          <tr>
            <td><input type="text" id="name" name="name" placeholder="Name" pattern="^[a-zA-Z]+$" required></td>
          </tr>
          <tr><td id="err1"></td></tr>
          <tr>
            <td><input type="email" id="mail" name="mail" placeholder="E-mail" required></td>
          </tr>
          <tr><td id="err2"></td></tr>
          <tr>
            <td><input type="text" id="mobno" name="phone" placeholder="Phone" pattern="^[0-9]{10}$" required></td>
          </tr>
          <tr><td id="err3"></td></tr>
          <tr>
            <td><input type="password" id="pwd1" name="pwd1" placeholder="Password" required></td>
          </tr>
          <tr><td id="err4"></td></tr>
          <tr>
            <td><input type="password" id="pwd2" name="pwd2" placeholder="Confirm Password" required></td>
          </tr>
          <tr><td id="err5"></td></tr>
          <tr>
            <td>
              <input type="submit" id="submit" name="submit" value="Submit">
            </td>
          </tr>
          <tr>
            <td align="center">
              <span class="errmsg" >
              <?php 
              if(isset($_GET['submit'])){
                  echo htmlentities($_SESSION['errmsg']);
                  echo htmlentities($_SESSION['errmsg']="");
                  echo htmlentities($_SESSION['errmsg_name'])."<br>";
                  echo htmlentities($_SESSION['errmsg_name']="");
                  echo htmlentities($_SESSION['errmsg_mail']);
                  echo htmlentities($_SESSION['errmsg_mail']="");
                }
             ?>
            </span> 
            </td>
          </tr>  
        </table>
    </form>
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
      var v_mail=false;
      var v_mobno=false;
      var v_pwd=false;

      var name=document.getElementById("name");
      if(name.validity.valueMissing){
        document.getElementById("err1").innerHTML="<span>* Please fill out this field</span>";
      }
      else if(name.validity.patternMismatch){
        document.getElementById("err1").innerHTML="<span>* Accepts Only Alphabets</span>";
      }
      else{
        document.getElementById("err1").innerHTML=" ";
        v_name=true;
      }

      var mail=document.getElementById("mail");
      if(mail.validity.valueMissing){
        document.getElementById("err2").innerHTML="<span>* Please fill out this field</span>";
      }
      else if(mail.validity.patternMismatch){
        document.getElementById("err2").innerHTML="<span>* Invalid E-mail</span>";
      }
      else{
       document.getElementById("err2").innerHTML=" ";
        v_mail=true; 
      }

      var mobno=document.getElementById("mobno");
      if(mobno.validity.valueMissing){
        document.getElementById("err3").innerHTML="<span>* Please fill out this field</span>";
      }
      else if(mobno.validity.patternMismatch){
        document.getElementById("err3").innerHTML="<span>* Accepts Only 10 digit</span>";
      }
      else{
        document.getElementById("err3").innerHTML=" ";  
        v_mobno=true;
      }
      var pwd1=document.getElementById("pwd1");
      var pwd2=document.getElementById("pwd2");
      if(pwd1.validity.valueMissing)
      {
        document.getElementById("err4").innerHTML="<span>* Please fill out this field</span>";
      }
      else{
        document.getElementById("err4").innerHTML=" "; 
        v_pwd=true;
      }
      if(pwd2.validity.valueMissing)
      {
        document.getElementById("err5").innerHTML="<span>* Please fill out this field</span>";
      }
      else{
        document.getElementById("err5").innerHTML=" ";
        v_pwd=true;
      }
      if(pwd1.value != pwd2.value)
      {
        document.getElementById("err5").innerHTML="<span>* Password does not match</span>";
        v_pwd=false;
      }
      if(!v_name || !v_mail || !v_mobno || !v_pwd)
      {
        return false;
      }
      else
      {
        return true;
      }
    }
  </script>
</body>
</html> 
