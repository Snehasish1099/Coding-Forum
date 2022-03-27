<?php
session_start();
echo "Logging You Out. Please wait...";
$result=session_destroy();
if($result==true){
header("location: ../index.php");
}
?>