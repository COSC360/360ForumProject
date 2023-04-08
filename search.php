
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {



	require "dbConnect.php";

	if (isset($_SESSION['username'])) {
		$username = $_SESSION['username'];
    
		$query2 = "SELECT userimages.contentType, userimages.image, users.* FROM userimages
		LEFT JOIN users ON userimages.userID = users.userID 
		WHERE users.username = '$username'";
		$result2 = mysqli_query($connection, $query2);
	}

	
    $keyword = $_POST['search'];
	$query = "SELECT userimages.contentType, userimages.image, posts.* FROM users
	LEFT JOIN userimages ON users.userID = userimages.userID
	JOIN posts ON users.userID = posts.userID
    WHERE posts.Content LIKE '%$keyword%' OR posts.title LIKE '%$keyword%'
	ORDER BY posts.postID DESC";
    $result = mysqli_query($connection, $query);



    $connection->close();
}

	?>




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
		  <?php 
		  if (isset($_SESSION['username'])) {
		  echo '<div class="user-buttons">';
			echo '<a href = "profile.php">';
		  
		  if (mysqli_num_rows($result2) > 0) {
		
			while ($row2 = mysqli_fetch_assoc($result2)) {


       			$profilePic = base64_encode($row2['image']); 
        		$imageType = $row2['contentType'];
       			$imageSrc = "data:image/$imageType;base64,$profilePic";
	

				echo "<img src='$imageSrc' alt='bigboy' width='40' height='40' class = 'profile' style ='overflow: hidden; object-fit: cover; object-position: center center;'>";

			}

		} else {
			echo "No user found :(";
		}
	}
			?>
		  </a>
		  <form action="logout.php" method="post" id="userbuttons">
				  <button type="submit" id="submitlogout">logout</button>
			  </form>
		</div>
	  </header>
	  <main>
		 
		  <div class="post">
		  <?php 
		  if (mysqli_num_rows($result) > 0) {
		
			while ($row = mysqli_fetch_assoc($result)) {
				$title = $row['title'];
				$content = $row['Content'];
				$username = $row['username'];

       			$profilePic = base64_encode($row['image']); 
        		$imageType = $row['contentType'];
       			$imageSrc = "data:image/$imageType;base64,$profilePic";
	

			
                   echo '<form action="comment.php" method="post" id="comment">';
                   echo "<h2><img src='$imageSrc' alt='bigboy' width='50' height='50' class = 'profile'>@$username</h2><br>";
                   echo "<input type='hidden' name='imageSrc' id='imageSrc' value='$imageSrc'>";
                   echo "<input type='hidden' name='username' id='username' value='$username'>";
                   echo "<p class = 'title'>$title</p>";
                   echo "<input type='hidden' name='title' id='title' value='$title'>";
                   echo "<p>$content</p>";
                   echo "<input type='hidden' name='content' id='content' value='$content'>";
                   
                   echo '<button type="submit" id="submitcommment">Comments</button>';
                   echo "</form>";
                   echo "<hr>";
			}

		} else {
			echo "No posts match your search :(";
		}
			?>
		  </div>
	  </main>
	  <footer>
		  <p>&copy; 2023 Ribbit. All rights reserved.</p>
	  </footer>
  </body>
  </html>
