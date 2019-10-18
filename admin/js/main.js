"use strict";

const loginForm = document.querySelector('#login-form');

const loginURL = 'http://localhost/web3_project/server/admin/loginscript.php';


// POST LOGINFORM TO API
function loginUser(event) {
    event.preventDefault();
    let username = document.querySelector('#username').value;
    let password = document.querySelector('#password').value;
    console.log(username, password);

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
        window.location.href = "../admin/index.php";
        console.log('Lyckad inloggning');
        // console.log(data);
    })
    .catch(error => console.log(error))

}

loginForm.addEventListener('submit', loginUser);