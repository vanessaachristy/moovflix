<?php 
   

?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Choose Seating</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="../common/index.css" />
        <link rel="stylesheet" href="../footer/index.css" />
        <link rel="stylesheet" href="index.css" />
        <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
        <script type="text/javascript" src='./index.js'></script>
    </head>

    <header>
        Header
    </header>

    <body>
        <div class="success">
            <h1>Your booking is successfully created!</h1>
            <p>Please check your email for a booking confirmation details. </p>
            <p>Booking ID: XXXXXXXXXXXX </p>
            <img src="../assets/check.svg" />
            <input class="home-button" type="button" value="BACK TO HOME" onclick={homeButtonOnClick()} />
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
                <a href="https://google.com">MOVIES</a>
                <a href="https://google.com">CINEMAS</a>
                <a href="https://google.com">CHECK BOOKING</a>
            </div>
        </div>
        <div class="copyright">Copyright &copy 2023 MoovFlix</div>

    </footer>

</html>