<?php
session_start();
if($_SESSION['check']){
    $username =$_SESSION['username'];
} else {
    header("Location:fileUserLogin.php");
    exit;
}

//check the validation of filename and username, get the correct path
$filename =  $_GET['choosedFile'];
$username = $_SESSION['username'];
if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
    echo "Invalid filename";
    exit;
}
$username = $_SESSION['username'];
if( !preg_match('/^[\w_\-]+$/', $username) ){
    echo "Invalid username";
    exit;
}
//$full_path = sprintf("../storage/%s/%s", $username, $filename);
$full_path = sprintf("../pet/2/test1.jpeg");

if($_GET['submit'] == "Delete") { //delete file
    unlink($full_path);
    header("Location:fileList.php");
    exit();
} elseif($_GET['submit'] == "View"){ //view the file
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mine = $finfo->file($full_path);
    header("Content-Type:".$mine);
    header('Content-Description: File Transfer');
    header('Content-Disposition: attachment; filename="'.basename($full_path).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($full_path));
    readfile($full_path);
    exit;
}



?>