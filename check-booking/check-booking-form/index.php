<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $bookingID = $_POST["bookingID"];

}
;
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
        <img src="../../img/logo.svg" class="logo">
        <div class="links">
            <a href="../../index.html"><img src="../../img/movieslogo.svg"></a>
            <a href="../../cinema.html"><img src="../../img/cinemaslogo.svg"></a>
            <a href="index.php"><img src="../../img/checkbookinglogo.svg"></a>
        </div>
    </div>

    <body>
        <div class="check-booking-form">
            <div class="form-card">
                <div class="title">CHECK BOOKING</div>
                <div class="form">
                    <h3>Please enter your E-Mail and Booking ID to check.</h3>
                    <p>Booking ID is included in the confirmation e-mail that was sent upon successful booking.</p>
                    <form id="checkBookingForm" action="../check-booking-result/index.php" method="POST"
                        onsubmit="return validateInput()">
                        <div class="input-field">
                            <span><label for="buyer-email">E-mail*</label> <input type="email" id="buyer-email"
                                    name="email" placeholder="Enter your email here" required size="30"></span>
                            <span><label for="booking-ID">Booking ID*</label> <input type="text" id="booking-ID"
                                    name="bookingID" placeholder="Enter your booking ID here" required size="30"></span>
                        </div>
                        <input type="submit" name="checkButton" class="check-button" value="CHECK" />
                    </form>
                </div>
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