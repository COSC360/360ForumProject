<?php
$servername = "localhost";
$username = "48255368";
$password = "48255368";
$dbname = "db_48255368";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

session_start();
if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=? AND password=?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if (mysqli_num_rows($result) > 0){
        $_SESSION['email'] = $email;
        header('location:profile.php');
    }
    else
    {
        echo "<script>alert('Invalid Credentials');</script>";
    }
}
?>