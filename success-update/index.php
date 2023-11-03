<?php

session_start();

$servername = "localhost";
$username = "root";
$dbname = "moovlix";

// Create connection
$conn = new mysqli($servername, $username, '', $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo '<script>console.log("Connected")</script>';

$seatSelections = $_SESSION['seatSelections'];

echo "<script>console.log('" . json_encode($seatSelections) . "');</script>";

$bookingID = $_SESSION['bookingID'];
$totalSelected = $_SESSION['totalSelected'];
$selectedList = array();
$cnt = 0;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    for ($ii = 0; $ii < count($seatSelections); $ii++) {
        $oldSeatQuery = "UPDATE Seating SET available = 1, bookingID = NULL WHERE seatNumber = '" . $seatSelections[$ii] . "'";
        $conn->query($oldSeatQuery);
    }

    for ($ii = 0; $ii < count($_POST["seat"]); $ii++) {
        $selected = strlen($_POST["seat"][$ii]) > 0;
        if ($selected == 1) {
            array_push($selectedList, $_POST["seat"][$ii]);
            $seatNumber[$ii] = $_POST["seat"][$ii];

            $newSeatQuery = "UPDATE Seating SET available = 0, bookingID = '" . $bookingID . "' WHERE seatNumber = '" . $seatNumber[$ii] . "'";
            $newBookQuery = "UPDATE Booking SET seatID = '" . $seatNumber[$ii] . "' WHERE seatID = '" . $seatSelections[$cnt] . "' AND referenceID = '" . $bookingID . "'";
            $conn->query($newSeatQuery);
            $conn->query($newBookQuery);
            $cnt++;
        }
    }

} else {
    echo '<script>console.log("End.")</script>';
}

/**
 * Sanitize
 */
function sanitize($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Choose Seating</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="../header/index.css" />
        <link rel="stylesheet" href="../footer/index.css" />
        <link rel="stylesheet" href="index.css" />
        <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
        <script type="text/javascript" src='./index.js'></script>
    </head>

    <div class="navigation">
        <img src="../img/logo.svg" class="logo">
        <div class="links">
            <a href="../index.html"><img src="../img/movieslogo.svg"></a>
            <a href="../cinema.html"><img src="../img/cinemaslogo.svg"></a>
            <a href="../check-booking/check-booking-form/index.php"><img src="../img/checkbookinglogo.svg"></a>
        </div>
    </div>

    <body>
        <div class="success">
            <h1>Your seat details are successfully changed!</h1>
            <p>Please check your email for a booking confirmation details. </p>
            <p>Booking ID: <?= $bookingID ?> </p>
            <img src="../assets/check.svg" />
            <form action="logout.php" method="post">
                <input class="home-button" type="submit" value="BACK TO HOME" />
            </form>
        </div>
    </body>
    <footer>
        <div class="content">
            <div class="left">
                <div class="logo">
                    <img src='../assets/moovflixLogo.svg' />
                </div>
                <div class="social">
                    <img src='../assets/facebook.svg' />
                    <img src='../assets/mail.svg' />
                    <img src='../assets/twitter.svg' />
                </div>
            </div>
            <div class="right">
                <a href="https://google.com">MOVIES</a>
                <a href="https://google.com">CINEMAS</a>
                <a href="https://google.com">CHECK BOOKING</a>
            </div>
        </div>
        <div class="copyright">Copyright &copy 2023 MoovFlix</div>

    </footer>

</html>