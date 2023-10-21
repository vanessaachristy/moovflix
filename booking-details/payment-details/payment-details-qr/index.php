<?php 



    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $redirectUrl = 'moovflix/success-booking/';
        echo '<script>window.location.pathname = "' . $redirectUrl . '";</script>';

    } else {
        
    }




/**
 * Sanitize
 */
function sanitize($data) {
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
        <link rel="stylesheet" href="../../index.css" />
        <link rel="stylesheet" href="index.css" />
        <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
        <script type="text/javascript" src='./index.js'></script>
    </head>

    <header>
        Header
    </header>

    <body>
        <div class="booking-details">
            <div class="header">
                <span class="title">BOOKING DETAILS</span>
                <div class="content">
                    <div class="top">
                        <div class="image">
                            <img src="../../../assets/john-wick.png" width="92" height="134" />
                        </div>
                        <div class="movie-detail">
                            <span class="movie-title" id="title">John Wick 4</span>
                            <span id="cinema-name"><img src='../../../assets/location.svg' class="icon" />Cinema
                                Name</span>
                            <span id="show-date"><img src='../../../assets/calendar.svg' class="icon" />22 September,
                                2023</span>
                            <span id="show-time"><img src='../../../assets/time.svg' class="icon" />9.15 PM</span>
                            <span id="tickets-total"><img src='../../../assets/ticket.svg' class="icon" />2
                                Tickets</span>
                            <span id="seat-numbers"><img src='../../../assets/seat.svg' class="icon" />C12, C13</span>

                        </div>
                    </div>
                    <div class="booking-detail">
                        <span class="total-title">Total Payment</span>
                        <span class="price-detail">Ticket Price <span id="ticket-price">$16.00</span></span>
                        <span class="price-detail">Booking Fee <span id="booking-fee">$0.50</span></span>
                        <span class="line"></span>
                        <span class="price-detail total-price">Total Price <span id="total-price">$16.50</span></span>


                    </div>
                </div>
            </div>
            <div class="areas">
                <div class="qr-display">
                    <span>Paynow/Paylah QR Code</span>
                    <div class="qr-image"><img src="../../../assets/mockQR.png" /></div>
                    <span id="booking-ID">Booking ID: duKXT6bgXtYk6DjxRYxcF2Pf</span>
                    <span class="amount">$XX.XX</span>

                </div>
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
                <a href="https://google.com">MOVIES</a>
                <a href="https://google.com">CINEMAS</a>
                <a href="https://google.com">CHECK BOOKING</a>
            </div>
        </div>
        <div class="copyright">Copyright &copy 2023 MoovFlix</div>

    </footer>

</html>