<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['username'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $title = $_POST["title"];
  $content = $_POST["content"];

  if (empty($title) || empty($content)) {
    header("Location: post.php");
    exit;
  } else {

    require "dbConnect.php";

    $query = "SELECT userID FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $userID = $row['userID'];

    $sql = "INSERT INTO posts (userID, title, Content, username) VALUES (?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("iss", $userID, $title, $content, $username);

    if ($stmt->execute()) {
        header("Location: home_loggedin.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();



    $connection->close();
  }
} else {
  header("Location: login.php");
  exit;
}
?>
