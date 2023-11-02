function validateInput() {
    let email = document.getElementById("buyer-email");
    let bookingID = document.getElementById("booking-ID");

    if (!validateEmail(email.value)) {
        alert("Invalid email!");
        return false;
    }
    if (!validateAlphanumericString(bookingID.value)) {
        alert("Invalid booking ID!");
        return false;
    }
    if (validateEmail(email.value) && validateAlphanumericString(bookingID.value)) {
        return true;
    }
}

function validateAlphanumericString(input) {
    // Use a regular expression to validate the string
    var pattern = /^[a-zA-Z0-9]{24}$/;
    return pattern.test(input);
}

function validateEmail(email) {
    // Use a regular expression to validate the email address
    var pattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return pattern.test(email);
}