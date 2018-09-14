<!DOCTYPE html>
<html lang="en">
<head><title>Sign Up Page</title></head>
<body>
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="POST">
    <label for="newUser"><strong>New Username:</strong></label>
    <input type="text" name="newUser" id="newUser required="true" />
    <input type="submit" name="submit" value="Sign Up" />
</form>
    <?php
    if (isset($_POST["submit"])){
        $newUser = $_POST['newUser'];
        if( !preg_match('/^[\w_\.\-]+$/', $newUser) ){
            echo "Invalid username";
            exit;
        }
        //adds new username to 'user.txt' file
        file_put_contents("users.txt", $newUser."\n", FILE_APPEND);
        $dir_path = "/var/www/html/user_uploads/" . $newUser;
        //adds new user folder to the directory
        if (file_exists($dir_path)) {
            echo htmlentities("User already exists.");
        }
        else {
            mkdir($dir_path);
            echo htmlentities("User created!");
        }
    }
    ?>
<form action="LogIn.html">
    <input type="submit" value="Return to Log In">
</form>
</body>
</html>
