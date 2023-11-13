<?php
require "../mail_patch.php";
use function mail_patch\mail;

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

$email = $_SESSION['email'];
$cinemaName = $_SESSION['cinemaName'];
$movieName = $_SESSION['movieName'];
$showDate = $_SESSION['showDate'];
$showTime = $_SESSION['showTime'];


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

    $to = $email;
    $subject = 'Update Booking Confirmation for Reference ID: ' . $bookingID . '';
    $message = "
<html>

    <head>
        <title>MoovFlix: Update Booking Acknowledgement Email</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                text-align: center;
                margin: 0;
                background-color: #1f222c;
            }

            p {
                font-size: 16px;
                text-align: left;
                color: #ffedbe;
            }

            table {
                border-collapse: collapse;
                text-align: center;

            }

            th,
            td {
                padding: 10px;
                border: 1px solid #000;
            }

            th {
                background-color: #F5CB5C;
            }

            td {
                background-color: #f2f2f2;
            }

            tfoot td {
                background-color: #F5CB5C;
            }
        </style>
    </head>

    <body style='background-color: #191B24;'>
        <div style='background-color: black; padding: 12px;'>
            <h1 style='color:#F5CB5C'>MoovFlix</h1>
        </div>
           <div style='margin-left: 24px;'>
        <p>Dear, <strong>$email</strong></p>
        <br />
        <p>Your booking ID with reference ID below has been updated:
        </p>
        <div style='background-color: #F5CB5C; padding: 12px; border-radius: 12px; width: 30%;'>$bookingID</div>
        <p>Please kindly query in your booking ID and email if you wish to <strong>check</strong> or
            <strong>edit</strong> your booking in
        </p>
        <div style='background-color: #F5CB5C; padding: 12px; border-radius: 12px; width: 30%;'><a style='text-decoration: none; color: #fff;'
                href='http://localhost:8000/moovflix/check-booking/check-booking-form/index.php'>Check Booking</a></div>
        <br />

        <p>Here is a summary of your booking:</p>
        <table>
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>Email</td>
                <td style='text-decoration: none; color: #fff;'>$email</td>
            </tr>
            <tr>
                <td>Cinema</td>
                <td>$cinemaName</td>
            </tr>
             <tr>
                <td>Movie</td>
                <td>$movieName</td>
            </tr>
            <tr>
                <td>Date & Time</td>
                <td>$showDate $showTime</td>
            </tr>
            <td>Seats</td>
            <td>" . implode(', ', $selectedList) . "</td>
            </tr>
        </table>
        <br />
        <br />

        <p>Best regards,<br /><br />
            <h1 style='color: #F5CB5C; text-align: left;'>MoovFlix</h1>
        </p>
        </div>

    </body>

</html>
";
    $headers = 'From: moovflix@localhost' . "\r\n" .
        'Reply-To: moovflix@localhost' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    $headers .= "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";

    mail($to, $subject, $message, $headers);





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
        <title>MoovFlix: Success Update</title>
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
                <a href="../index.html">MOVIES</a>
                <a href="../cinema.html">CINEMAS</a>
                <a href="../check-booking/check-booking-form/index.php">CHECK BOOKING</a>
            </div>
        </div>
        <div class="copyright">Copyright &copy 2023 MoovFlix</div>

    </footer>

</html>