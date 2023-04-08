<?php
	error_reporting(E_ALL);
    ini_set('display_errors', 1);



	require "dbConnect.php";



	$query = "SELECT userimages.contentType, userimages.image, posts.* FROM users
	LEFT JOIN userimages ON users.userID = userimages.userID
	JOIN posts ON users.userID = posts.userID
	ORDER BY posts.postID DESC";
    $result = mysqli_query($connection, $query);
    

	

    $connection->close();


	?>

<!DOCTYPE html>
<html>
<head>
	<title>Ribbit</title>
	<link rel="stylesheet" href="ribbit.css" />
</head>
<body>
	<header>
		<a href = "#top">
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
		<p style="color: red;">YOU MUST LOGIN TO CREATE A POST</p>
		<div class="post">
		<?php 
		  if (mysqli_num_rows($result) > 0) {
		
			while ($row = mysqli_fetch_assoc($result)) {
				$title = $row['title'];
				$content = $row['Content'];
				$username = $row['username'];
				$postID = $row['postID'];

       			$profilePic = base64_encode($row['image']); 
        		$imageType = $row['contentType'];
       			$imageSrc = "data:image/$imageType;base64,$profilePic";
	

				echo '<form action="comment.php" method="post" id="comment">';
				echo "<h2><img src='$imageSrc' alt='bigboy' width='50' height='50' class = 'profile'>@$username</h2><br>";
				echo "<input type='hidden' name='imageSrc' id='imageSrc' value='$imageSrc'>";
				echo "<input type='hidden' name='username' id='username' value='$username'>";
				echo "<input type='hidden' name='postID' id='postID' value='$postID'>";
				echo "<p class = 'title'>$title</p>";
				echo "<input type='hidden' name='title' id='title' value='$title'>";
				echo "<p>$content</p>";
				echo "<input type='hidden' name='content' id='content' value='$content'>";
				
				echo '<button type="submit" id="submitcommment">Comments</button>';
				echo "</form>";
				echo "<hr>";
			}

		} else {
			echo "No posts yet :(";
		}
			?>
		</div>
	</main>
	<footer>
		<p>&copy; 2023 Ribbit. All rights reserved.</p>
	</footer>
</body>
</html>
