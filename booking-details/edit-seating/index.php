<?php



session_start();

$totalRows = 5;
$totalColumns = 2;
$totalEachRow = 10;

$servername = "localhost";
$username = "root";
$dbname = "moovlix";
$tablename = "Seating";

// Create connection
$conn = new mysqli($servername, $username, '', $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo '<script>console.log("Connected")</script>';

$seatSelections = $_SESSION['seatSelections'];
$totalSelected = count($seatSelections);
$bookingID = $_SESSION['bookingID'];
$email = $_SESSION['email'];
$cinemaName = $_SESSION['cinemaName'];
$movieName = $_SESSION['movieName'];
$showDate = $_SESSION['showDate'];
$showTime = $_SESSION['showTime'];
$moviePoster = $_SESSION['moviePoster'];


echo '<script>console.log("' . $bookingID . '")</script>';

echo '<script>window.onload = () => resetSelectedSeats(' . json_encode($seatSelections) . ')</script>';

$distinctRows = mysqli_query($conn, "SELECT DISTINCT rowNumber FROM " . $tablename . " ORDER BY rowNumber DESC");
$selectedList = array();
$price = 12.5;

$_SESSION['seatSelections'] = $seatSelections;
$_SESSION['totalSelected'] = $totalSelected;
$_SESSION['bookingID'] = $bookingID;
$_SESSION['email'] = $email;
$_SESSION['cinemaName'] = $cinemaName;
$_SESSION['movieName'] = $movieName;
$_SESSION['showDate'] = $showDate;
$_SESSION['showTime'] = $showTime;


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
        <link rel="stylesheet" href="../../header/index.css" />
        <link rel="stylesheet" href="../../footer/index.css" />
        <link rel="stylesheet" href="index.css" />
        <link rel="stylesheet" href="../index.css" />
        <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
        <script type="text/javascript" src='index.js'></script>
    </head>

    <div class="navigation">
        <img src="../../img/logo.svg" class="logo">
        <div class="links">
            <a href="../../index.html"><img src="../../img/movieslogo.svg"></a>
            <a href="../../cinema.html"><img src="../../img/cinemaslogo.svg"></a>
            <a href="../../check-booking/check-booking-form/index.php"><img src="../../img/checkbookinglogo.svg"></a>
        </div>
    </div>

    <body>
        <div class="booking-details">
            <form id="seatForm" method="POST" action="../../success-update/index.php" class="booking-details">
                <div class="header">
                    <span class="title">BOOKING DETAILS</span>
                    <div class="content">
                        <div class="image">
                            <img src="../../<?php echo $moviePoster; ?>" width="92" height="134" />
                        </div>
                        <div class="movie-detail">
                            <span class="movie-title" id="title"><?= $movieName ?></span>
                            <span id="cinema-name"><img src='../../assets/location.svg'
                                    class="icon" /><?= $cinemaName ?></span>
                            <span id="show-date"><img src='../../assets/calendar.svg'
                                    class="icon" /><?= $showDate ?></span>
                            <span id="show-time"><img src='../../assets/time.svg' class="icon" /><?= $showTime ?></span>
                        </div>
                        <div class="booking-detail">
                            <span class="total-title">Total Booking</span>
                            <span><img src='../../assets/ticket.svg' class="icon" /><span id="total-tickets">0
                                    Tickets</span></span>
                            <input class="proceed-btn" id="proceed-btn" type="submit" value="Proceed" />

                        </div>
                    </div>
                </div>
                <div class="areas">
                    <div class="trapezoid">
                        <span class="screen-display">SCREEN</span>
                    </div>
                    <div class="sections">
                        <div class='index-group'>
                            <?php
                            while ($row = mysqli_fetch_assoc($distinctRows)) {

                                echo "<div class='index'>{$row['rowNumber']}</div>";
                            }
                            ;
                            ?>
                        </div>
                        <div class='column-group'>
                            <?php
                            $allRows = mysqli_query($conn, "SELECT * FROM " . $tablename . " ORDER BY rowNumber DESC");

                            for ($x = 1; $x <= $totalColumns; $x++) {
                                $distinctRows = mysqli_query($conn, "SELECT DISTINCT rowNumber FROM " . $tablename . " ORDER BY rowNumber DESC");
                                echo '
                             <div class="column" id="' . $x . '">
                                ';
                                while ($row = mysqli_fetch_assoc($distinctRows)) {
                                    echo '
                                        <div class="row" id="' . $row["rowNumber"] . '" onchange={onRowChange()}>
                                            ';
                                    $eachRows = mysqli_query($conn, "SELECT * FROM $tablename WHERE rowNumber = '" . $row["rowNumber"] . "' AND seatIdx <= " . ($x * $totalEachRow) . " AND seatIdx > " . (($x - 1) * $totalEachRow) . " ORDER BY seatIdx DESC");
                                    $eachRowIdx = 0;
                                    while ($eachRow = mysqli_fetch_assoc($eachRows)) {
                                        $idx = $eachRow["seatIdx"];
                                        if ($idx <= $x * 10) {
                                            if ($eachRow['available'] == 1) {
                                                echo '
                                                <div id="' . $eachRow['seatNumber'] . '" onclick={onSeatSelected(' . $eachRow['seatNumber'] . ',' . json_encode($seatSelections) . ')} onmouseover={onSeatHover(' . $eachRow['seatNumber'] . ')} onmouseleave={onSeatHoverEnd(' . $eachRow['seatNumber'] . ')} class="seat-box available"><span>' . $eachRow['seatNumber'] . '</span><input id="input-' . $eachRow['seatNumber'] . '" name="seat[]" value="" readOnly></input></div>
                                            ';
                                            } else {
                                                echo '
                                                <div id="' . $eachRow['seatNumber'] . '" onclick={onSeatSelected(' . $eachRow['seatNumber'] . ',' . json_encode($seatSelections) . ')} onmouseover={onSeatHover(' . $eachRow['seatNumber'] . ')} onmouseleave={onSeatHoverEnd(' . $eachRow['seatNumber'] . ')} class="seat-box unavailable"><span>' . $eachRow['seatNumber'] . '</span><input id="input-' . $eachRow['seatNumber'] . '" name="seat[]" value="" readOnly></input></div>
                                            ';
                                            }

                                        }
                                    }
                                    ;
                                    echo '</div>';

                                }
                                ;
                                echo '
                            </div>
                            ';
                            }
                            ;
                            ?>
                        </div>
                    </div>
                    <div class="legend">
                        <div class="box">
                            <div class="unavailable"></div>
                            <span>UNAVAILABLE</span>
                        </div>
                        <div class="box">
                            <div class="selected"></div>
                            <span>SELECTED</span>
                        </div>
                        <div class="box">
                            <div class="available"></div>
                            <span>AVAILABLE</span>
                        </div>
                    </div>
                </div>
            </form>

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