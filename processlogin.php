<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


session_start();

if (isset($_SESSION['username'])) {
  header("Location: home_loggedin.php");
  exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $username = $_POST["username"];
  $passwordd = md5($_POST["password"]);

  if (empty($username) || empty($passwordd)) {
    header("Location: login.php");
    exit;
  } else {

    require "dbConnect.php";
    $query = $connection->prepare("SELECT * FROM users WHERE username=? AND password=?");
    $query->bind_param("ss", $username, $passwordd);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows === 1) {
      $_SESSION['username'] = $username;
      header("Location: home_loggedin.php");
      $connection->close();
      exit;
    } else {
      header("Location: login.php");
      $connection->close();
      exit;
      
    }
 
  }
} else {
  header("Location: login.php");
  exit;
}
?>
