<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postID = $_POST['postID'];
}

 

require "dbConnect.php";


	

	$query = "SELECT posts.username, comments.content, comments.usern FROM comments
	LEFT JOIN posts ON comments.postID = posts.postID
    WHERE comments.postID = $postID
	ORDER BY comments.postID DESC";
    $result = mysqli_query($connection, $query);
    
	$username = $_SESSION['username'];
    
    $query2 = "SELECT userimages.contentType, userimages.image, users.* FROM userimages
	LEFT JOIN users ON userimages.userID = users.userID 
	WHERE users.username = '$username'";
    $result2 = mysqli_query($connection, $query2);
	
	
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
		  <div class="user-buttons">
		<a href = "profile.php">
		  <?php 
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
			?>
		  </a>
		  <form action="logout.php" method="post" id="userbuttons">
				  <button type="submit" id="submitlogout">logout</button>
			  </form>
		</div>
	  </header>
	  <main style = "padding-bottom: 100px;">
		 
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
				$contenter = $row['content'];
				$usern = $row['usern'];

       			
	
                echo "<br><br>";
                echo "<p style='font-size: 1rem; color: white;'>@$usern</p>";
                echo "<p style='text-indent: 20px;'>$contenter</p>";
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

				if (isset($_SESSION['username'])) {
					
				  $usern = $_SESSION['username'];

                echo '<form action="processcomment.php" method="post" id="mainForm">';
				echo "<input type='hidden' name='postID' id='postID' value='$postID'>";
				echo "<input type='hidden' name='usern' id='usern' value='$usern'>";
                echo "Add a Comment: <br>";
                echo '<textarea id="comment" name="comment" rows="5" cols="46" placeholder="Enter a comment..."></textarea>';
				echo "<br><br>";
				echo '<input type="submit" id="commented">';
				echo "</form>";
				}else {
					echo '<p style="color: red;">YOU MUST LOGIN TO ADD A COMMENT</p>';
				}
            }
			?>
        </div>
	  </main>
	  <a href="javascript:history.back()">Go Back</a>
	  <footer >
	  <p>
		<button onclick="playSong()" style = "background-color: #ff00ff; color: #00ff00; font-size: 24px; padding: 10px 20px; border-radius: 50px; box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.3); text-transform: uppercase; transform: rotate(-15deg);background-color: #ff00ff; color: #00ff00; font-size: 10px; padding: 5px 10px; border-radius: 50px; box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.3); text-transform: uppercase; transform: rotate(-15deg);">gofroggygo
		</button>   &copy; 2023 Ribbit. All rights reserved.</p>
			  <audio id="song" src="song.mp3"></audio>
			  <script>
				  function playSong() {
					  var song = document.getElementById("song");
					  song.play();
				  }
	  			</script>
		 
	  </footer>
  </body>
  </html>