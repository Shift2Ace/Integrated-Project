function check() {
    var old_psw = document.getElementById('password_old').value;
    var psw1 = document.getElementById('password_new').value;
    var psw2 = document.getElementById('password_cof').value;

    // check if the password is at least 8 characters long
    if (psw1.length < 8) { // if the password is shorter than 8 characters
        alert("The password is too short. It should be at least 8 characters long."); // show an alert message
        return; // stop the function
    }else if (old_psw == psw1) { // if the passwords are not equal
        alert("The passwords is same."); // show an alert message
        return; // stop the function
    }else if (psw1 != psw2) { // if the passwords are not equal
        alert("The passwords do not match."); // show an alert message
        return; // stop the function
    }else {
        document.getElementById('cp_form').submit();
        console.log('Form submitted')
    }
}