<?php
session_start();
if(!isset($_SESSION['email']))
{
    header('location:login.html');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Your Profile</title>
</head>
<body>
<h2>Welcome <?php echo $_SESSION['email']; ?></h2>
<a href="logout.php">Logout</a>
</body>
</html>