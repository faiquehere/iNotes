<?php
/*if($connectionstatus==true)
{
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Connected</strong> 
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}*/

// $pass_check=true;
// $user_inserted=false;
if($inserted==true)
{
$deleted=false;
$updated=false;
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Your note has been added to inotes</strong>
  </div>';
}

if($deleted==true)
{
  $inserted=false;
$updated=false;
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Your note has been <span class="text-danger">deleted</span>.</strong>
  </div>';
}
if($updated==true)
{
  $deleted=false;
  $inserted=false;
 echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Your note  has been updated.</strong>
  </div>';
}


if($pnf==true)
{
  $deleted=false;
  $inserted=false;
 $updated=false;
  echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Page not found!</strong>
  </div>';
}
if($deleted_link==true)
{
 
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Your link has been <span class="text-danger">Deleted</span> successfully!</strong>
  </div>';
}








?>