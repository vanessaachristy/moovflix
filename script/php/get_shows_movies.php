<?php
$servername = "localhost";
$username = "root";
$database = "moovlix";

$mysqli = new mysqli($servername, $username, '', $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if (isset($_GET['id'])) {
    $movieId = $_GET['id'];

    $query = "SELECT * FROM shows WHERE movieID = $movieId";
    $result = $mysqli->query($query);

    if ($result->num_rows > 0) {
        $movieShows = array(); 
        while ($row = $result->fetch_assoc()) {
            $movieShows[] = $row;  
        }

        echo json_encode($movieShows);
    } else {
        echo json_encode(array('error' => 'Shows not found'));
    }
} else {
    echo json_encode(array('error' => 'Missing movie ID'));
}

$mysqli->close();
?>
