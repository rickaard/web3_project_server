"use strict";

const loginForm = document.querySelector('#login-form');
const coursesOutput = document.querySelector('#courses-output');
const worksOutput = document.querySelector('#works-output');
const webpageOutput = document.querySelector('#webpages-output');
const outputContent = document.querySelector('.out-header_wrapper');
const showBtns = document.querySelectorAll('.show-btn');

const loginURL = 'http://localhost/web3_project/server/admin/loginscript.php';
const coursesURL = 'http://localhost/web3_project/server/api/courses/';
const worksURL = 'http://localhost/web3_project/server/api/works/';
const webpagesURL = 'http://localhost/web3_project/server/api/webpages/';


// Show output content
if (showBtns !== null) {
    showBtns.forEach(element => {
        element.addEventListener('click', (event) => {
            let content = element.parentElement.nextElementSibling;
            if (content.style.display === 'block') {
                content.style.display = 'none';
            } else {
                content.style.display = 'block';
            }
        })
    })
}




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




/* 
-------------------------------------------------------------
---- Functionality for GET, PUT, POST AND EDIT the COURSES
---- is below this comment block. 
-------------------------------------------------------------
*/

// Fetch all courses data
function fetchCourses() {
    fetch(coursesURL)
    .then(resp => resp.json())
    .then(data => {
        console.log('courses:', data);
        let courses = data.map((item, index) => {
            return `
            <tr>
                <td>${item.school_name}</td>
                <td>${item.course_name}</td>
                <td>${item.start_date}</td>
                <td>${item.end_date}</td>
                <td class="course-delete"><button id="${item.id}" class="btn btn-small btn-warning" onClick="deleteCourse(${item.id})"><i class="fas fa-trash-alt"></i></button></td>
                <td class="course-edit"><button class="btn btn-small btn-sucess" onClick="editModal('${item.school_name}', '${item.course_name}', '${item.start_date}', '${item.end_date}', ${item.id})"><i class="fas fa-edit"></i></button></td>
            </tr>
            `
        }).join("");
        coursesOutput.innerHTML = courses;
    })
    .catch(error => console.log(error));
};
// Add new course

// Edit course

// Delete course




/* 
-------------------------------------------------------------
---- Functionality for GET, PUT, POST AND EDIT the WORKS
---- is below this comment block. 
-------------------------------------------------------------
*/
// Fetch all works data
function fetchWorks() {
    fetch(worksURL)
    .then(resp => resp.json())
    .then(data => {
        console.log('works:', data);
        let works = data.map((item, index) => {
            return `
            <tr>
                <td>${item.work_place}</td>
                <td>${item.work_title}</td>
                <td>${item.start_date}</td>
                <td>${item.end_date}</td>
                <td class="course-delete"><button id="${item.id}" class="btn btn-small btn-warning" onClick="deleteWorks(${item.id})"><i class="fas fa-trash-alt"></i></button></td>
                <td class="course-edit"><button class="btn btn-small btn-sucess" onClick="editWorksModal('${item.work_place}', '${item.work_title}', '${item.start_date}', '${item.end_date}', ${item.id})"><i class="fas fa-edit"></i></button></td>
            </tr>
            `
        }).join("");
        worksOutput.innerHTML = works;
    })
    .catch(error => console.log(error))
}
// Add new work

// Edit work

// Delete work


/* 
-------------------------------------------------------------
---- Functionality for GET, PUT, POST AND EDIT the WORKS ----
---- is below this comment block.                        ----
-------------------------------------------------------------
*/

// Fetch all webpages data
function fetchWebpages() {
    fetch(webpagesURL)
    .then(resp => resp.json())
    .then(data => {
        console.log('webpages:', data);
        let webpages = data.map((item, index) => {
            return `
             <div class="webpage-item">
                <div class="flex-column">
                    <div class="flex-row">
                        <div class="flex-column webpage-info">
                            <h4>Titel:</h4>
                            <p>${item.page_title}</p>
                            <h4>Beskrivning:</h4>
                            <p>${item.page_description}</p>
                        </div>
                        <div class="webpage_img">
                            <img src="https://i.gyazo.com/c61ca0ba7932e49e89fa5071eddcb292.jpg" alt="Bild på hemsidan ${item.page_titel}">
                        </div>
                    </div>
                    <div class="flex-row webpage-links">
                        <div class="webpage-links">
                            <a href="${item.page_url}" class="btn btn-link">Live demo</a>
                            <a href="${item.page_github}" class="btn btn-link">Github</a>
                        </div>
                        <div class="webpage-btn">
                            <button id="${item.id}" class="btn btn-small btn-warning" onClick="deleteWebages(${item.id})"><i class="fas fa-trash-alt"></i></button>
                            <button class="btn btn-small btn-sucess" onClick="editWebpagessModal('${item.work_place}', '${item.work_title}', '${item.start_date}', '${item.end_date}', ${item.id})"><i class="fas fa-edit"></i></button>
                        </div>
                    </div>
                </div>
             </div>
            `
        }).join("");
        webpageOutput.innerHTML = webpages;
    })
    .catch(error => console.log(error))
};




/* 
-------------------------------------------------------------
----                   EVENTLISTENERS                    ----
-------------------------------------------------------------
*/

window.addEventListener('DOMContentLoaded', () => {
    fetchCourses();
    fetchWorks();
    fetchWebpages();
});

if (loginForm != null) {
    loginForm.addEventListener('submit', loginUser)
};
