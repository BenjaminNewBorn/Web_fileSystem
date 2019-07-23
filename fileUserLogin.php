<?php
session_start();
session_unset();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FileSystemUserLogin</title>

    <script lang="javascript">
        function checkusername (form) {
            if(userform.username.value == "") {
                alert("Please input username!");
                userform.username.focus();
                return false;
            }
            return true;

        }

    </script>
</head>
<body>
    <h2>Please Login:</h2><br>
    <form id="userform" name="userinput" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post"  onsubmit=" return checkusername(this)">
        UserName:<input type="text" name="username"/><br>
        <!--
        <input type="hidden" name="_submitted" value="1">
        -->
        <input type="submit" value="Submit"/>
    </form>

    <?php

    if(isset($_POST['username'])) {
        $users = fopen("../users.txt", "r");
        while (!feof($users)) {
            $username = $_POST['username'];
            $h =trim(fgets($users));
            if($username == $h) {

                $_SESSION['check'] = true;
                $_SESSION['username'] = $username;
                header("Location:fileList.php");
                exit();
            }else {
                continue;
            }
        }
        echo "Please enter a correct username!";
        fclose($users);
    }
    /*
     else {
        if(isset($_POST['_submitted'])) {
            printf("Username cannot be null");
        }
    }
     */


    ?>



</body>
</html>