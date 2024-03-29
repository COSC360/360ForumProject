<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}else{

$username = $_SESSION['username'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {


  $content = $_POST["comment"];
  $postID = $_POST["postID"];
  $usern = $_POST["usern"];

  if (empty($content)) {
    header("Location: home_loggedin.php");
    exit;
  } else {

    require "dbConnect.php";


    $sql = "INSERT INTO comments (postID, content, usern) VALUES (?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("iss", $postID, $content, $usern);

    if ($stmt->execute()) {
        header("Location: home_loggedin.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();



    $connection->close();
  }
}else {
    header("Location: login.php");
    exit;
} 
}
?>
