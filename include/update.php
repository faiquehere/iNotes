<?php
/*code for updating the record */
if(isset($_POST['idupdate']))
  {
    
  
    $idupdate=$_POST['idupdate'];
    $titleupdate=$_POST['titleupdate'];
    $descriptionupdate=$_POST['descriptionupdate'];
  $update="UPDATE `notes` set `title`= '$titleupdate', `description`= '$descriptionupdate' where id='$idupdate' ";
  $result=mysqli_query($con,$update);
  

if($result)
{
    $updated=true;
}
    
else
  {
    echo mysqli_error($con);
  }
  }
  
?>