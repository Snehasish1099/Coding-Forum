<?php
$showError=false;
$showAlart=false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "_dbconnect.php";
    $email = $_POST['loginEmail'];
    $pass = $_POST['loginpass'];
    $sql="SELECT * FROM `users` WHERE user_email='$email'";
    $result=mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);
   
    if($numRows==0){
        $showError="You don't have any account";
            header("location: /forum/index.php?error=$showError");
            
    }

    if ($numRows == 1) {
        $row =mysqli_fetch_assoc($result);
        if(password_verify($pass, $row['user_pass'])){
          session_start();
          $_SESSION['loggedin']=true;
          $_SESSION['sno']=$row['sno'];
          $_SESSION['usermail']=$email;
          $showAlart="You just loggedin successfully. Welcome $email";
          header("location: /forum/index.php?loginsuccess=$showAlart");
          
        }
        else{
            $showError='unable to login';
            header("location: /forum/index.php?error=$showError");
        }
    }
}