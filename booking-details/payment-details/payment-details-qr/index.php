<?php
require "../../../mail_patch.php";
use function mail_patch\mail;

session_start();

$bookingID = "";
$screenName = "Golden Village JP";
$screenDate = date("Y-m-d");
$screenTime = date("H:i A");
$seatIDList = array();
$seatPrice = 0;
$bookingFee = 0.5;
$totalPayment = $bookingFee + count($seatIDList) * $seatPrice;
$name = "";
$email = "";
$payment = "";
$showID = "";



// Access the session variable
$bookingID = $_SESSION['bookingID'];
$seatIDList = $_SESSION["seatSelections"];
$seatPrice = $_SESSION["seatPrice"];
$bookingFee = $_SESSION["bookingFee"];
$totalPayment = $_SESSION["totalPayment"];
$name = $_SESSION["name"];
$email = $_SESSION["email"];
$payment = $_SESSION["payment"];
$showID = $_SESSION['showID'];
$screenName = $_SESSION['cinemaName'];
$screenDate = $_SESSION['showDate'];
$screenTime = $_SESSION['showTime'];
$movieName = $_SESSION['movieName'];
$moviePoster = $_SESSION['moviePoster'];

$today = date('Y-m-d');

// if (isset($_SESSION['bookingID']) && isset($_SESSION["screenName"]) && isset($_SESSION["screenDate"]) && isset($_SESSION["screenTime"]) && isset($_SESSION["seatSelections"]) && isset($_SESSION["seatPrice"]) && isset($_SESSION["bookingFee"]) && isset($_SESSION["totalPayment"]) && isset($_SESSION["name"]) && isset($_SESSION["email"]) && isset($_SESSION["payment"]) && isset($_SESSION['showID'])) {
//     $bookingID = $_SESSION['bookingID'];
//     $screenName = $_SESSION["screenName"];
//     $screenDate = $_SESSION["screenDate"];
//     $screenTime = $_SESSION["screenTime"];
//     $seatIDList = $_SESSION["seatSelections"];
//     $seatPrice = $_SESSION["seatPrice"];
//     $bookingFee = $_SESSION["bookingFee"];
//     $totalPayment = $_SESSION["totalPayment"];
//     $name = $_SESSION["name"];
//     $email = $_SESSION["email"];
//     $payment = $_SESSION["payment"];
//     $showID = $_SESSION['showID'];
// } else {
//     echo '<script>console.log("One or more session variables are not set.")</script>';
// }
// ;


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



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $timestamp = date("Y-m-d H:i:s");
    $ii = 0;
    while ($ii < count($seatIDList)) {

        $completeBookingQuery = "INSERT INTO Booking (showID, seatID, created, completed, referenceID, name, email, payment) VALUES ('$showID', '" . $seatIDList[$ii] . "', '$timestamp', 1, '$bookingID', '$name', '$email', '$payment')";
        $seatQuery = "UPDATE Seating SET available = 0, bookingID = '" . $bookingID . "' WHERE seatNumber = '" . $seatIDList[$ii] . "'";
        $result = $conn->query($completeBookingQuery);
        $seatResult = $conn->query($seatQuery);
        if ($result && $seatResult) {
            $ii++;
        } else {
            // Handle the case where the update was not successful
            echo "Database update failed: " . mysqli_error($conn);
        }
        ;
    }



    $to = $email;
    $subject = 'Booking Confirmation for Reference ID: ' . $bookingID . '';
    $message = "
<html>

    <head>
        <title>MoovFlix: Booking Acknowledgement Email</title>
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
        <p>Dear, <strong>$name</strong></p>
        <br />
        <p>Thank you for booking your favorite movie with us! Here is your booking reference ID:
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
                <td>Name</td>
                <td>$name</td>
            </tr>
            <tr>
                <td>Email</td>
                <td style='text-decoration: none; color: #fff;'>$email</td>
            </tr>
            <tr>
                <td>Cinema</td>
                <td>$screenName</td>
            </tr>
              <tr>
                <td>Movie</td>
                <td>$movieName</td>
            </tr>
            <tr>
                <td>Date & Time</td>
                <td>$screenDate $screenTime</td>
            </tr>
            <td>Seats</td>
            <td>" . implode(', ', $seatIDList) . "</td>
            </tr>
            <tfoot>
                <td>Total</td>
                <td>$totalPayment</td>
            </tfoot>
        </table>
        <br />
        <br />

        <p>Best regards,<br /><br />
            <h1 style='color: #F5CB5C; text-align: left;'>Moovlix</h1>
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

    // If the update was successful, redirect to another page
    $newUrl = str_replace('/booking-details/payment-details/payment-details-qr/index.php', '/success-booking/index.php', $_SERVER['REQUEST_URI']);
    header('Location: ' . $newUrl);
    exit; // Make sure to exit to prevent further script execution
    ;
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
        <title>MoovFlix: Payment</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="../../../header/index.css" />
        <link rel="stylesheet" href="../../../footer/index.css" />
        <link rel="stylesheet" href="../../index.css" />
        <link rel="stylesheet" href="index.css" />
        <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
        <script type="text/javascript" src='./index.js'></script>
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
                    <div class="top">
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
                                <?= count($seatIDList) ?> Tickets
                            </span>
                            <span id="seat-numbers"><img src='../../../assets/seat.svg' class="icon" />
                                <?= implode(', ', $seatIDList) ?>
                            </span>
                        </div>

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
                <?php
                if ($payment === 'qrcode') {
                    echo '
                         <div class="qr-display">
                    <span>Paynow/Paylah QR Code</span>
                    <div class="qr-image"><img src="../../../assets/mockQR.png" /></div>
                    <span id="booking-ID">Booking ID:' . $bookingID . '</span>
                    <span class="amount">$' . $totalPayment . '</span>

            </div>';
                } else {
                    echo ' <form">
                    <div class="card-detail-form">
                            <span><label for="name">Name on card</label> <input type="name" id="name" name="name"
                                    placeholder="Card owner name" required size="30"></span>
                              <span><label for="card-number">Card Number</label> <input type="text" onchange="validateCreditCard()" maxlength="16" id="card-number" name="card-number"
                                    placeholder="Card number" required size="16"></span>
                            <span><label for="cvv">CVV</label> <input  type="text" onchange="validateCVV()" maxlength="3" id="cvv" name="cvv"
                                    placeholder="CVV" required size="3"></span>
                              <span><label for="expiry">Expiry date</label> <input type="date" min=' . $today . ' id="expiry" name="expiry"
                                    ></span>
                    </div>
                    <br/>
                    <span id="booking-ID">Booking ID:' . $bookingID . '</span>
                  
                </form>';
                }
                ;

                ?>

                <form id="confirmPaymentForm" action="index.php" method="POST">
                    <input class="confirm-button" type="submit" name="confirmPayment" value="CONFIRM PAYMENT" />
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