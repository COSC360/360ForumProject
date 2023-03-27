<?php
$username = "username";
$email = "email@user.com";
$password = "password";


$url = 'https://cosc360.ok.ubc.ca/gmercier/360ForumProject';

// get the contents 
$html = file_get_contents($url);

// parse the HTML 
$doc = new DOMDocument();
@$doc->loadHTML($html);

// extract the content 
$username = $doc->getElementById('username')->textContent;
$topic = $doc->getElementById('topic')->textContent;
$content = $doc->getElementById('post')->textContent;

// connect to database
$servername = 'localhost';
$username = '48255368';
$password = '48255368';
$dbname = 'db_48255368';
$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}


$stmt = $conn->prepare("INSERT INTO posts (username, topic, content) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $topic, $content);


$stmt->execute();
$stmt->close();
$conn->close();



?>