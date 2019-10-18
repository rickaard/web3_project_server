"use strict";

const loginForm = document.querySelector('#login-form');

const loginURL = 'http://localhost/web3_project/server/admin/loginscript.php';


// POST LOGINFORM TO API
function loginUser(event) {
    event.preventDefault();
    document.querySelector('#login-msg').innerHTML = ''; // Clear the error/success message on every login attempt

    // Stringify the inputs
    let jsonStr = JSON.stringify({
        'username': document.querySelector('#username').value,
        'password': document.querySelector('#password').value
    });

    fetch(loginURL, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: jsonStr
    })
    .then(resp => resp.json())
    .then(data => {
        // If status-message sent back from server is 'error' -> show error message
        if (data.status == 'error') {
            document.querySelector('#login-msg').classList.add('error-msg');
            document.querySelector('#login-msg').innerHTML = data.message;
            // Else show success message and redirect to index.php
        } else {
            document.querySelector('#login-msg').classList.add('success-msg');
            document.querySelector('#login-msg').innerHTML = data.message;
            // Wait 1 second to redirect to show the success message first
            setTimeout(() => {
                window.location.href = "../admin/index.php";
            },1000)
        }
    })
    .catch(error => {console.log(error)})
}



// Event listeners
if (loginForm != null) {
    loginForm.addEventListener('submit', loginUser)
};
