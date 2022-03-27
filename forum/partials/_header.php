<style>
  nav {
    opacity: 0.90;
  }
</style>
<?php
session_start();
echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">iCoder</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
               Top Catagories
            </a>
            <ul class="dropdown-menu"  data-spy="scroll" data-offset="0"  aria-labelledby="navbarDropdown">';
            $sql = "SELECT category_name, category_id FROM `categories` Limit 5";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
              $cat_name=$row['category_name'];
              $cat_id=$row['category_id'];
            echo '<li><a class="dropdown-item" href="threadlist.php?catid='. $cat_id .'">'.$cat_name.'</a></li>';
            }

            echo '</ul>
          </li>
          
        </ul>
        <div class="d-flex mx-2">';
            
          if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
            echo '<form class="d-flex mx-2" action="search.php" method="GET">
            <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-info" type="submit">Search</button></form>
            <p class="text-light my-2 mx-2 text-center">Welcome '.$_SESSION['usermail'].'</p>
            <a href="partials/logout.php" class="btn btn-outline-info mx-2">Logout</a>
            ';

          }
         else{
          echo '<form class="d-flex mx-2" action="search.php" method="GET">
                <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-info" type="submit">Search</button></form>
                <button class="btn btn-outline-info mx-2" data-bs-toggle="modal" data-bs-target="#loginModal">LogIn</button>
                <button class="btn btn-outline-info mx-2" data-bs-toggle="modal" data-bs-target="#signupModal">SignUp</button>
                ';
         }
        echo '</div>
        
      </div>
    </div>
    </nav>';
    include 'partials/_loginModal.php';
    include 'partials/_signupModal.php';
    include 'partials/_loginModal.php';

    //for signup
    if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']==true){
      echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
      <strong>Success!</strong> You SignedUp successfully. You can now login.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }if(isset($_GET['error']) && $_GET['error']==true){
      echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
      <strong>Alart! </strong>'.$_GET['error'].'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    // For Login
    if(isset($_GET['loginsuccess']) && $_GET['loginsuccess']==true){
      echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
      <strong>Success! </strong>'.$_GET['loginsuccess'].'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    
    }
?>