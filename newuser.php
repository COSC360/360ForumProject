<!DOCTYPE html>
<html>


<?php
error_reporting(E_ERROR | E_PARSE);

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["userImage"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["userImage"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}



// Check file size
if ($_FILES["userImage"]["size"] > 100000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "gif" ) {
  echo "Sorry, only JPG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["userImage"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["userImage"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["password-check"])) {

    

    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $passwordd = md5($_POST["password"]);
   
    $passwordy = $_POST["password"];
    $pcheck = $_POST["password-check"];



    if ($firstname == "" || $lastname == "" || $username == "" || $email == "" || $passwordy == "" || $pcheck == "" ) {
        header("Location: signup.php");
        exit;
    }
    if ($passwordy != $pcheck){
        header("Location: signup.php");
        exit;
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
        die("oh no connection failed :(".$connection->connect_error);
    }

    $query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
    $result = $connection->query($query);

  if ($result->num_rows > 0) {
    // User already exists
    echo "User already exists with this username and/or email<br>";
    header("Location: signup.php");
        exit;
  } else {
        //good connection, so do you thing
        $sql = "INSERT INTO users (firstname, lastname, username, email, password) VALUES ('$firstname', '$lastname', '$username', '$email', '$passwordd')";
        if ($connection->query($sql)=== TRUE) {
            echo "Yay new user was created!";
        } else{
            echo "error :(" .$sql . "<br>" .$connection->error;
        }
        $query2 = "SELECT userID FROM users WHERE username = '$username'";
        $result2 = mysqli_query($connection, $query2);
        if (mysqli_num_rows($result2) > 0) {
            $row = mysqli_fetch_assoc($result2);
            if (!is_null($row['userID'])) {
                $userID = $row['userID'];
                echo "The new user's userID is: " . $userID;
                $imagedata = file_get_contents($_FILES['userImage']['tmp_name']);
                //store the contents of the files in memory in preparation for upload
                $sql2 = "INSERT INTO userImages (userID, contentType, image) VALUES(?,?,?)";
                // create a new statement to insert the image into the table. Recall
                // that the ? is a placeholder to variable data.
                $stmt = mysqli_stmt_init($connection); //init prepared statement object
                mysqli_stmt_prepare($stmt, $sql2); // register the query
                $null = NULL;
                mysqli_stmt_bind_param($stmt, "isb", $userID, $imageFileType, $null);
                // bind the variable data into the prepared statement. You could replace
                // $null with $data here and it also works. You can review the details
                // of this function on php.net. The second argument defines the type of
                // data being bound followed by the variable list. In the case of the
                // blob, you cannot bind it directly so NULL is used as a placeholder.
                // Notice that the parametner $imageFileType (which you created previously)
                // is also stored in the table. This is important as the file type is
                // needed when the file is retrieved from the database.
                mysqli_stmt_send_long_data($stmt, 2, $imagedata);
                // This sends the binary data to the third variable location in the
                // prepared statement (starting from 0).
                $result3 = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
                // run the statement
                mysqli_stmt_close($stmt);
                header("Location: home_loggedin.php");
                exit;
            }
        } else {
            echo "Error: Could not retrieve userID";
        }

    }

    $connection->close();
    } elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    echo "Error wrong request method";
    }else{
    echo "Error wrong request method or missing paramters";
}
?>
</html>
