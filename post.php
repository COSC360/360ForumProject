
<!DOCTYPE html>
<html>
<head>
	<title>Ribbit</title>
	<link rel="stylesheet" href="ribbit.css" />
</head>
<body>
	<header>
		<a href = "home_loggedin.php">
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
		<form method="post" action="processpost.php" id="mainForm" >
			Title: <br>
			<textarea id="title" name="title" rows="5" cols="46" placeholder="Enter a title..."></textarea>
			<br>
			Content:<br>
			<textarea id="content" name="content" rows="10" cols="46" placeholder="Enter your content..."></textarea>
			<br><br>
			<input type="submit" id="posted">
		  </form>
	</main>
	<footer>
		<p>&copy; 2023 Ribbit. All rights reserved.</p>
	</footer>
</body>
</html>


