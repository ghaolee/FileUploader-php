<?php

session_start();
$alive = 0;

$username = $_GET['username'];
if( !preg_match('/^[\w_\.\-]+$/', $username) ){
	echo "Invalid Username";
	exit;
}
//$checkID = fopen("/home/donggyukim/SafeFolder/users.txt", "r");
$checkID = fopen("users.txt", "r");
//checks that username has been previously created and approved
while(!feof($checkID)){
    if(trim(fgets($checkID)) == $username){
        $_SESSION["username_session"] = $username;
        //echo "Access Granted!";
        header("Location: userPage.php");
        break;
    }
    if(feof($checkID)){
        echo "Access Denied!";
    }
}
fclose($checkID);



?>
