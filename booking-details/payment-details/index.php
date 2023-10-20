<?php 

    // $totalRows = 5;
    // $totalColumns = 2;
    // $totalEachRow = 10;
   
    // if($_SERVER["REQUEST_METHOD"] == "POST") {
    //     $selectedList=array();
    //     for ($ii = 0; $ii < count($_POST["seat"]); $ii++) {
    //     $selected = strlen($_POST["seat"][$ii]) > 0;
    //     if ($selected == 1) {
    //             array_push($selectedList,$_POST["seat"][$ii] );
    //         }
    //     }
    //     echo "<script>console.log(JSON.parse('" . json_encode($selectedList) . "'));</script>";

    // } else {
    // echo '<script>console.log("End.")</script>';
    // }

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
        <link rel="stylesheet" href="index.css" />
        <link rel="stylesheet" href="../index.css" />
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
                    <div class="image">
                        <img src="../../assets/john-wick.png" width="92" height="134" />
                    </div>
                    <div class="movie-detail">
                        <span class="movie-title" id="title">John Wick 4</span>
                        <span id="cinema-name"><img src='../../assets/location.svg' class="icon" />Cinema Name</span>
                        <span id="show-date"><img src='../../assets/calendar.svg' class="icon" />22 September,
                            2023</span>
                        <span id="show-time"><img src='../../assets/time.svg' class="icon" />9.15 PM</span>
                        <span id="tickets-total"><img src='../../assets/ticket.svg' class="icon" />2 Tickets</span>
                        <span id="seat-numbers"><img src='../../assets/seat.svg' class="icon" />C12, C13</span>

                    </div>
                    <div class="booking-detail">
                        <span class="total-title">Total Payment</span>
                        <span class="price-detail">Ticket Price <span id="ticket-price">$16.00</span></span>
                        <span class="price-detail">Booking Fee <span id="booking-fee">$0.50</span></span>
                        <span class="line"></span>
                        <span class="price-detail total-price">Total Price <span id="total-price">$16.50</span></span>
                        <input class="proceed-btn" id="proceed-btn" type="submit" value="Proceed" />

                    </div>
                </div>
            </div>
            <div class="areas">
                <form id="payment-detail-form">
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
                                <span> <input type="checkbox" id="qrcode" name="qrcode" value="qrcode">
                                    <label for="qrcode">Paynow/Paylah QR Code</label></span>
                                <span><input type="checkbox" id="card" name="card" value="card">
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