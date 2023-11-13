<?php
session_start();

$bookingID = "";
$seatSelections = array();
$showID = "";
$seatPrice = 0;
// Access the session variable
if (isset($_SESSION['bookingID'])) {
    $bookingID = $_SESSION['bookingID'];
    $seatSelections = $_SESSION['seatSelections'];
    $showID = $_SESSION['showID'];
    $seatPrice = $_SESSION['seatPrice'];
} else {
    echo '<script>console.log("Booking ID session variable not set.")</script>';
}

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

// $fetchBookingQuery = 'SELECT showID, seatID, referenceID FROM `Booking` WHERE referenceID = "' . $bookingID . '" ORDER BY seatID';
// $bookingDetails = $conn->query($fetchBookingQuery);

// $fetchPriceQuery = 'SELECT price, bookingID FROM `Seating` WHERE bookingID = "' . $bookingID . '" GROUP BY price, bookingID';
// $fetchPriceQuery = 'SELECT price FROM `Seating` WHERE seatNumber = "' . $seatSelections[0] . '" GROUP BY price';
// $priceDetails = $conn->query($fetchPriceQuery);

$screenName = $_SESSION['cinemaName'];
$screenDate = $_SESSION['showDate'];
$screenTime = $_SESSION['showTime'];
$movieName = $_SESSION['movieName'];
$moviePoster = $_SESSION['moviePoster'];
$seatIDList = $seatSelections;
$bookingFee = 0.5;
$totalPayment = $bookingFee + count($seatIDList) * $seatPrice;
$name = "";
$email = "";
$payment = "";



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $payment = $_POST["payment"];
    $_SESSION["seatSelections"] = $seatIDList;
    $_SESSION["bookingID"] = $bookingID;
    $_SESSION["screenName"] = $screenName;
    $_SESSION["screenDate"] = $screenDate;
    $_SESSION["screenTime"] = $screenTime;
    $_SESSION["seatPrice"] = $seatPrice;
    $_SESSION["bookingFee"] = $bookingFee;
    $_SESSION["email"] = $email;
    $_SESSION["name"] = $name;
    $_SESSION["totalPayment"] = $totalPayment;
    $_SESSION["payment"] = $payment;
    $_SESSION["showID"] = $showID;
    $_SESSION["movieName"] = $movieName;
    $_SESSION["moviePoster"] = $moviePoster;

    // $updateBookingQuery = "UPDATE Booking SET name = '" . $name . "', email = '" . $email . "',  payment = '" . $payment . "'  WHERE referenceID = '" . $bookingID . "'";
    // $result = $conn->query($updateBookingQuery);

    // If the update was successful, redirect to another page
    $newUrl = str_replace('/payment-details-form/index.php', '/payment-details-qr/index.php', $_SERVER['REQUEST_URI']);
    header('Location: ' . $newUrl);
    exit;

}
;

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
        <title>MoovFlix: Payment Details</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="../../../header/index.css" />
        <link rel="stylesheet" href="../../../footer/index.css" />
        <link rel="stylesheet" href="index.css" />
        <link rel="stylesheet" href="../../index.css" />
        <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
        <script type="text/javascript" src='index.js'></script>
    </head>


    <div class="navigation">
        <a href="../../index.html"><img src="../../../img/logo.svg" class="logo"></a>
        <div class="links">
            <a href="../../../index.html"><img src="../../../img/movieslogo.svg"></a>
            <a href="../../../cinema.html"><img src="../../../img/cinemaslogo.svg"></a>
            <a href="../../../check-booking/check-booking-form/index.php"><img
                    src="../../../img/checkbookinglogo.svg"></a>
        </div>
    </div>

    <body>
        <div class="booking-details">
            <div class="header">
                <span class="title">BOOKING DETAILS</span>
                <div class="content">
                    <div class="image">
                        <img src="../../../<?php echo $moviePoster; ?>" width="92" height="134" />
                    </div>
                    <div class="movie-detail">
                        <span class="movie-title" id="title"><?= $movieName ?></span>
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
                            <?= count($seatSelections) ?> Tickets
                        </span>
                        <span id="seat-numbers"><img src='../../../assets/seat.svg' class="icon" />
                            <?= implode(', ', $seatSelections) ?>
                        </span>

                    </div>
                    <div class="booking-detail">
                        <span class="total-title">Total Payment</span>
                        <span class="price-detail">Ticket Price <span id="ticket-price">$<?= $seatPrice ?>
                                x<?= count($seatIDList) ?></span></span>
                        <span class="price-detail">Booking Fee <span id="booking-fee">$<?= $bookingFee ?></span></span>
                        <span class="line"></span>
                        <span class="price-detail total-price">Total Price <span id="total-price">$<?= $totalPayment
                            ?></span></span>

                    </div>
                </div>
            </div>
            <div class="areas">
                <form id="payment-detail-form" method="POST" action="index.php" onsubmit="return validateInput()">
                    <div class="payment-detail-form">
                        <div class="input-field">

                            <span><label for="buyer-name">Name</label>
                                <input type="name" id="buyer-name" name="name" placeholder="Enter your name here"
                                    required size="30">
                            </span>
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
                <a href="../../../index.html">MOVIES</a>
                <a href="../../../cinema.html">CINEMAS</a>
                <a href="../../../check-booking/check-booking-form/index.php">CHECK BOOKING</a>
            </div>
        </div>
        <div class="copyright">Copyright &copy 2023 MoovFlix</div>

    </footer>

</html>