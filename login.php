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
    $sql ="SELECT * FROM User WHERE email='$email' && password='$password'";
    $result = mysqli_query($conn,$sql);
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