<?php
session_start();

$bookingID = "";
// Access the session variable
if (isset($_SESSION['bookingID'])) {
    $bookingID = $_SESSION['bookingID'];
} else {
    echo '<script>console.log("Booking ID session variable not set.")</script>';
}

$servername = "localhost";
$username = "root";
$dbname = "moovflix";

// Create connection
$conn = new mysqli($servername, $username, '', $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo '<script>console.log("Connected")</script>';

$fetchBookingQuery = 'SELECT showID, seatID, referenceID FROM `Booking` WHERE referenceID = "' . $bookingID . '" ORDER BY seatID';
$bookingDetails = $conn->query($fetchBookingQuery);

$fetchPriceQuery = 'SELECT price, bookingID FROM `Seating` WHERE bookingID = "' . $bookingID . '" GROUP BY price, bookingID';
$priceDetails = $conn->query($fetchPriceQuery);

$screenName = "Golden Village JP";
$screenDate = date("Y-m-d");
$screenTime = date("H:i A");
$seatIDList = array();
$seatPrice = 0;
$bookingFee = 0.5;
$totalPayment = $bookingFee + count($seatIDList) * $seatPrice;

while ($row = mysqli_fetch_assoc($bookingDetails)) {
    array_push($seatIDList, $row["seatID"]);
}
;
while ($row = mysqli_fetch_assoc($priceDetails)) {
    $seatPrice = $row["price"];
    $totalPayment = $bookingFee + count($seatIDList) * $seatPrice;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $payment = $_POST["payment"];

    $updateBookingQuery = "UPDATE Booking SET name = '" . $name . "', email = '" . $email . "',  payment = '" . $payment . "'  WHERE referenceID = '" . $bookingID . "'";
    $result = $conn->query($updateBookingQuery);
    if ($result) {
        // If the update was successful, redirect to another page
        header('Location: http://localhost:8000/moovflix/booking-details/payment-details/payment-details-qr/index.php');
        exit; // Make sure to exit to prevent further script execution
    } else {
        // Handle the case where the update was not successful
        echo "Database update failed: " . mysqli_error($conn);
    }
    ;
}
;

$_SESSION["screenName"] = $screenName;
$_SESSION["screenDate"] = $screenDate;
$_SESSION["screenTime"] = $screenTime;
$_SESSION["seatIDList"] = $seatIDList;
$_SESSION["seatPrice"] = $seatPrice;
$_SESSION["bookingFee"] = $bookingFee;
$_SESSION["totalPayment"] = $totalPayment;





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
        <link rel="stylesheet" href="../../../common/index.css" />
        <link rel="stylesheet" href="../../../footer/index.css" />
        <link rel="stylesheet" href="index.css" />
        <link rel="stylesheet" href="../../index.css" />
        <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
        <script type="text/javascript" src='index.js'></script>
    </head>

    <header>
        Header
    </header>

    <body>
        <div class="booking-details">
            <div class="header">
                <span class="title">BOOKING DETAILS</span>
                <div class="content">
                    <div class="image">
                        <img src="../../../assets/john-wick.png" width="92" height="134" />
                    </div>
                    <div class="movie-detail">
                        <span class="movie-title" id="title">John Wick 4</span>
                        <span id="cinema-name"><img src='../../../assets/location.svg' class="icon" />
                            <?= $screenName ?>
                        </span>
                        <span id="show-date"><img src='../../../assets/calendar.svg' class="icon" />
                            <?= $screenDate ?>
                        </span>
                        <span id="show-time"><img src='../../../assets/time.svg' class="icon" />
                            <?= $screenTime ?>
                        </span>
                        <span id="tickets-total"><img src='../../../assets/ticket.svg' class="icon" />
                            <?= count($seatIDList) ?> Tickets
                        </span>
                        <span id="seat-numbers"><img src='../../../assets/seat.svg' class="icon" />
                            <?= implode(', ', $seatIDList) ?>
                        </span>

                    </div>
                    <div class="booking-detail">
                        <span class="total-title">Total Payment</span>
                        <span class="price-detail">Ticket Price <span id="ticket-price">$<?= $seatPrice ?>
                                x<?= count($seatIDList) ?></span></span>
                        <span class="price-detail">Booking Fee <span id="booking-fee">$<?= $bookingFee ?></span></span>
                        <span class="line"></span>
                        <span class="price-detail total-price">Total Price <span
                                id="total-price">$<?= $totalPayment ?></span></span>

                    </div>
                </div>
            </div>
            <div class="areas">
                <form id="payment-detail-form" method="POST" action="index.php" onsubmit="return validateInput()">
                    <div class="payment-detail-form">
                        <div class="input-field">
                            <span><label for="buyer-name">Name</label> <input type="name" id="buyer-name" name="name"
                                    placeholder="Enter your name here" required size="30"></span>
                            <span><label for="buyer-email">E-mail</label> <input type="email" id="buyer-email"
                                    name="email" placeholder="Enter your email here" required size="30"></span>
                        </div>
                        <div class="input-checkbox">
                            <label for="payment-method">Payment Method</label>
                            <div>
                                <span> <input type="radio" id="qrcode" name="payment" value="qrcode" checked>
                                    <label for="qrcode">Paynow/Paylah QR Code</label></span>
                                <span><input type="radio" id="card" name="payment" value="card">
                                    <label for="card">Visa/Master Credit Card</label><br></span>
                            </div>
                        </div>
                    </div>
                    <div class="payment-button">
                        <input class="payment-submit-button" id="payment-button" type="submit" value="MAKE PAYMENT" />
                    </div>
                </form>
            </div>

        </div>
    </body>
    <footer>
        <div class="content">
            <div class="left">
                <div class="logo">
                    <img src='../../../assets/moovflixLogo.svg' />
                </div>
                <div class="social">
                    <img src='../../../assets/facebook.svg' />
                    <img src='../../../assets/mail.svg' />
                    <img src='../../../assets/twitter.svg' />
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