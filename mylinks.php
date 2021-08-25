<?php
$pnf=false;
if(isset($_GET["pnf"]))
{
  
  $pnf=true;
}
require('include/connection.php');


session_start();
if(!isset($_SESSION['login']))
{
  
  header('location:login.php?login_err');
  if(isset($_SESSION['admin']))
 
  {
  header("location:admin_dashboard.php?pnf");
  }
  exit;
}

?>
<?php


/* code for deleting the record */ 
if(isset($_GET['delete']))

{
    $deleted_link=true;

    $id=$_GET['delete'];
    $deleteq="DELETE FROM `url` WHERE `id`=$id ";
    $result=mysqli_query($con,$deleteq);
    if(!$result)
    {
      echo mysqli_error($con);
    }
    
}


?>




<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <title>Welcome <?php echo $_SESSION['username']?>i Notes Dashboard!</title>
  </head>
  <body>


  
<?php
require('header.php');
include("include/status.php");


?>




<div class="container mt-5">
<table id="myTable" class="table">
  <thead>
    <tr>
      <th scope="col">Sno</th>
      <th scope="col">Url</th>
      <th scope="col">Shorter Url</th>
      <th scope="col">Clicks</th>
      <th scope="col">Date/Time</th>
      <th scope="col"> Action</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  $userid=$_SESSION['username'];
$show="SELECT * from url where user_id='$userid'";
$result=mysqli_query($con,$show);
$n=0;
while($r=mysqli_fetch_assoc($result))
{
    $n=$n+1;
$n+1;
$url=$r['url'];
$short_url="localhost/inotes/?url=".$r['url_id'];
$clicks=$r['clicks'];
$time=$r['dtime'];
$id=$r['id'];
  echo"<tr>
     <td>$n</td>

      <td>$url</td>
      <td>$short_url</td>
      <td>$clicks</td>
      <td>$time</td>
      <td>
      <button type='submit' class='delete btn btn-primary' id=d'$id'>Delete</button></td>
    </tr>";
}
?>    
  </tbody>
</table>

</div>

    <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
        	
            $(document).ready( function () {
                $('#myTable').DataTable();
            } );
                </script>
  


<script>  
  deletes = document.getElementsByClassName('delete');
  Array.from(deletes).forEach((element)=>{
element.addEventListener("click",(e)=>{
  console.log("edit");
  idn=e.target.id.substr(1);
  if(confirm("Are you sure want to delete this note!"))
  {
    console.log("yes");
    window.location=`/inotes/mylinks.php?delete=${idn}`;

  }else
  {
    console.log("no");
  }
})
})
</script>
<div class="footer text-center p-3 text-light bg-dark mt-5" >
     Copyright © <?php echo date("Y");?> 
    <a class="text-white" href="index.php">iNotes.com</a>
  </div>
</body>
</html>

