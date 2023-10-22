<?php 

    $totalRows = 5;
    $totalColumns = 2;
    $totalEachRow = 10;

    $servername = "localhost";
    $username = "root";
    $dbname = "moovflix";
    $tablename = "Seating";

    // Create connection
    $conn = new mysqli($servername, $username, '', $dbname);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    echo '<script>console.log("Connected")</script>';

    $distinctRows = mysqli_query($conn, "SELECT DISTINCT rowNumber FROM ".$tablename." ORDER BY rowNumber DESC");  
   
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $selectedList=array();
        for ($ii = 0; $ii < count($_POST["seat"]); $ii++) {
        $selected = strlen($_POST["seat"][$ii]) > 0;
        if ($selected == 1) {
                array_push($selectedList,$_POST["seat"][$ii] );
            }
        }
        echo "<script>console.log(JSON.parse('" . json_encode($selectedList) . "'));</script>";

    } else {
    echo '<script>console.log("End.")</script>';
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

mysqli_close($conn);

?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Choose Seating</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="../../common/index.css" />
        <link rel="stylesheet" href="../../footer/index.css" />
        <link rel="stylesheet" href="index.css" />
        <link rel="stylesheet" href="../index.css" />
        <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
        <script type="text/javascript" src='index.js'></script>
    </head>

    <header>
        Header
    </header>

    <body>
        <div class="booking-details">
            <form id="seatForm" method="POST" action="index.php" class="booking-details">

                <div class="header">
                    <span class="title">BOOKING DETAILS</span>
                    <div class="content">
                        <div class="image">
                            <img src="../../assets/john-wick.png" width="92" height="134" />
                        </div>
                        <div class="movie-detail">
                            <span class="movie-title" id="title">John Wick 4</span>
                            <span id="cinema-name"><img src='../../assets/location.svg' class="icon" />Cinema
                                Name</span>
                            <span id="show-date"><img src='../../assets/calendar.svg' class="icon" />22 September,
                                2023</span>
                            <span id="show-time"><img src='../../assets/time.svg' class="icon" />9.15 PM</span>
                        </div>
                        <div class="booking-detail">
                            <span class="total-title">Total Booking</span>
                            <span><img src='../../assets/ticket.svg' class="icon" /><span id="total-tickets">0
                                    Tickets</span></span>
                            <input class="proceed-btn" id="proceed-btn" type="submit" value="Proceed" />

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
                              while($row = mysqli_fetch_assoc($distinctRows)) {

                                echo "<div class='index'>{$row['rowNumber']}</div>";
                            };
                        ?>
                        </div>
                        <div class='column-group'>
                            <?php 
                            $allRows = mysqli_query($conn, "SELECT * FROM ".$tablename." ORDER BY rowNumber DESC");  
                          
                        for ($x = 1; $x <= $totalColumns; $x++) {
                            $distinctRows = mysqli_query($conn, "SELECT DISTINCT rowNumber FROM ".$tablename." ORDER BY rowNumber DESC");  
                            echo '
                             <div class="column" id="'.$x.'">
                                ';
                                while($row = mysqli_fetch_assoc($distinctRows)) {
                                        echo '
                                        <div class="row" id="'.$row["rowNumber"].'" onchange={onRowChange()}>
                                            ';
                                            $eachRows = mysqli_query($conn, "SELECT * FROM $tablename WHERE rowNumber = '" . $row["rowNumber"] . "' AND seatIdx <= " . ($x * $totalEachRow) . " AND seatIdx > " . (($x - 1) * $totalEachRow) . " ORDER BY seatIdx DESC");
                                            $eachRowIdx = 0; 
                                            while ($eachRow = mysqli_fetch_assoc($eachRows)) {
                                                $idx = $eachRow["seatIdx"];
                                                if ($idx <= $x*10) {
                                                     echo '
                                                <div id="'.$eachRow['seatNumber'].'" onclick={onSeatSelected('.$eachRow['seatNumber'].')} onmouseover={onSeatHover('.$eachRow['seatNumber'].')} onmouseleave={onSeatHoverEnd('.$eachRow['seatNumber'].')} class="seat-box"><span>'.$eachRow['seatNumber'].'</span><input id="input-'.$eachRow['seatNumber'].'" name="seat[]" value="" readOnly></input></div>
                                            ';
                                                }
                                            };
                                        echo '</div>';

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
            </form>

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