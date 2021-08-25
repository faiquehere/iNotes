<?php
$pnf=false;
if(isset($_GET["pnf"]))
{
  
  $pnf=true;
}
require('include/connection.php');

require('include/update.php');
require('include/delete.php');
session_start();
if(!isset($_SESSION['login']))
{
  
  header('location:login.php?login_err');
  if(isset($_SESSION['admin']))
 
  {
  header("location:admin_dashboard.php?pnf");
  }
  exit;
}
?>
<?php
/*code for inserting the record*/

  if(isset($_POST['titlen'])){ 
    $title=$_POST['titlen'];
    $description=$_POST['descriptionn'];
    $userid=$_SESSION['username'];
    // $dtime=date("M D Y h:i:sa");
    $insert="Insert into notes (title,description,userid)values('$title','$description','$userid')";
    $result=mysqli_query($con,$insert);
    $inserted=true;
  }
  else

  {
    echo mysqli_error($con);
  }
?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <title>Welcome <?php echo $_SESSION['username']?>i Notes Dashboard!</title>
  </head>
  <body>
<!-- Edit Modal -->
<div class="modal fade" id="updatemodal" tabindex="-1" role="dialog" aria-labelledby="updatemodalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updatemodalLabel">Edit this Note</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="/inotes/dashboard.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="idupdate" id="idupdate">
            <div class="form-group">
              <label for="title">Note Title</label>
              <input type="text" class="form-control" id="titleupdate" name="titleupdate" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
              <label for="desc">Note Description</label>
              <textarea class="form-control" id="descriptionupdate" name="descriptionupdate" rows="3"></textarea>
            </div> 
          </div>
          <div class="modal-footer d-block mr-auto">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>  

  
<?php
require('header.php');
include("include/status.php");


?>
<div class="container my-4">
    <h2>Add your notes to iNotes!</h2>
<form action="#" method="post">
  <div class="mb-3 my-4 ">
    <label for="titleid" class="form-label">Title</label>
    <input type="text" class="form-control" id="titleid" name="titlen" >
  </div>
  <div class="mb-3">
  <label for="descriptionid" class="form-label">Description</label>
   <textarea class="form-control" id="descriptionid" name="descriptionn"></textarea>
</div>
  <button type="submit" class="btn btn-primary">Add to iNotes</button>
</form>

</div>



<div class="container">
<table id="myTable" class="table">
  <thead>
    <tr>
      <th scope="col">Sno</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Date/Time</th>
      <th scope="col"> Action</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  $userid=$_SESSION['username'];
$show="SELECT * from notes where userid='$userid'";
$result=mysqli_query($con,$show);
$n=0;
while($r=mysqli_fetch_assoc($result))
{
    $n=$n+1;
$n+1;
$title=$r['title'];
$description=$r['description'];
$time=$r['dtime'];
$id=$r['id'];
  echo"<tr>
     <td>$n</td>

      <td>$title</td>
      <td>$description</td>
      <td>$time</td>
      <td><button type='submit' id='$id' class='edit btn btn-primary'>Edit</button>
      <button type='submit' class='delete btn btn-primary' id=d'$id'>Delete</button></td>
    </tr>";
}
?>    
  </tbody>
</table>

</div>

    <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
        	
            $(document).ready( function () {
                $('#myTable').DataTable();
            } );
                </script>
  
<script>


  edits=document.getElementsByClassName('edit');
  Array.from(edits).forEach((element) => {
    element.addEventListener("click", (e) => {
      console.log("edit ");
      tr= e.target.parentNode.parentNode;
      title=tr.getElementsByTagName("td")[1].innerText;
      description=tr.getElementsByTagName("td")[2].innerText;
      console.log(title, description);
      titleupdate.value=title;
      descriptionupdate.value=description;
      idupdate.value=e.target.id;
      console.log(e.target.id)
      $('#updatemodal').modal('toggle');
    })
  })
</script>

<script>  
  deletes = document.getElementsByClassName('delete');
  Array.from(deletes).forEach((element)=>{
element.addEventListener("click",(e)=>{
  console.log("edit");
  idn=e.target.id.substr(1);
  if(confirm("Are you sure want to delete this note!"))
  {
    console.log("yes");
    window.location=`/inotes/dashboard.php?delete=${idn}`;

  }else
  {
    console.log("no");
  }
})
})
</script>
<div class="footer text-center p-3 text-light bg-dark " >
     Copyright © <?php echo date("Y");?> 
    <a class="text-white" href="index.php">iNotes.com</a>
  </div>
</body>
</html>

