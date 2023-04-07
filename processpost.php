<?php
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

    $host = "localhost";
    $database = "lab9";
    $user = "webuser";
    $password = "P@ssw0rd";

    // $host = "cosc360.ok.ubc.ca";
    // $database = "db_48255368";
    // $user = "48255368";
    // $password = "48255368";

    $connection = mysqli_connect($host, $user, $password, $database);

    if ($connection->connect_error) {
      die("oh no connection failed :(" . $connection->connect_error);
    }

    $query = "SELECT userID FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $userID = $row['userID'];

    $sql = "INSERT INTO posts (userID, title, Content, username) VALUES (?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("isss", $userID, $title, $content, $username);

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
