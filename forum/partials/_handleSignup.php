<?php
$showError=false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "_dbconnect.php";
    $user_email = $_POST['signupEmail'];
    $user_pass = $_POST['signuppassword'];
    $user_cpass = $_POST['signupcpassword'];
    //check wheather a email exist or not
    $existSql = "SELECT * FROM `users` WHERE user_email='$user_email'";
    $result = mysqli_query($conn, $existSql);
    $numRows = mysqli_num_rows($result);

    if ($numRows > 0) {
        $showError = "Email is already in use";
    }
    else {
        if ($user_pass == $user_cpass && $user_pass!=null && $user_cpass!=null) {
            $hash = password_hash($user_pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_email`, `user_pass`, `timestamp`) VALUES ('$user_email', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $showAlart = true;
                header("location: /forum/index.php?signupsuccess=true");
                exit;
            }
        }
        else {
            $showError = "Your password is not matched";
        }
    }
    header("location: /forum/index.php?error=$showError");
}
?>