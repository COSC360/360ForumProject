<!DOCTYPE html>
<html>


<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();


if (!isset($_SESSION['username'])) {
header('Location: login.php');
exit;
} else {

if ($_SERVER["REQUEST_METHOD"] == "POST" ) {

    $username = $_SESSION['username'];
    $oldpassword = md5($_POST["oldpassword"]);
    $newpassword = md5($_POST["newpassword"]);
    

    require "dbConnect.php";

    $query = "SELECT * FROM users WHERE username='$username' AND password='$oldpassword'";
    $result = $connection->query($query);

  if ($result->num_rows > 0) {
    // User already exists
    $sql = "UPDATE users SET password='$newpassword' WHERE username='$username'";
  if ($connection->query($sql) === TRUE) {
    header('Location: home_loggedin.php');
    exit;
  } else {
    echo "update didnt work :(" . $connection->error;
  }
} else {
  // Invalid username and/or password
  echo "username and/or password are invalid. :(";
  }

    $connection->close();
    } elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    echo "Error wrong request method";
    }else{
    echo "Error wrong request method or missing paramters";
}
}
?>
</html>
