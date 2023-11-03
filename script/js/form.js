function validateName() {
    let userName = document.getElementById("userName").value;
    let regExpName = /^[a-zA-Z\s]+$/;
    let invalidName = document.getElementById("invalidName");
    let isValid = true;

    if (userName.length <= 0 || !regExpName.test(userName)) {
        invalidName.style.display = "block";
        document.getElementById("userName").style.border = "2px solid #FF2500";
        isValid = false;
    } else {
        invalidName.style.display = "none";
        document.getElementById("userEmail").style.border = "2px solid #FFFFFF";
    }

    return isValid;
}

function validateEmail() {
    let userEmail = document.getElementById("userEmail").value;
    let regExpEmail = /^[\w.-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}(?:\.[a-zA-Z]{1,3})?$/;
    let invalidEmail = document.getElementById("invalidEmail");
    let isValid = true;

    if (userEmail.length <= 0 || !regExpEmail.test(userEmail)) {
        invalidEmail.style.display = "block";
        document.getElementById("userEmail").style.border = "2px solid #FF2500";
        invalidEmail.innerText = "Please enter a valid email address.";
        isValid = false;
    } else {
        invalidEmail.style.display = "none";
        document.getElementById("userEmail").style.border = "2px solid #FFFFFF";
    }

    return isValid;
}

function checkEmailAvailability() {
    const userEmail = document.getElementById("userEmail").value;

    if (userEmail) {
        fetch(`script/php/check_email.php?email=${userEmail}`)
            .then(response => response.json())
            .then(data => {
                if (data.exists) {
                    const invalidEmail = document.getElementById("invalidEmail");
                    invalidEmail.style.display = "block";
                    document.getElementById("userEmail").style.border = "2px solid #FF2500";
                    invalidEmail.innerText = "This email address is taken.";
                }
            })
            .catch(error => console.error("Error:", error));
    }
}


function validateConfirmPassword() {
    let userPassword = document.getElementById("userPassword").value;
    let confirmPassword = document.getElementById("confirmPassword").value;

    let passwordUnmatch = document.getElementById("passwordUnmatch");
    let isValid = true;

    if (userPassword !== confirmPassword) {
        passwordUnmatch.style.display = "block";
        document.getElementById("confirmPassword").style.border = "2px solid #FF2500";
        isValid = false;
    } else {
        passwordUnmatch.style.display = "none";
        document.getElementById("confirmPassword").style.border = "2px solid #FFFFFF";
    }

    return isValid;
}

function validateForm() {
    return validateName() && validateEmail() && validateConfirmPassword();
}

function init() {
    if (document && document.getElementById) {
        var form = document.getElementById("userForm");
    }
}

window.onload = init;
