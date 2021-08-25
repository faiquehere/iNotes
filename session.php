<?php 

session_start();
require('include/connection.php');
require('menu.php');

/*code for inserting the record*/
if($_SERVER['REQUEST_URI'])
{
    $uri =  $_SERVER["REQUEST_URI"]; //it will print full url
    $uriArray = explode('/', $uri); //convert string into array with explode
    $id = $uriArray[3]; //Print first array value

    $shr=$id;
    // echo $shr;
    $url=$id;
    $sql="select url from url where url_id='$url'";
    $result=mysqli_query($con,$sql);
    while($r=mysqli_fetch_assoc($result))
    {
        $redirect=$r['url'];
        echo $redirect;
        header('location:'.$redirect);
    }
    
}

  if(isset($_POST['url'])){ 
    $url=$_POST['url'];
    $r=rand(1,10000);
    $short_url="".$r;
    $insert="Insert into url (url,url_id)values('$url','$r')";
    $result=mysqli_query($con,$insert);
    $inserted=true;
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
                        <h2>Here you have full control over your links</h2>
                        
<?php 
                        
                        if($inserted==true)

{
    echo '<div class="text-center alert alert-success alert-dismissible fade show" role="alert">
    your link <strong><span id="mytext">localhost/inotes/'."$short_url".'</span></strong>
     <button class="btn btn-outline-success btn-sm" id="TextToCopy">copy</button>
     </div>';
}
?>
                	</div>
                
            <div class="header-txt2">
                  <!-- <form role="form" method="post" action="index.php">
      				<div class="form-group">
                  		<input type="url" class="form-control input-lg inp1" id="url" name="url" placeholder="Enter Url">
                      <button type="submit" class="btn btn-primary ">Short it</button>
                	</div>
                    <div class="form-group">
                	</div>
      					
      			</form> -->
            <form method="post" action="session.php" class="my-5">
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