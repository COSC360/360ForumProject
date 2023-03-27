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
<span></span>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
        $(document).ready(function(){
            setInterval(function(){
                $(span).load('login.html')
            }, 2000);
        });
    </script>
</body>
</html>