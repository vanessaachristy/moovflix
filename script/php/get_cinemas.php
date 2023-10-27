<?php
$servername = "localhost";
$username = "root";
$database = "moovlix";

$mysqli = new mysqli($servername, $username, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Query to retrieve movie information
$query = "SELECT * FROM screen";
$result = $mysqli->query($query);
$cinemas = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cinemas[] = $row;
    }
}

$mysqli->close();

// Return movie information as JSON
echo json_encode($cinemas);
?>