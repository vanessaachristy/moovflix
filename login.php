<?php
$servername = "localhost";
$username = "root";
$database = "moovlix";

$mysqli = new mysqli($servername, $username, '', $database);

$loginFailed = false;

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$showID = "";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $showID = $_GET["id"];
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM signup WHERE email = '$email'";
    $result = $mysqli->query($sql);

    $id = $_POST["id"];

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];
        if (password_verify($password, $hashedPassword)) {
            $name = $row['name'];
            echo "<script>localStorage.setItem('userName', '" . base64_encode($name) . "');</script>";
            echo "<script>localStorage.setItem('userEmail', '" . base64_encode($email) . "');</script>";
            echo "<script>console.log('" . $id . "');</script>";

            if (strlen($id) > 0) {
                echo '<script>window.location.href = "booking-details/seating-page/index.php?id=' . $id . '";</script>';
            } else {
                echo '<script>window.location.href = "index.html";</script>';

            }
            // header("Location: booking-details/seating-page/index.php?id=$id");
            exit;
        } else {
            $loginFailed = true;
        }
    } else {
        $loginFailed = true;
    }
}
?>


<!DOCTYPE html>
<html Lang="en">

    <head>
        <title>Moovlix</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="header/index.css">
        <link rel="stylesheet" href="footer/index.css" />
        <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
        <script type="text/javascript" src="script/js/form.js"></script>
    </head>

    <body>
        <div class="navigation">
            <a href="index.html"><img src="img/logo.svg" class="logo"></a>
            <div class="links">
                <a href="index.html"><img src="img/movieslogo.svg"></a>
                <a href="cinema.html"><img src="img/cinemaslogo.svg"></a>
                <a href="check-booking/check-booking-form/index.php"><img src="img/checkbookinglogo.svg"></a>
            </div>
        </div>

        <section class="login-body">
            <div class="login-form">
                <div class="form-title">
                    <h2 class="login-text">Log in to your account</h2>
                </div>
                <div class="input-field">
                    <form action="" method="post" id="userForm" onsubmit="return validateForm()">
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?= $showID ?>">
                            <label class="fields-title">E-Mail</label>
                            <input class="input-fields <?php if ($loginFailed)
                                echo 'error-border'; ?>" type="email" id="userEmail" name="email"
                                placeholder="Enter your email here" required size="30" oninput="validateEmail()">
                            <div class="error" id="invalidEmail">Please enter a valid email address.</div>
                        </div>
                        <div class="form-group">
                            <label class="fields-title">Password</label>
                            <input class="input-fields <?php if ($loginFailed)
                                echo 'error-border'; ?>" id="userPassword" type="password" name="password"
                                placeholder="Enter your password here" required size="30">
                            <div class="error" id="loginFailed">Log in failed. Please try again!</div>
                        </div>
                        <?php
                        if ($loginFailed) {
                            echo '<div class="error" id="loginFailed">Login failed. Please try again!</div>';
                        }
                        ?>
                        <span><input class="login-button" type="submit" value="LOG IN"></span>
                    </form>
                    <span class="horizontal-line"></span>
                    <h3>Don't have an account? <span class="sign-up-link"><a href="signup.php?id=<?= $showID ?>">Sign
                                Up</a></span></h3>
                </div>
            </div>
        </section>

        <footer>
            <div class="content">
                <div class="left">
                    <div class="logo">
                        <img src='assets/moovflixLogo.svg' />
                    </div>
                    <div class="social">
                        <img src='assets/facebook.svg' />
                        <img src='assets/mail.svg' />
                        <img src='assets/twitter.svg' />
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

    </body>

    <script>
        if (<?php echo $loginFailed ? 'true' : 'false'; ?>) {
            document.getElementById("userEmail").style.border = "2px solid #FF2500";
            document.getElementById("userPassword").style.border = "2px solid #FF2500";
            document.getElementById("loginFailed").style.display = "block";
        }
    </script>


</html>