<?php include "config.php"; ?>
<html>
 <head>
  <title>My Details</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="style.css">
 </head>
 <body>
  <?php 
  if(isset($_POST["submit"])){
    $sql="insert into products (title,roll_no,registration_no,application_id,password) values ";
    $rows=[];
    for($i=0;$i<count($_POST["title"]);$i++){
      $rows[]="('{$_POST["title"][$i]}','{$_POST["roll_no"][$i]}','{$_POST["registration_no"][$i]}','{$_POST["application_id"][$i]}','{$_POST["password"][$i]}')";
    }
    $sql.=implode(",",$rows);
    if($con->query($sql)){
      echo "Products Added Successfully";
    }else{
      echo "Added Failed!!!";
    }
  }
  ?>
 <h3>My Details</h3>
 <form method='post' action='index.php' >
  <table class='table'>
  <thead>
   <tr> 
     <th>Title</th>
     <th>Roll No.</th>
     <th>Registration No.</th>
     <th>Application_Id</th>
     <th>Password</th>
     <th>Add</th>
     <th>Remove</th>
   </tr>
  </thead>
  <tbody id="tbl">
   <tr>
     <td><input type='text' placeholder="Enter title" name='title[]' required ></td>
     <td><input type='text' placeholder="Enter Roll No." name='roll_no[]'></td>
     <td><input type='text' placeholder="Enter Registration No." name='registration_no[]'></td>
     <td><input type='text' placeholder="Enter Application Id" name='application_id[]'></td>
     <td><input type='text' placeholder="Enter Password" name='password[]'></td>
     <td><input class="btn btn-success btn-xs" type='button' value='+' onclick='add_row()' ></td>
     <td><input class="btn btn-danger btn-xs" type='button' value='-' onclick='remove_row(this)'></td>
   </tr>
  </tbody>
    <tfoot>  
     <tr>
       <td colspan='7' style='text-align:right;'><input type='submit' name='submit' value='Save Details' class="btn-warning"></td>
     </tr>
    </tfoot>
  </table>
 </form>
  <script>
    function add_row()
    {
      var tr=document.createElement("tr");
      tr.innerHTML="<td><input type='text' name='title[]' required ></td> <td><input type='text' name='roll_no[]'></td> <td><input type='text' name='registration no[]'></td> <td><input type='text' name='application_id[]'></td> <td><input type='text' name='password[]'></td> <td><input type='button' value='+' onclick='add_row()' class='btn btn-success btn-xs'></td> <td><input type='button' value='-' onclick='remove_row(this)' class='btn btn-danger btn-xs'></td>";
      document.getElementById("tbl").appendChild(tr);
    }
    function remove_row(e)
    {
      var n=document.querySelector("#tbl").querySelectorAll("tr").length;
      if(n>1&&confirm("Are You Sure")==true){
       var ele=e.parentNode.parentNode;
       ele.remove();
      }
    }
  </script>

  <div class="details">

  <table class="table1">
    <tr>
      <th>Title</th>
      <th>Roll No.</th>
      <th>Registration No.</th>
      <th>Application Id</th>
      <th>Password</th>
    </tr>
    
    <?php

    $records = mysqli_query($con,"select * from products"); // fetch data from database

    while($data = mysqli_fetch_array($records))
    {
    ?>
    <tbody>
      <tr>
        <td><?php echo $data['title']; ?></td>
        <td><?php echo $data['roll_no']; ?></td>
        <td><?php echo $data['registration_no']; ?></td>
        <td><?php echo $data['application_id']; ?></td>
        <td><?php echo $data['password']; ?></td>
      </tr> 
    </tbody>
  <?php
  }
  ?>
  

  </table>
</div>

 </body>
</html>