<?php 
$pnf=false;
$link_status_suspicious=false;
$link_status_safe=false;
if(isset($_GET["pnf"]))
{
  
  $pnf=true;
}
session_start();

require('include/connection.php');
require('header.php');



if(!isset($_SESSION['admin']))
{
  
  header('location:login.php?login_err');
if(isset($_SESSION['login']))
 
{
header("location:dashboard.php?pnf");
}
  exit;
  
}

?>






<?php

/* code for deleting the record */ 
if(isset($_GET['delete']))

{

    $id=$_GET['delete'];
    
    $link_status="Suspicious";
$update="UPDATE `link_report` SET `link_status` = '$link_status' WHERE `link_report`.`id` = $id";
    $result=mysqli_query($con,$update);
    
    if($result)
    {
      $link_status_suspicious=true;

      
    }else
    {
echo mysqli_error($con);
    }
    
}


if(isset($_GET['safe']))
  {
    
  
    $id=$_GET['safe'];
    $link_status="Safe";
    $update="UPDATE `link_report` SET `link_status` = '$link_status' WHERE `link_report`.`id` = $id";
   
    $result=mysqli_query($con,$update);
  

if($result)
{
$link_status_safe=true;
}
    
else
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
  </head>
  <body>

  
<?php
if($link_status_safe==true)
{
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Link has been set Safe successfully.</strong>
  </div>';
}
if($link_status_suspicious==true)
{
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Link has been set <span class="text-danger">Suspicious</span> successfully.</strong>
  </div>';
}

?>



<div class="container my-5">
<table id="myTable" class="table">
  <thead>
    <tr>
      <th scope="col">Sno</th>
      <th scope="col">Link</th>
      <th scope="col">Comment</th>
      <th scope="col">IP</th> 
      <th scope="col">Status</th>
      <th scope="col">Date/Time</th>
      <th scope="col"> Action</th>
    </tr>
  </thead>
  <tbody>
  <?php 

$show="SELECT * from link_report ";
$result=mysqli_query($con,$show);
$n=0;
while($r=mysqli_fetch_assoc($result))
{
    $n=$n+1;
$n+1;
$abusive_link=$r['abusive_link'];
$comment=$r['comment'];
$user_ip=$r['user_ip'];
$time=$r['dtime'];
$id=$r['id'];
$status=$r['link_status'];

$url = explode('=', $abusive_link); //convert string into array with explode
$url_id = $url[1]; //Print first array value



  echo"<tr>
     <td>$n</td>

      <td><a href='index.php?url=$url_id' target=_blank>$abusive_link</a></td>
      <td>$comment</td>
      <td>$user_ip</td>
      <td>$status</td>
      <td>$time</td>
      <td><button type='submit' id=d'$id' class='safe btn btn-primary'>Safe</button>
      <button type='submit' id=d'$id' class='delete btn btn-primary' >Suspicious</button></td>
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
  if(confirm("Are you sure want to Suspicious this Link!"))
  {
    console.log("yes");
    window.location=`/inotes/admin_dashboard.php?delete=${idn}`;

  }else
  {
    console.log("no");
  }
})
})
</script>

<script>  
  safe = document.getElementsByClassName('safe');
  Array.from(safe).forEach((element)=>{
element.addEventListener("click",(e)=>{
  console.log("safe");
  idn=e.target.id.substr(1);
  if(confirm("Are you sure want to Safe this link!"))
  {
    console.log("yes");
    window.location=`/inotes/admin_dashboard.php?safe=${idn}`;

  }else
  {
    console.log("no");
  }
})
})
</script>

<div class="footer text-center p-3 text-light bg-dark " >
     Copyright © <?php echo date("Y");?> 
    <a class="text-white" href="index.php">iNotes.com</a>
  </div>
</body>
</html>















