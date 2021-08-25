
<?php 
session_start();
require('include/connection.php');
require('header.php');
$report_inserted=false;

$err=false;
if(isset($_POST['abusivelink']))
{

    $uriArray = explode('=', $_POST['abusivelink']); //convert string into array with explode
    $id = $uriArray[1]; //Print first array value
    

 
$abusivelink=$_POST['abusivelink'];
$comment=$_POST['linkcomment'];

$sql="select * from link_report where abusive_link='$abusivelink'";
$result=mysqli_query($con,$sql);
              $num=mysqli_num_rows($result);
              if($num<=0)
              {
                
                $sql="insert into link_report(abusive_link,comment,user_ip)values('$abusivelink','$comment','192.1.1.1')";
                $result=mysqli_query($con,$sql);
                $report_inserted=true;
               }
else{
  $err=true;
}

}






?>
<?php
  if($report_inserted==true)
  {

    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>The URL has been sent to us and will be verified soon.</strong>
  </div>';  
   
    
  }

 

if($err==true)
{
 
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>This url was already reported, we will take action soon!</strong>
</div>';  
}


?>
<div class="container my-4 text-center ">
    <h1 class="text-center">Abuse report</h1>
    <h3 class="text-primary">Report the<span class="text-danger"> suspicious</span> link</h3>
<form action="#" method="post">
    <div class="form-group ">
  <div class="mb-3 ">

    <input type="text" class="form-control text-center" placeholder="Enter suspicious link*"   id="abusivelink" name="abusivelink" autofocus required>
  </div>

  <div class="mb-3">

   <textarea class="form-control text-center" id="linkcomment" name="linkcomment" placeholder="Comment"></textarea>
</div>
  <button type="submit" class="btn btn-primary">Report</button>
</div>
</form>

</div>


<?php
require('footer.php');
?>