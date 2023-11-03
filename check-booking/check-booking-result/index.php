<?php

session_start();

$servername = "localhost";
$username = "root";
$dbname = "moovlix";

// Create connection
$conn = new mysqli($servername, $username, '', $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo '<script>console.log("Connected")</script>';

$email = "";
$bookingID = "";
$showID = "";
$seatIDs = array();
$isEmpty = true;

$cinemaID = 0;
$movieID = 0;
$showDate = "";
$showTime = "";
$cinemaName = "";
$movieName = "";
$moviePoster = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $bookingID = $_POST["bookingID"];
    $bookingQuery = "SELECT showID, seatID FROM Booking WHERE email = '" . $email . "' AND referenceID = '" . $bookingID . "'";
    $bookingData = $conn->query($bookingQuery);
    if ($bookingData) {
        while ($row = mysqli_fetch_assoc($bookingData)) {
            $showID = $row['showID'];
            array_push($seatIDs, $row["seatID"]);
        }
    }
    if (count($seatIDs) > 0) {
        $isEmpty = false;

        $showQuery = 'SELECT * from shows WHERE id ="' . $showID . '"';
        $showResults = $conn->query($showQuery);

        while ($row = mysqli_fetch_assoc($showResults)) {
            $cinemaID = $row["screenID"];
            $movieID = $row["movieID"];
            $showDate = explode(" ", $row["dates"])[0];
            $showTime = explode(" ", $row["dates"])[1];
        }

        $screenQuery = 'SELECT * from screen WHERE id = "' . $cinemaID . '"';
        $screenResults = $conn->query($screenQuery);
        while ($row = mysqli_fetch_assoc($screenResults)) {
            $cinemaName = $row['cinema_name'];
        }

        $movieQuery = 'SELECT * from movie WHERE id = "' . $movieID . '"';

        $movieResults = $conn->query($movieQuery);
        while ($row = mysqli_fetch_assoc($movieResults)) {
            $movieName = $row['movie_name'];
            $moviePoster = $row['poster'];
        }
    }
    ;
}
;

$elapsed = false;

// Convert the date to a timestamp
$timestampToCheck = strtotime($showDate);

if ($timestampToCheck !== false) {
    // Get the current timestamp
    $currentTimestamp = time();

    // Compare the two timestamps
    if ($timestampToCheck < $currentTimestamp) {
        $elapsed = true;
    }
} else {
    echo '<script>console.log("Invalid date format)</script>';
}

$_SESSION['seatSelections'] = $seatIDs;
$_SESSION['bookingID'] = $bookingID;


?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Choose Seating</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="../../header/index.css" />
        <link rel="stylesheet" href="../../footer/index.css" />
        <link rel="stylesheet" href="index.css" />
        <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
        <script type="text/javascript" src='index.js'></script>
    </head>

    <div class="navigation">
        <a href="../../index.html"><img src="../../img/logo.svg" class="logo"></a>
        <div class="links">
            <a href="../../index.html"><img src="../../img/movieslogo.svg"></a>
            <a href="../../cinema.html"><img src="../../img/cinemaslogo.svg"></a>
            <a href="index.php"><img src="../../img/checkbookinglogo.svg"></a>
        </div>
    </div>

    <body>
        <div class="check-booking-result">
            <h1>CHECK BOOKING</h1>
            <span class="email"><?= $email ?></span>
            <div class="booking-list">
                <?php
                if ($isEmpty) {
                    echo '<div class="not-found"><h3>Sorry, the booking you requested not found. Please kindly check if the details are correct.</h3>
                    <span>Email: ' . $email . '</span>
                    <span>BookingID: ' . $bookingID . '</span>
                    </div>';
                } else {
                    echo ' <div class="booking-card">
                    <div class="details">
                        <span>
                            <img src="../../assets/upcoming.svg" class="icon" /> Upcoming
                        </span>
                        <div class="details-group">
                            <div class="image">
                                <img src="../../' . $moviePoster . '" width="92" height="134" />
                            </div>
                            <div class="movie-detail">
                                <span class="movie-title" id="title">' . $movieName . '</span>
                                <span id="cinema-name">
                                    <img src="../../assets/location.svg" class="icon" />' . $cinemaName . '
                                </span>
                                <span id="show-date">
                                    <img src="../../assets/calendar.svg" class="icon" />' . $showDate . '
                                </span>
                                <span id="show-time">
                                    <img src="../../assets/time.svg" class="icon">' . $showTime . '
                </span>
                <span id="tickets-total">
                    <img src="../../assets/ticket.svg" class="icon">' . count($seatIDs) . ' Tickets
                </span>
                <span id="seat-numbers">
                    <img src="../../assets/seat.svg" class="icon">' . join(", ", $seatIDs) . '
                </span>
            </div>
        </div>
        </div>
        <div class="qr-code">
        ';
                    if (!$elapsed) {
                        echo ' <div onclick={editSeatingOnClick()} class="edit-btn">Edit booking <img src="../../assets/edit.svg"/></div>';
                    }
                    echo '
            <div class="qr-image">
                <img src="../../assets/mockQR.png" />
            </div>
            <span>Booking ID=' . $bookingID . '</span>
        </div>
        </div>';
                }
                ?>

            </div>
        </div>
    </body>
    <footer>
        <div class="content">
            <div class="left">
                <div class="logo">
                    <img src='../../assets/moovflixLogo.svg' />
                </div>
                <div class="social">
                    <img src='../../assets/facebook.svg' />
                    <img src='../../assets/mail.svg' />
                    <img src='../../assets/twitter.svg' />
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