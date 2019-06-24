<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Online Book Hub</title>
	<link rel="stylesheet" type="text/css" href="Static/admin.css">
	<link rel="stylesheet" href="https://use.typekit.net/wqe7gdm.css">
  <link rel="stylesheet" type="text/css" href="Static/popup.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<style type="text/css">
    table{
      border-collapse: collapse; 
      width:70%;
      border:1px solid black;
    }
    th{
      background-color: #ffbc4b;
      padding: 10px;
    }
    td{
      padding:10px;
      text-align: center;
    }
  </style>
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
      <div>
      <h1>Book Depository</h1>
      <div class="result" style="color:red;padding: 10px;font-weight: bold;"></div>
      <div id="tblbookdetail">
        <?php
        include("includes/connection.php");

        $select =mysqli_query($con,"SELECT * FROM book");
        ?>
        <table align="center" cellpadding="10" border="1" id="user_table">
        <tr>
        <th>Book ID</th>
        <th>Category</th>
        <th>Author Name</th>
        <th>Book Name</th>
        <th>Availability</th>
        <th>Action</th>
        </tr>
        <?php
        while ($row=mysqli_fetch_array($select)) 
        {
         ?>
         <tr>
          <td><?php echo $row['bid'];?></td>
          <td><?php echo $row['category'];?></td>
          <td><?php echo $row['author'];?></td>
          <td><?php echo $row['name'];?></td>
          <td><?php echo $row['status'];?></td>
          <td><button style="width:auto;" id="<?php echo $row['bid'];?>" 
            onclick="RequestBook(this.id);">Request</button></td>
         </tr>
         <?php
        }
        ?>
        </table>
      </div>
      </div>
    </div>
  </section> 
  <script type="text/javascript">
    function RequestBook(clicked_id)
    {
      var bookid=clicked_id;
      var mydata="bookid="+bookid;
      $.ajax({
          type: "GET",
          url: 'backend_requestbook.php',
          data: mydata,
          success: function(data){
              $(".result").html(data); 
          }
      });
    }
  </script>
</body>
</html>