<?php
  if (!isset($_SESSION)){
    session_start();
  }
  //stops hackers from accessing other users' files by typing the specific URL
  if (!isset($_SESSION["username_session"])){
    echo "You have to login before you can see any files.";
    exit;
  }
  
  //creating file path
  if (isset($_POST["files"])) {
    $file = $_POST["files"];
    $user = $_SESSION["username_session"];
    $file_path = "/var/www/html/user_uploads/" . $user . "/" . $file;


    // open file
    if (isset($_POST["open"])) {
      $finfo = new finfo(FILEINFO_MIME_TYPE);
      $mime = $finfo->file($file_path);
      if ($mime == 'image/jpeg' or $mime == 'application/pdf' or $mime == 'image/png') {
        header("Content-Type: ".$mime);
        readfile($file_path);
      }
      elseif (file_exists($file_path)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($file_path).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_path));
        readfile($file_path);
      exit;
      }
    }


    //remove file
    if (isset($_POST["remove"])) {
      if (file_exists("$file_path")){
        unlink("$file_path");
        header("Location: userPage.php");
        exit;
      }
      else {
        echo "File not removed.";
      }
    }
  }

  //upload button
  if (isset($_POST["upload"])) {
    header("Location: Upload.html");
    exit;
  }

  //logout button
  if (isset($_POST["logout"])) {
    session_destroy();
    header("Location: LogIn.html");
    exit;
  }

  //rename button
  if (isset($_POST["rename"])){
    $_SESSION["renameFile"] = $file;
    header("Location: rename.php");
    exit;
  }

?>