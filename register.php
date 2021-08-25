
<?php 
require('include/connection.php');
require('header.php');
$user_inserted=false;
$pass_check=false;
$err=false;
if(isset($_POST['username']))
{
$username=$_POST['username'];
$password=$_POST['password'];
$passwordc=$_POST['passwordc'];

if($password==$passwordc)
{

              $sql="select * from users where username='$username'";
              $result=mysqli_query($con,$sql);
              $num=mysqli_num_rows($result);
              if($num<=0)
              {
                
                $passwordhash=password_hash($password,PASSWORD_DEFAULT); 
                $sql="insert into users(username,password,user_type)values('$username','$passwordhash','user')";
                $result=mysqli_query($con,$sql);
                $user_inserted=true;
               }
else{
  $err=true;
}

}

else
{

  $pass_check=true;
  
}

}


?>
<?php
  if($user_inserted==true)
  {

    $pass_check=false;
    header('location:login.php?login');
    
  }

  if($pass_check==true)
  {
    $user_inserted=false;
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Password does not match</strong>
  </div>';  
}

if($err==true)
{
 
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Username already exit!</strong>
</div>';  
}


?>
<div class="container my-4 text-center ">
    <h2 class="text-center">Register to iNotes</h2>
<form action="#" method="post">
    <div class="form-group ">
  <div class="mb-3 ">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control"   id="username" name="username" >
  </div>
  <div class="mb-3 md-2">
  <label for="password" class="form-label">Password</label>
  <input type="password" class="form-control"  id="password" name="password" >

</div>
<div class="mb-3 ">
  <label for="Passwordc" class="form-label">Confirm Password</label>
  <input type="password" class="form-control"  id="passwordc" name="passwordc" >

</div>
  <button type="submit" class="btn btn-primary">Register</button>
</div>
</form>

</div>


<?php
require('footer.php');
?>