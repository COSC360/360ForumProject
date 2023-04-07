
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();


if (isset($_SESSION['username'])) {
  header("Location: home_loggedin.php");
  exit;
}


 else {

  echo '


<!DOCTYPE html>
<html>
<head>
	<title>Ribbit</title>
	<link rel="stylesheet" href="ribbit.css" />
</head>
<body>
	<header>
		<a href = "home_loggedout.php">
		<img src="logo.png" alt="Frog Icon" width="50" height="50">
		</a>
		<h1>Ribbit</h1>
		<nav>
			
			
		<form action="search.php" method="post" id="search">
		<input type="text" placeholder="Search..." name="search" id="search">
		<button type="submit">Search</button>
	  </form>
			
		</nav>
		<div class="user-buttons">
			<form action="login.php" method="post" id="userbuttons">
				<button type="submit" id="submitlogin">login</button>
			</form>
			<form action="signup.php" method="post" id="userbuttons">
				<button type="submit" id="submitsignup">signup</button>
			</form>
		</div>
	</header>
	<main>
		<form method="post" action="processlogin.php" id="mainForm" >
			Username:<br>
			<input type="text" name="username" id="username" class="required">
			<br>
			Password:<br>
			<input type="password" name="password" id="password" class="required">
			<br>
			<br><br>
			<input type="submit" value="Login">
		  </form>
	</main>
	<footer>
		<p>&copy; 2023 Ribbit. All rights reserved.</p>
	</footer>
</body>
</html>

  ';
}
