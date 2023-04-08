
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();


if (isset($_SESSION['username'])) {
  header("Location: home_loggedin.php");
  exit;
}


 ?>


  <!DOCTYPE html>
  <html>
  <head>
    <title>Ribbit</title>
    <link rel="stylesheet" href="ribbit.css" />
    <script type="text/javascript" src="scripts/index.js"></script>
    <script>
      function checkPasswordMatch(e) {
        var password = document.getElementById('password');
        var cPassword = document.getElementById('password-check');

        if (password.value != cPassword.value) {
          e.preventDefault();
          makeRed(password);
          makeRed(cPassword);
          alert("Passwords do not match! Please try again!");
          return false
        }
        return true;
        
      }
    </script>
  </head>
  <body>
    <header>
      <a href = "home_loggedout.php">
      <img src="logo.png" alt="Frog Icon" width="50" height="50">
      </a>
      <h1>Ribbit</h1>
      <nav>
        
        
      <form action="search.php" method="post" id="search" class="mainForm">
					  <input type="text" placeholder="Search..." name="search" id="search">
					  <button type="submit">Search</button>
					</form>
        
      </nav>
      <div class="user-buttons">
        <form action="login.php" method="post" id="userbuttons" class="mainForm">
				<button type="submit" id="submitlogin">login</button>
			  </form>
			  <form action="signup.php" method="post" id="userbuttons" class="mainForm">
				<button type="submit" id="submitsignup">signup</button>
			  </form>
      </div>
    </header>
    <main>
      <form method="post" action="newuser.php" id="mainForm" enctype="multipart/form-data" class="mainForm">
        First Name:<br>
        <input type="text" name="firstname" id="firstname" class="required">
        <br>
        Last Name:<br>
        <input type="text" name="lastname" id="lastname" class="required">
        <br>
        Username:<br>
        <input type="text" name="username" id="username" class="required">
        <br>
        email:<br>
        <input type="text" name="email" id="email" class="required">
        <br>
        Password:<br>
        <input type="password" name="password" id="password" class="required">
        <br>
        Re-enter Password:<br>
        <input type="password" name="password-check" id="password-check" class="required">
        <br>
        userImage:<br>
        <input type="file" name="userImage" id="userImage">
        <br><br>
        <input type="submit" value="Create New User">
        </form>
    </main>
    <footer>
      <p>&copy; 2023 Ribbit. All rights reserved.</p>
    </footer>
  </body>
  </html>




