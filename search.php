<!DOCTYPE html>
<html>
<?php
// Connect to the database
$servername = "localhost";
$username = "48255368";
$password = "48255368";
$dbname = "db_48255368";

$conn = new mysqli($servername, $username, $password, $dbname);

// Search the database for the keyword
$keyword = $_POST['keyword'];
$sql = "SELECT * FROM mytable WHERE content LIKE '%$keyword%'";
$result = $conn->query($sql);

// Display the search results
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "<a href='" . $row["url"] . "'>" . $row["title"] . "</a><br>";
  }
} else {
  echo "No results found.";
}

// Close the database connection
$conn->close();

?>
</html>