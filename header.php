
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title><?php 
    if(isset($_SESSION['login']))
    {
    echo "Welcome ".strtoupper($_SESSION['username'])." to iNotes.";  
    }
    elseif(isset($_SESSION['admin']))
    {
    echo "Welcome ".strtoupper($_SESSION['admin'])." to iNotes"; 
    }
    else
    {
echo "Welcome to iNotes!";
    }
    ?></title>
    <style>
  body
  {
    background-color:#f8f9fa;
  }
  </style>

  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">iNotes</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home </a>
          <!-- <span class="sr-only">(current)</span> -->
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About </a>
      </li>
  

    
    <?php
        if(isset($_SESSION['login'])){
    
          echo '
          <li class="nav-item ">
          <a class="nav-link" href="dashboard.php">Dashboard</a>
          </li> 
          <li class="nav-item ">
          <a class="nav-link" href="mylinks.php">Links</a>
          </li>';
 

      }
        ?>     
            <?php
        if(isset($_SESSION['admin'])){

          echo '
          <li class="nav-item ">
          <a class="nav-link" href="admin_dashboard.php">Dashboard</a>
          </li>';
 

      }else
      {
        echo '      
        <li class="nav-item">
        <a class="nav-link " href="report.php">Report</a>
      </li>
        
        <li class="nav-item">
        <a class="nav-link " href="contact.php">Contact </a>
      </li>
    
';
      }
        
        ?>     
</ul>
      
<?php 
  if(!isset($_SESSION['login']) && !isset($_SESSION['admin'])){
  echo '
  <ul class="navbar-nav navbar-right">
  <li class="nav-item">
  <a class="nav-link" href="login.php">Login</a>
</li>

        <li class="nav-item">
          <a class="nav-link" href="register.php">Register</a>
        </li>
        </ul>';
  }
?>


<?php 
if(isset($_SESSION['login'])){
echo '<ul class="nav navbar-nav navbar-right">
      <li class="nav-item ">
      <a class="nav-link" href="dashboard.php">Hello '.strtoupper($_SESSION['username']).' </a>
    </li>
      <li class="nav-item ">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
    
</ul>';}
?>

<?php 
if(isset($_SESSION['admin'])){
echo '<ul class="nav navbar-nav navbar-right">
      <li class="nav-item ">
      <a class="nav-link" href="admin_dashboard.php">Hello '.strtoupper($_SESSION['admin']).' </a>
    </li>
      <li class="nav-item ">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
    
</ul>';}
?>
  </div>
</nav>
    







