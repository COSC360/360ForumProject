<?php

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
