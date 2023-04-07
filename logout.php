<?php
session_start();


if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// clear session and logout user
session_unset();
session_destroy();


if (isset($_SERVER['HTTP_REFERER'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    echo 'oopsy';
    //header('Location: index.php');
}
exit;
?>
