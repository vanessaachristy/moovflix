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
    $cinemaId = $_GET['id'];

    $query = "SELECT * FROM screen WHERE id = $cinemaId";
    $result = $mysqli->query($query);

    if ($result->num_rows > 0) {
        $cinemaDetails = $result->fetch_assoc();

        echo json_encode($cinemaDetails);
    } else {
        echo json_encode(array('error' => 'Cinema not found'));
    }
} else {
    echo json_encode(array('error' => 'Missing cinema ID'));
}

$mysqli->close();
?>