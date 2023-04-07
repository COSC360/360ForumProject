<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postID = $_POST['postID'];
}

 

	$host = "localhost";
    $database = "lab9";
    $user = "webuser";
    $password = "P@ssw0rd";

    // $host = "cosc360.ok.ubc.ca";
    // $database = "db_48255368";
    // $user = "48255368";
    // $password = "48255368";

    $connection = mysqli_connect($host, $user, $password, $database);

    if ($connection->connect_error) {
      die("oh no connection failed :(" . $connection->connect_error);
    }


	

	$query = "SELECT posts.username, comments.content FROM comments
	LEFT JOIN posts ON comments.postID = posts.postID
    WHERE comments.postID = $postID
	ORDER BY comments.postID DESC";
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
		  
	  </header>
	  <main>
		 
		  <div class="post">
		  <?php 
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $imageSrc = $_POST['imageSrc'];
                $username = $_POST['username'];
                $title = $_POST['title'];
                $content = $_POST['content'];
            
            
                echo "<h2><img src='$imageSrc' alt='bigboy' width='50' height='50' class = 'profile'>@$username</h2><br>";
                echo "<p class = 'title'>$title</p>";
                echo "<p>$content</p>";
                echo "<br>";
                echo "<h3 style = 'color: #7289da;'>&#8595;COMMENTS&#8595;</h3>";

               
            }
			?>
            <?php 
		  if (mysqli_num_rows($result) > 0) {
		
			while ($row = mysqli_fetch_assoc($result)) {
				$content = $row['content'];
				$usernamer = $row['username'];

       			
	
                echo "<br><br>";
                echo "<p style='font-size: 1rem; color: white;'>@$usernamer</p>";
                echo "<p style='text-indent: 20px;'>$content</p>";
                echo "<br><br>";

			}

		} else {
			echo "No comments yet :(";
		}
			?>
		  </div>
          <div>
          <?php 
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $postID = $_POST['postID'];

                echo '<form action="processcomment.php" method="post" id="mainForm">';
				echo "<input type='hidden' name='postID' id='postID' value='$postID'>";
                echo "Add a Comment: <br>";
                echo '<textarea id="comment" name="comment" rows="5" cols="46" placeholder="Enter a comment..."></textarea>';
				echo "<br><br>";
				echo '<input type="submit" id="commented">';
				echo "</form>";
            }
			?>
        </div>
	  </main>
	  <footer>
		  <p>&copy; 2023 Ribbit. All rights reserved.</p>
	  </footer>
  </body>
  </html>