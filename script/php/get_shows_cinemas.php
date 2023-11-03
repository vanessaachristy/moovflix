<?php
$servername = "localhost";
$username = "root";
$database = "moovlix";

$mysqli = new mysqli($servername, $username, '', $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if (isset($_GET['id'])) {
    $cinemaId = $_GET['id'];

    $query = "SELECT * FROM shows WHERE screenID = $cinemaId";
    $result = $mysqli->query($query);

    if ($result->num_rows > 0) {
        $cinemaShows = array(); 
        while ($row = $result->fetch_assoc()) {
            $cinemaShows[] = $row;  
        }

        echo json_encode($cinemaShows);
    } else {
        echo json_encode(array('error' => 'Shows not found'));
    }
} else {
    echo json_encode(array('error' => 'Missing cinema ID'));
}

$mysqli->close();
?>
