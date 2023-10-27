<?php
$servername = "localhost";
$username = "Jovalenci";
$password = "JovalenciIE4717";
$database = "moovlix";

$mysqli = new mysqli($servername, $username, $password, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if (isset($_GET['id'])) {
    $movieId = $_GET['id'];

    $query = "SELECT * FROM movie WHERE id = $movieId";
    $result = $mysqli->query($query);

    if ($result->num_rows > 0) {
        $movieDetails = $result->fetch_assoc();

        echo json_encode($movieDetails);
    } else {
        echo json_encode(array('error' => 'Movie not found'));
    }
} else {
    echo json_encode(array('error' => 'Missing movie ID'));
}

$mysqli->close();
?>
