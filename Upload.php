
<?php
  session_start();
  //stops hackers from accessing other users' files by typing the specific URL
  if (!isset($_SESSION["username_session"])){
    echo "You have to login before you can see any files.";
    exit;
  }
  if (isset($_POST['submit'])) {
    $file = $_FILES['fileToUpload'];
    $fileName = $_FILES['fileToUpload']['name'];
    $fileTempLoc = $_FILES['fileToUpload']['tmp_name'];
    $fileDestination = '/var/www/html/user_uploads/'.$_SESSION["username_session"].'/'.$fileName;

    //check for errors and already uploaded files
    if ($_FILES['fileToUpload']['error'] === 0){
      if (file_exists($fileDestination)){
        echo htmlentities("Sorry the file you uploaded already exists. Please change its name and try again. <br><br>");
        echo htmlentities("<form action='Upload.html' method='POST'> <input type='submit' name='return' value='Return' /> </form.");
      }
      else {
        //moves the file to destination
        move_uploaded_file($fileTempLoc, $fileDestination);
        header("Location: userPage.php");
      }
    }
    else {
      echo "There was an error uploading your file. Please check your file and try again.";
    }

  }
?>