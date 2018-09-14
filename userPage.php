<!DOCTYPE html>
<html lang="en">
<head>
  <title>User Page</title>
  <link type="text/css" rel="stylesheet" href="userPage.css">
</head>

<body>
  <?php
  session_start();
  //stops hackers from accessing other users' files by typing the specific URL
  if (!isset($_SESSION["username_session"])){
    echo "You have to login before you can see any files.";
    exit;
  }
  else {
    $username = $_SESSION["username_session"];
    $userDir = "/var/www/html/user_uploads/" . $username . "/";
    //lists the user's files
    $fileList = array_diff(scandir($userDir), array('.', '..')); 
      //https://stackoverflow.com/questions/15774669/list-all-files-in-one-directory-php
    $_SESSION["fileList"] = $fileList;
  ?>
  <p><strong><?php echo htmlentities($username); ?>'s Uploaded Files</strong></p>
  <?php 
    //lists user's files in a dropdown bar
    foreach ($fileList as $key => $value){
      echo htmlentities($value);
      echo "<br>";
    }
  }
  ?>
  <br>
  <form action="edit.php" method="POST">
    <select name="files">
      <?php
        foreach ($fileList as $key => $value){
          echo "<option value='$value'>$value</option>";
        } ?>
    </select>

    <input type="submit" name="open" value="Open File" />
    <input type="submit" name="remove" value="Remove File" />
    <input type="submit" name="rename" value="Rename File" />
    <br><br>
    <input type="submit" name="upload" value="Upload Files" />
    <br><br>
    <input type="submit" name="logout" value="Log Out of Account" />
  </form>
  
</body>


</html>