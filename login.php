<?php 
session_start();
if(isset($_SESSION['login']))
 
{
header("location:dashboard.php");
exit;

}
if(isset($_SESSION['admin']))
{
  header("location:admin_dashboard.php");
  
  exit;
}

require('include/connection.php');
require('header.php');


$show_error=false;
$login_er=false;
$login=false;
$user_not_found=false;
if(isset($_POST['username']))
{
  $username=$_POST['username'];
  $password=$_POST['password'];
$sql="select *from users where username='$username'";
$result=mysqli_query($con,$sql);
$num=mysqli_num_rows($result);

if($num==1)
{
  while($r=mysqli_fetch_assoc($result))
  {
    if(password_verify($password,$r['password']))
    {
      if($r['user_type']=='user'){
          session_start();


      $_SESSION['login']=true;
      $_SESSION['username']=$username;
    header('location:dashboard.php');
        
  }
      
      else
      {

        session_start();
          
              $_SESSION['admin']=true;
            $_SESSION['admin']=$username;
              
          header('location:admin_dashboard.php');        
        
        }
    }
  else
  {
    $show_error=true;
  }
  }
}
if(!$num==1)
  {
$user_not_found=true;
  }


}
if($show_error==true)
{
$login_er=false;
 echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Invalid details.</strong>

  </div>';

}

if(isset($_GET['login_err']))
{
 $login_er=true;
  
}

if($login_er==true)
{
  echo '<div  class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Please Login.</strong>
  </div>';

}

if($user_not_found==true)
{
  echo '<div  class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>User not found.</strong>
  </div>';

}

if(isset($_GET['login']))
{
 $login=true;
  
}

if($login==true)
{
  echo '<div  class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Your account has been created. Now you can login</strong>
  </div>';

}


?>
  <div class="container my-4 text-center ">
    <h2 class="text-center">Login to iNotes</h2>
<form action="login.php" method="post">
    <div class="form-group">
  <div class="mb-3 ">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" width="83px"  id="username" name="username" >
  </div>
  <div class="mb-3 md-2">
  <label for="password" class="form-label">Password</label>
  <input type="password" class="form-control"  id="password" name="password" >

</div>
  <button type="submit" class="btn btn-primary">Login</button>
</div>
</form>

</div>

<?php
require('footer.php');
?>