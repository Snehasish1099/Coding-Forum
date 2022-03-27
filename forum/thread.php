<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>iCoder - Coding Forum</title>
</head>
<style>
  .sh{
    box-shadow: 10px 10px 40px #80808096;
    padding: 0;
  }
</style>

<body>

  <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>

    <?php
    $id=$_GET['threadid'];
    $sql="SELECT * FROM `threads` WHERE thread_id=$id"; 
  $result = mysqli_query($conn,$sql);
  // fetching data from category database
  while($row = mysqli_fetch_assoc($result)){
    $thread_title= $row['thread_title'];
    $thread_desc= $row['thread_desc'];
    $thread_user_id= $row['thread_user_id'];
    $sql2="SELECT user_email FROM `users` WHERE sno=$thread_user_id";
    $result2= mysqli_query($conn,$sql2);
    $row2= mysqli_fetch_assoc($result2);
    $user=$row2['user_email'];
  }
  
  ?>
    <?php
  $method=$_SERVER['REQUEST_METHOD'];
  $showAlart=false;
  if($method=='POST'){
    //   insert thread into database
 
    $comment_content=$_POST['comm'];
    $comment_content= str_replace("<","&lt;",$comment_content);
    $comment_content= str_replace(">","&gt;",$comment_content);
    $sno=$_POST['sno'];
  if($comment_content!=null){  
    $sql="INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment_content', '$id', '$sno', current_timestamp())"; 
  $result = mysqli_query($conn,$sql);  
  $showAlart=true;
}
  }
  if($showAlart == true && $method=='POST'){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> You just add a comment successfully.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
if($showAlart == false && $method=='POST'){
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Alart!</strong> Your progress is not saved. Do not leave a blank comment. Try again.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
  ?>

    <!-- category container -->
    <div class="container my-4 sh">
        <div class="card p-4 bg-primary bg-opacity-10">
            <h1 class="display-4"><?php echo $thread_title; ?>
            </h1>
            <p class="lead">
                <?php echo $thread_desc; ?>
            </p>
            <hr class="my-4">
            <p>This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums is not allowed. Do not
                post
                copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post
                questions. Remain respectful of other members at all times</p>
            <p><b>Posted by: <?php echo $user; ?></b></p>
        </div>
    </div>

    <?php
   if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
   echo '<div class="container">
        <h1 class="my-3">Leave a comment</h1>
        <form action="'.$_SERVER['REQUEST_URI'].'" method="POST">
            <div class="mb-3">
                <label for="comm" class="form-label">Type your comment</label>
                <textarea class="form-control" id="comm" name="comm"></textarea>
                <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
            </div>
            
            <button type="submit" class="btn btn-info">Post comment</button>
        </form>
    </div>';
   }
   else{
    echo '<div class="container">
    <h1 class="my-3">Leave a Comment</h1>
    <p>You are not logged in. Please login to star a discussion</p>
</div>';
 }
   ?>

    <div class="container ques">
        <h1 class="my-3">Discussions</h1>

        <?php
            $id=$_GET['threadid'];
            $noResult=true;
            $sql="SELECT * FROM `comments` WHERE thread_id=$id"; 
        $result = mysqli_query($conn,$sql);
        // fetching comments from database for a category
        while($row = mysqli_fetch_assoc($result)){
            $noResult=false;
            $comment_by= $row['comment_by'];
            $comment_time= $row['comment_time'];
            $comment_content= $row['comment_content'];
            $sql2="SELECT user_email FROM `users` WHERE sno=$comment_by";
            $result2= mysqli_query($conn,$sql2);
            $row2= mysqli_fetch_assoc($result2);
            $user=$row2['user_email'];
            // $thread_desc= substr($row['thread_desc'],0,30);
            echo ' <div class="card border-light d-flex flex-row my-3">
            <img src="image/user.png" width="30px" height="30px" alt="" srcset="">
            <div class="card-body py-0">
                <h5 class="card-title my-0 font-weight-bold"><b>'.$user.' at '.$comment_time.'</b></h5>
                <p class="card-text my-0">'.$comment_content.'</p></a>
            </div>
    </div>';

  }
  if($noResult==true){
      echo '<b>Be the first person to leave a comment</b>';
  }
  
  ?>


    </div>


    <?php include 'partials/_footer.php'; ?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    -->
</body>

</html>