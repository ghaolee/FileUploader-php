<!DOCTYPE html>
<html>
<head>
  <title>Rename File</title>
</head>

<body>
  <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="POST">
    <?php
      session_start();
      $filePath = "/var/www/html/user_uploads/" . $_SESSION["username_session"]. "/";
      $renameFile = $_SESSION["renameFile"];
      $oldName = printf("Old Name: %s", $_SESSION["renameFile"]);
    ?>
    <br>
    <label for="newName"> New Name: </label>
    <input type="text" name="newName" id="newName"/>
    <input type="submit" name="submit" value="New Name" />
  </form>

  <?php
    if (isset($_POST["submit"])) {
      //rename the file
      if (rename($filePath.$renameFile, $filePath.$_POST["newName"])) {
        header("Location: userPage.php");
      }
      else {
        echo "not renamed.";
      }
    }
  ?>
</body>
</html>