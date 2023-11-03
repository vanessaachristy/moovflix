<?php
$servername = "localhost";
$username = "root";
$database = "moovlix";

$mysqli = new mysqli($servername, $username, '', $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["email"])) {
    $email = $_GET["email"];

    $checkEmailQuery = "SELECT email FROM signup WHERE email=?";
    $stmt = $mysqli->prepare($checkEmailQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    $response = array("exists" => $result->num_rows > 0);
    echo json_encode($response);
} else {
    echo "Invalid request.";
}
?>
