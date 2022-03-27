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
    $id=$_GET['catid'];
    $sql="SELECT * FROM `categories` WHERE category_id=$id"; 
  $result = mysqli_query($conn,$sql);
  // fetching data from category database
  while($row = mysqli_fetch_assoc($result)){
    $cat_name= $row['category_name'];
    $cat_desc= $row['category_description'];

  }
  
  ?>

    <?php
  $method=$_SERVER['REQUEST_METHOD'];
  $showAlart=false;
  if($method=='POST'){
    //   insert thread into database

    $th_title=$_POST['title'];
    $th_title= str_replace("<","&lt;",$th_title);
    $th_title= str_replace(">","&gt;",$th_title);
    $th_desc=$_POST['desc'];
    $th_desc= str_replace("<","&lt;",$th_desc);
    $th_desc= str_replace(">","&gt;",$th_desc);
    $sno=$_POST['sno'];
    $id=$_GET['catid'];
    if($th_title!=null && $th_desc!=null){
    $sql="INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$sno', current_timestamp())"; 
  $result = mysqli_query($conn,$sql);
  $showAlart=true;
}
  }
  if($showAlart == true && $method=='POST'){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> You just add a thread successfully.  Please wait for community to respond
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
if($showAlart == false && $method=='POST'){
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Alart!</strong> Your progress is not saved. Do not enter blank title or description. Try again.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
  ?>

    <!-- category container -->
    <div class="container my-4 sh">
        <div class="card p-4 bg-primary bg-opacity-10">
            <h1 class="display-4">Welcome to
                <?php echo $cat_name; ?> Threads
            </h1>
            <p class="lead">
                <?php echo $cat_desc; ?>
            </p>
            <hr class="my-4">
            <p>This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums is not allowed. Do not
                post
                copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post
                questions. Remain respectful of other members at all times</p>
            <p></p>
        </div>
    </div>
    <!-- question post form -->
    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    echo '<div class="container">
        <h1 class="my-3">Start a Discussion</h1>
        <form action="'.$_SERVER["REQUEST_URI"].'" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Problem Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="title">
                <div id="emailHelp" class="form-text">Keep your title as short and crisp as possible.</div>
                <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
            </div>
            <div class="mb-3">
                <label for="desc" class="form-label">Ellaborate Your Concern</label>
                <textarea class="form-control" id="desc" name="desc"></textarea>
            </div>
            
            <button type="submit" class="btn btn-info">Submit</button>
        </form>
    </div>';
    }
    else{
       echo '<div class="container">
       <h1 class="my-3">Start a Discussion</h1>
       <p>You are not logged in. Please login to star a discussion</p>
   </div>';
    }
    ?>

    <div class="container ques">
        <h1 class="my-3">Browse Questions</h1>

        <!-- select questions for each category -->
        <?php
            $id=$_GET['catid'];
            $noResult=true;
            $sql="SELECT * FROM `threads` WHERE thread_cat_id=$id"; 
        $result = mysqli_query($conn,$sql);
        // fetching data from category database
        while($row = mysqli_fetch_assoc($result)){
            $noResult=false;
            $thread_id= $row['thread_id'];
            $thread_title= $row['thread_title'];
            $thread_desc= substr($row['thread_desc'],0,30);
            $thread_user_id= $row['thread_user_id'];
            $sql2="SELECT user_email FROM `users` WHERE sno=$thread_user_id";
            $result2= mysqli_query($conn,$sql2);
            $row2= mysqli_fetch_assoc($result2);
            $user=$row2['user_email'];
            echo ' <div class="card border-light d-flex flex-row my-3">
            <img src="image/user.png" width="30px" height="30px" alt="" srcset="">
            <div class="card-body py-0"><a class="text-decoration-none text-reset" href="thread.php?threadid='.$thread_id.'">
                <h5 class="card-title">'.$thread_title.'</h5>
                <p class="card-text">'.$thread_desc.'</p></a>
            </div>
            <h6 class="card-title my-0 font-weight-bold"><b>Asked by: '.$user.' at '.$row['timestamp'].'</b></h6>
    </div>';

  }
  if($noResult==true){
      echo '<b>Be the first person to ask a question</b>';
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