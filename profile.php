
<?php
	error_reporting(E_ALL);
    ini_set('display_errors', 1);

session_start();


if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
} else {



	require "dbConnect.php";


	$username = $_SESSION['username'];

    $query = "SELECT userimages.contentType, userimages.image, users.* FROM userimages
	LEFT JOIN users ON userimages.userID = users.userID 
	WHERE users.username = '$username'";
    $result = mysqli_query($connection, $query);
    
    $query2 = "SELECT userimages.contentType, userimages.image, users.* FROM userimages
	LEFT JOIN users ON userimages.userID = users.userID 
	WHERE users.username = '$username'";
    $result2 = mysqli_query($connection, $query2);
	
	
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
		  if (mysqli_num_rows($result) > 0) {
		
			while ($row = mysqli_fetch_assoc($result)) {
                $firstName = $row['firstName'];
                $lastName = $row['lastName'];
                $email = $row['email'];

       			$profilePic = base64_encode($row['image']); 
        		$imageType = $row['contentType'];
       			$imageSrc = "data:image/$imageType;base64,$profilePic";
	

                echo "<h2><img src='$imageSrc' alt='bigboy' width='50' height='50' class = 'profile' style ='overflow: hidden; object-fit: cover; object-position: center center;'>@$username</h2><br>";
                echo "<p>First Name: $firstName</p>";
                echo "<p>Last Name: $lastName</p>";
                echo "<p>Email: $email</p>";

                echo '<form action="changepassword.php" method="post" id="changepassword">';
                echo '<button type="submit" id="chnagepassword">Change Password</button>';
                echo "</form>";
			}

		} else {
			echo "No user found :(";
		}
			?>
		  </div>
	  </main>
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

 





