<?php

session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to a page after session is destroyed (optional)
header("Location: http://localhost:8000/moovflix/booking-details/seating-page/index.php");
exit();
?>