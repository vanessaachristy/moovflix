<?php

session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to a page after session is destroyed (optional)
$newUrl = str_replace('/success-booking/logout.php', '/', $_SERVER['REQUEST_URI']);
header('Location: ' . $newUrl);
exit();
?>