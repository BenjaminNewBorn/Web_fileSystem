<?php
session_start();
if($_SESSION['check']){
    $username =$_SESSION['username'];
} else {
    header("Location:fileUserLogin.php");
    exit;
}

// Get the filename and make sure it is valid

$filename = basename($_FILES['uploadedfile']['name']);
if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
    echo "Invalid filename";
    exit;
}

// Get the username and make sure it is valid
$username = $_SESSION['username'];
if( !preg_match('/^[\w_\-]+$/', $username) ){
    echo "Invalid username";
    exit;
}

$full_path = sprintf("../storage/%s/%s", $username, $filename);

if( move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $full_path) ){
    header("location:fileList.php");
    exit;
}else{
    echo "Failed! Please try it again. Return to file list page in 3 seconds";
    header("refresh:3;url='fileList.php'");
    exit;
}

?>