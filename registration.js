

function check() {
    var email = document.getElementById('email').value;
    var psw1 = document.getElementById('password').value;
    var psw2 = document.getElementById('password_cof').value;
    var role = document.getElementById('role').value;
    
    //check email
    let regex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
    if (!regex.test(email)){
        alert("Your email is invalid");
        return;
    }

    // check if the password is at least 8 characters long
    if (psw1.length < 8) { // if the password is shorter than 8 characters
        alert("The password is too short. It should be at least 8 characters long."); // show an alert message
        return; // stop the function
    }
    if (psw1 !== psw2) { // if the passwords are not equal
        alert("The passwords do not match."); // show an alert message
        return; // stop the function
    }
    console.log('Information verified');
    var text = "Email : "+email+"\nAccount Type : "+role+"\n\nAre you sure?";
    if (confirm(text) == true) {
        document.getElementById('ca_form').submit();
        console.log('Form submitted')
    }
}