<?php 
session_start();
require('include/connection.php');
require('header.php');

if(isset($_GET['url']))
{
  function llink()
  {
    $shr=$_GET['url'];
      //echo $shr;
      global $con;
      $url=$_GET['url'];
      $sql1="select * from url where url_id='$url'";
      $result1=mysqli_query($con,$sql1);
      
      while($r=mysqli_fetch_assoc($result1))
      {
        
         $redirect=$r['url'];
$click=$r['clicks'];
$click=$click+1;

$update="update url set clicks='$click' where url_id='$url'";
$result=mysqli_query($con,$update);
         //echo $redirect;
          header('location:'.$redirect);
        
      
      }
  }

  $ablink="localhost".$_SERVER['REQUEST_URI'];
  // echo $ablink;
  
$sqlquery="SELECT abusive_link, link_status FROM `link_report` WHERE abusive_link='$ablink'";
  $result=mysqli_query($con,$sqlquery);
  $num=mysqli_num_rows($result);
  if($num==1)
  {
    
  while($r=mysqli_fetch_assoc($result))
  {

    $status=$r['link_status'];
    if($status=='Suspicious')
    {
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong> The link has been blocked.We found it <span class="text-danger">Suspicious.</span></strong>
    </div>';
    }
    else
    {
      llink();
    }
  }
}

   
   else
  {
    llink();
    
    

}

}
  if(isset($_POST['url'])){ 
    if(isset($_SESSION['username']))
    {
      $user_id=$_SESSION['username'];
    
      $url=$_POST['url'];
    $r=rand(1,10000);
    $short_url="?url=".$r;
    $insert="Insert into url (url,url_id,user_id)values('$url','$r','$user_id')";
    $result=mysqli_query($con,$insert);
    $inserted=true;
    }
    else
    {
      $url=$_POST['url'];
    $r=rand(1,10000);
    $short_url="?url=".$r;
    $insert="Insert into url (url,url_id)values('$url','$r')";
    $result=mysqli_query($con,$insert);
    $inserted=true;
      
    }
  }
  else

  {
    echo mysqli_error($con);
  }


?>
<style>
  body
  {
    background-color:#f8f9fa;
  }



  </style>

<div class="container my-5">
<div class="header">
    <div class="container">
   		<div class="text-vertical-center">
            	<div class="header-txt text-center">
                	<div class="header-txt1">
                        <h1>Url Shortner</h1>
  <br>
                        <h2>Here you have full control over your links</h2>
                        
<?php 
                        
                        if($inserted==true)

{
  if(!isset($_SESSION['login']) && !isset($_SESSION['admin']))
  {
    
  
    echo '<div class="text-center alert alert-success alert-dismissible fade show" role="alert">
    your link <strong><span id="mytext">localhost/inotes/'."$short_url".'</span></strong>
     <button class="btn btn-outline-success btn-sm" id="TextToCopy">copy</button>
    <br>
    <a class="link" href="register.php">Register to use other features</a> 
    
     </div>';
  
  }else{
  echo '<div class="text-center alert alert-success alert-dismissible fade show" role="alert">
    your link <strong><span id="mytext">localhost/inotes/'."$short_url".'</span></strong>
     <button class="btn btn-outline-success btn-sm" id="TextToCopy">copy</button>
    
     </div>';
  }

}
?>
                	</div>
                
            <div class="header-txt2">
            <form method="post" action="index.php" class="my-5">
  <div class="input-group">
    <input type="url" class="form-control " id="url" name="url" placeholder="Enter long url and shorten it" style="font-family:Avenir Next LT Pro; border-top-left-radius:20px;border-bottom-left-radius:20px; height:60px">
    <div class="input-group-btn">
      <button class="btn btn-primary btn-lg" type="submit" style="border-top-right-radius:20px;border-bottom-right-radius:20px;font-family:Avenir Next LT Pro;  height:60px; "> Shorten</button>
    </div>
  </div>
</form>
          </div>
        	</div>
    	</div>
    </div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
  $('#TextToCopy').click(function(){
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($('#mytext').text()).select();
  document.execCommand("copy");
  $temp.remove();
});
</script>
<?php

require('footer.php');
?>