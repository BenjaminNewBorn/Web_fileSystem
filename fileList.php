<?php
session_start();
if($_SESSION['check']){
    $username =$_SESSION['username'];
} else {
    header("Location:fileUserLogin.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="fileSystem.css">
    <title>FileList</title>
</head>
<body>
    <h3>Welcome, <?php echo $username; ?></h3><br>
    <a href="fileUserLogin.php">Logout</a>
    <br><br>
    File List:<br><br>

    <table>
        <tr>
            <th>File Name</th>
            <th>Operation</th>
        </tr>
    <?php
    $handle = opendir("../storage/$username");
    while (($filename = readdir($handle)) !== false) {
        if($filename != "." && $filename != "..") {
    ?>
        <tr>
            <td><?php echo htmlentities($filename);?></td>
            <td>
                <form name="opeation" action="operateFile.php" method="get">
                    <input type="hidden" name="choosedFile"  value="<?php echo $filename;?>"/>
                    <input type="submit" name="submit" value="View"  />
                    <input type="submit" name="submit" value="Delete" />

                </form>
            </td>
        </tr>

    <?php
        }
    }
    closedir($handle);

    ?>
    </table>

    <!-- Upload file   -->
    <form enctype="multipart/form-data" action="uploader.php" method="post">
        <p>
            <input type="hidden" name="MAX_FILE_ZIDE" value="20000000"/>
            <label for="uploadfile_input">Choose a file to upload: </label>
            <input name="uploadedfile" type="file" id="uploadfile_input"/>
        </p>
        <p>
            <input type="submit" value="Upload File"/>
        </p>
    </form>
</body>
</html>