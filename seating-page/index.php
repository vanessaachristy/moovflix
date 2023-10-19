<?php 

    $totalRows = 5;
    $totalColumns = 2;
    $totalEachRow = 10;
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Choose Seating</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="index.css" />
        <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    </head>

    <header>
        Header
    </header>

    <body>
        <div class="seating">
            <div class="header">
                <span class="title">BOOKING DETAILS</span>
                <div class="content">
                    <div class="image">
                        <img src="../assets/john-wick.png" width="92" height="134" />
                    </div>
                    <div class="movie-detail">
                        <span class="movie-title" id="title">John Wick 4</span>
                        <span id="cinema-name"><img src='../assets/location.svg' class="icon" />Cinema Name</span>
                        <span id="show-date"><img src='../assets/calendar.svg' class="icon" />22 September, 2023</span>
                        <span id="show-time"><img src='../assets/time.svg' class="icon" />9.15 PM</span>
                    </div>
                    <div class="booking-detail">
                        <span class="total-title">Total Booking</span>
                        <span id="total-tickets"><img src='../assets/ticket.svg' class="icon" />X Tickets</span>
                        <input id="proceed-btn" type="button" value="Proceed" />
                    </div>
                </div>
            </div>
            <div class="areas">
                <div class="trapezoid">
                    <span class="screen-display">SCREEN</span>
                </div>
                <div class="sections">
                    <div class='index-group'>
                        <?php
                            for ($i = $totalRows-1; $i >= 0; $i--) {
                                $char = chr($i + 65);
                                echo "<div class='index'>{$char}</div>";
                            }
                        ?>
                    </div>
                    <div class='column-group'>
                        <?php 
                        for ($x = 1; $x <= $totalColumns; $x++) {
                            echo '
                             <div class="column" id="'.$x.'">
                                ';
                                for ($y = 1; $y <= $totalRows; $y++) {
                                    $idx = $totalRows - $y;
                                    $rowIdx = chr($idx + 65);
                                      echo '
                                        <div class="row" id="'.$rowIdx.'">
                                            ';
                                            for ($z = 1; $z <= $totalEachRow; $z++) {
                                                $prefix = $totalEachRow * ($x-1);
                                                $seatIdx = $prefix + $z;
                                                echo '
                                                <div class="seat-box available" id="'.$rowIdx.''.$seatIdx.'"></div>
                                            ';
                                            }
                                            echo '
                                        </div>
                                    ';
                                };
                            echo '
                            </div>
                            ';
                        };
                    ?>
                    </div>


                </div>
                <div class="legend">
                    <div class="box">
                        <div class="unavailable"></div>
                        <span>UNAVAILABLE</span>
                    </div>
                    <div class="box">
                        <div class="selected"></div>
                        <span>SELECTED</span>
                    </div>
                    <div class="box">
                        <div class="available"></div>
                        <span>AVAILABLE</span>
                    </div>
                </div>
            </div>
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