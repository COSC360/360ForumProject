<?php
$host = "localhost";
$database = "lab9";
$user = "root";
$password = "";

// $host = "cosc360.ok.ubc.ca";
// $database = "db_48255368";
// $user = "48255368";
// $password = "48255368";

$connection = mysqli_connect($host, $user, $password, $database);

if ($connection->connect_error) {
  die("oh no connection failed :(" . $connection->connect_error);
}
?>