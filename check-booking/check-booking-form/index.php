<?php 
   

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $bookingID = $_POST["bookingID"];

         $redirectUrl = 'moovflix/check-booking/check-booking-result/';
        echo '<script>window.location.pathname = "' . $redirectUrl . '";</script>';
        

    } else {
        
    }

/**
 * Validate email
 */
function validateEmail($email) {
    // Use a regular expression to validate the email address
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true; // Valid email address
    } else {
        return false; // Invalid email address
    }
}

/**
 * Validate bookingID
 */
function validateAlphanumericString($input) {
    // Use a regular expression to match a 24-character alphanumeric string
    if (preg_match('/^[a-zA-Z0-9]{24}$/', $input) === 1) {
        return true; // Valid alphanumeric string
    } else {
        return false; // Invalid
    }
}


?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Choose Seating</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="../../common/index.css" />
        <link rel="stylesheet" href="../../footer/index.css" />
        <link rel="stylesheet" href="index.css" />
        <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
        <script type="text/javascript" src='index.js'></script>
    </head>

    <header>
        Header
    </header>

    <body>
        <div class="check-booking-form">
            <div class="form-card">
                <div class="title">CHECK BOOKING</div>
                <div class="form">
                    <h3>Please enter your E-Mail and Booking ID to check.</h3>
                    <p>Booking ID is included in the confirmation e-mail that was sent upon successful booking.</p>
                    <form id="checkBookingForm" action="index.php" method="POST" onsubmit="return validateInput()">
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