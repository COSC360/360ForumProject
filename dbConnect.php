<?php
$host = "localhost";
$database = "db_48255368";
$user = "48255368";
$password = "48255368";



$connection = mysqli_connect($host, $user, $password, $database);

if ($connection->connect_error) {
  die("oh no connection failed :(" . $connection->connect_error);
}
?>