<?php

session_start();

$bookingID = "";
// Access the session variable
if (isset($_SESSION['bookingID'])) {
    $bookingID = $_SESSION['bookingID'];
} else {
    echo '<script>console.log("Booking ID session variable not set.")</script>';
}


?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <title>MoovFlix: Success Booking</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="../header/index.css" />
        <link rel="stylesheet" href="../footer/index.css" />
        <link rel="stylesheet" href="index.css" />
        <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
        <script type="text/javascript" src='./index.js'></script>
    </head>

    <div class="navigation">
        <a href="../../index.html"><img src="../img/logo.svg" class="logo"></a>
        <div class="links">
            <a href="../index.html"><img src="../img/movieslogo.svg"></a>
            <a href="../cinema.html"><img src="../img/cinemaslogo.svg"></a>
            <a href="../check-booking/check-booking-form/index.php"><img src="../img/checkbookinglogo.svg"></a>
        </div>
    </div>

    <body>
        <div class="success">
            <h1>Your booking is successfully created!</h1>
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