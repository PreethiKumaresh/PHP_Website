<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="static/popup.css">
</head>
<body>

<section class="menu-content">
    <div align="center">
      <div>
      <h1>Book Depository</h1>
      <div class="result"></div>
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
          <td>
           <button style="width:auto;" id="<?php echo $row['bid'];?>" 
            onclick="edit(this.id);">Edit</button>
           <button style="width:auto;" id="<?php echo $row['bid'];?>" 
            onclick="Delete(this.id);">Delete</button>
          </td>
         </tr>
         <?php
        }
        ?>
        </table>
      </div>
      </div>
    </div>
<!-- This form is used to edit the given field -->
  </section>


<script>
function edit(clicked_id)
{
    //alert(clicked_id);
    window.location.href = "test_popup.php?bookid=" + clicked_id;
}
function Delete(clicked_id)
{
  var bookid=clicked_id;
  var mydata="bookid="+bookid;
  $.ajax({
      type: "GET",
      url: 'backend_delete.php',
      data: mydata,
      success: function(data){
          $(".result").html(data); 
      }
  });
  
}
</script>

</body>
</html>
