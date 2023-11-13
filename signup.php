<?php
$servername = "localhost";
$username = "root";
$database = "moovlix";

$mysqli = new mysqli($servername, $username, '', $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$signupFailed = false;

$showID = "";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $showID = $_GET["id"];
}
;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

    $emailExists = false;
    $checkEmailQuery = "SELECT email FROM signup WHERE email=?";
    $stmt = $mysqli->prepare($checkEmailQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $emailExists = true;
        $signupFailed = true;
        echo "Email is already in use.";
    } else {
        $insertQuery = "INSERT INTO signup (name, email, password) VALUES (?, ?, ?)";
        $stmt = $mysqli->prepare($insertQuery);
        $stmt->bind_param("sss", $name, $email, $password);

        if ($stmt->execute()) {
            echo "Sign up successful!";
            header("Location: success-signup.html?id=$showID");
            exit();
        } else {
            echo "Error: " . $stmt->error;
            $signupFailed = true;
        }
    }
}
?>

<!DOCTYPE html>
<html Lang="en">

    <head>
        <title>MoovFlix: Sign Up</title>
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
            <div class="login-form sign-up-form">
                <div class="form-title">
                    <h2 class="login-text">Create an account</h2>
                </div>
                <div class="input-field">
                    <form action="" method="post" id="userForm" onsubmit="return validateForm()">
                        <div class="form-group">
                            <label class="fields-title">Name</label>
                            <input class="input-fields <?php if ($signupFailed)
                                echo 'error-border'; ?>" id="userName" type="name" name="name"
                                placeholder="Enter your name here" required size="30" oninput="validateName()">
                            <div class="error" id="invalidName">Please enter a valid name.</div>
                        </div>
                        <div class="form-group">
                            <label class="fields-title">E-Mail</label>
                            <input class="input-fields <?php if ($signupFailed)
                                echo 'error-border'; ?>" type="text" id="userEmail" name="email"
                                placeholder="Enter your email here" required size="30"
                                oninput="validateEmail(); checkEmailAvailability();">
                            <div class="error" id="invalidEmail">Please enter a valid email address.</div>
                        </div>
                        <div class="form-group">
                            <label class="fields-title">Password</label>
                            <input class="input-fields <?php if ($signupFailed)
                                echo 'error-border'; ?>" id="userPassword" type="password" name="password"
                                placeholder="Enter your password here" required size="30">
                        </div>
                        <div class="form-group">
                            <label class="fields-title">Confirm Password</label>
                            <input class="input-fields <?php if ($signupFailed)
                                echo 'error-border'; ?>" id="confirmPassword" type="password" name="password"
                                placeholder="Confirm your password here" required size="30"
                                oninput="validateConfirmPassword()">
                            <div class="error" id="passwordUnmatch">The passwords entered do not match.</div>
                        </div>
                        <?php
                        if ($signupFailed) {
                            echo '<div class="error" id="signupFailed">Signup failed. Please try again!</div>';
                        }
                        ?>
                        <span><input class="login-button" type="submit" value="SIGN UP"></span>
                    </form>
                    <span class="horizontal-line"></span>
                    <h3>Already have an account? <span class="sign-up-link"><a href="login.php?id=<?= $showID ?>">Login</a></span></h3>
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
                    <a href="index.html">MOVIES</a>
                    <a href="cinema.html">CINEMAS</a>
                    <a href="check-booking/check-booking-form/index.php">CHECK BOOKING</a>
                </div>
            </div>
            <div class="copyright">Copyright &copy 2023 MoovFlix</div>

        </footer>

    </body>

    <script>
    if (<?php echo $signupFailed ? 'true' : 'false'; ?>) {
        document.getElementById("userName").style.border = "2px solid #FF2500";
        document.getElementById("userEmail").style.border = "2px solid #FF2500";
        document.getElementById("userPassword").style.border = "2px solid #FF2500";
        document.getElementById("confirmPassword").style.border = "2px solid #FF2500";
        document.getElementById("passwordUnmatch").style.display = "block";
        document.getElementById("passwordUnmatch").innerText = "Sign up failed. Please try again!"
    }
    </script>

</html>