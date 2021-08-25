<?php
$server="localhost";
$username="root";
$password="";
$dbname="inotes";
$connectionstatus=false;
$inserted=false;
$updated=false;
$deleted=false;
$deleted_link=false;
$con=mysqli_connect($server,$username,$password,$dbname);
if(!$con)
{
     die ("not connected". mysqli_connect_error());
  

}
else
{
    $connectionstatus=true;
    //echo "connected";
}


?>