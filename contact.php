<?php 
session_start();
require('include/connection.php');
require('header.php');
$send=false;
if(isset($_POST['name']))
{
    $name=$_POST['name'];
    $email=$_POST['email'];
    $message=$_POST['message'];

    $sql="insert into contact(name,email,message)values('$name','$email','$message')";
    $result=mysqli_query($con,$sql);
    if($result)
    {
        $send=true;
    }

}

?>

<div class="container my-4 text-center ">
    <h2 class="text-center">Contact Us</h2>
<?php
    if($send==true)
    {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Your Message has been sent.</strong> You will be contacted soon!
      </div>';  
    }
?>
    <form action="#" method="post" class="my-3">
    <div class="form-group ">
  <div class="mb-3 ">
    <label for="username" class="form-label">Name</label>
    <input type="text" class="form-control"   id="name" name="name" Required>
  </div>
  <div class="mb-3 md-2">
  <label for="email" class="form-label">Email</label>
  <input type="email" class="form-control"  id="email" name="email"  Required>

</div>
<div class="mb-3 ">
  <label for="Message" class="form-label">Message</label>
  <textarea class="form-control" rows="5"  id="message" name="message" Required></textarea>
</div>
  <button type="submit" class="btn btn-primary" >Send Message</button>
</div>
</form>




</div>





<?php
require('footer.php');
?>