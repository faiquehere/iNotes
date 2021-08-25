<?php 

/* code for deleting the record */ 
if(isset($_GET['delete']))

{
    $deleted=true;

    $id=$_GET['delete'];
    $deleteq="DELETE FROM `notes` WHERE `id`=$id ";
    $result=mysqli_query($con,$deleteq);
    if(!$result)
    {
      echo mysqli_error($con);
    }
    
}
?>