"use strict";

const loginForm = document.querySelector('#login-form');

// Variables for the output containers
const coursesOutput = document.querySelector('#courses-output');
const worksOutput = document.querySelector('#works-output');
const webpageOutput = document.querySelector('#webpages-output');
const outputContent = document.querySelector('.out-header_wrapper');

const showBtns = document.querySelectorAll('.show-btn');
const closeModalBtns = document.querySelectorAll('.close');

// Various variables for the elements regarding the COURSES, e.g the "add new"-modal, "edit"-modal, and the various forms for it
const addModalBtn = document.querySelector('#course-add-modal');
const addModalEl = document.querySelector('.add-modal');
const addCourseForm = document.querySelector('#add-course-form');
const editModalEl = document.querySelector('.edit-modal');
const editCourseForm = document.querySelector('#edit-course-form');

// Various variables for the elements regarding the WORKS, e.g the "add new"-modal, "edit"-modal, and the various forms for it
const addWorkModalBtn = document.querySelector('#work-add-modal');
const addWorkModalEl = document.querySelector('.add-work_modal');
const editWorkModalEl = document.querySelector('.edit-work_modal');
const addWorkForm = document.querySelector('#add-works-form');
const editWorkForm = document.querySelector('#edit-work-form');

// Various variables for the elements regarding the WEBPAGES, e.g the "add new"-modal, "edit"-modal, and the various forms for it
const addWebpageModalBtn = document.querySelector('#webpage-add-modal');
const addWebpageModalEl = document.querySelector('.add-webpage_modal');
const editWebpageModalEl = document.querySelector('.edit-webpage_modal');
const addWebpageForm = document.querySelector('#add-webpages-form');
const editWebpageForm = document.querySelector('#edit-webpages-form');

// API endpoints
const loginURL = 'http://localhost/web3_project/server/admin/loginscript.php';
const coursesURL = 'http://localhost/web3_project/server/api/courses/';
const worksURL = 'http://localhost/web3_project/server/api/works/';
const webpagesURL = 'http://localhost/web3_project/server/api/webpages/';



// POST LOGINFORM TO API
function loginUser(event) {
    event.preventDefault();
    document.querySelector('#login-msg').innerHTML = ''; // Clear the error/success message on every login attempt

    // Stringify the inputs
    let jsonStr = JSON.stringify({
        'username': document.querySelector('#username').value,
        'password': document.querySelector('#password').value
    });

    // Send POST request to API
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
            window.location.href = "../admin/index.php";
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
        let courses = data.map((item, index) => {
            return `
            <tr>
                <td>${item.school_name}</td>
                <td>${item.course_name}</td>
                <td>${item.start_date}</td>
                <td>${item.end_date}</td>
                <td class="course-delete"><button id="${item.id}" class="btn btn-small btn-warning" onClick="deleteCourse(${item.id})"><i class="fas fa-trash-alt"></i></button></td>
                <td class="course-edit"><button class="btn btn-small btn-sucess" onClick="editCourseModal('${item.school_name}', '${item.course_name}', '${item.start_date}', '${item.end_date}', ${item.id})"><i class="fas fa-edit"></i></button></td>
            </tr>
            `
        }).join("");
        if (coursesOutput != null) {
            coursesOutput.innerHTML = courses;
        }
    })
    .catch(error => console.log(error));
};
// Add new course
function addCourse(event) {
    event.preventDefault();

    // Stringify the inputs
    let jsonStr = JSON.stringify({
        "school_name": document.querySelector('#school_name').value,
        "course_name": document.querySelector('#course_name').value,
        "start_date": document.querySelector('#course_start_date').value,
        "end_date": document.querySelector('#course_end_date').value
    });

    // Send POST request to API
    fetch(coursesURL, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: jsonStr
    })
    .then(resp => resp.json())
    .then(data => {
        fetchCourses(); // fetch the new data
        addCourseForm.reset(); // reset/clear the form inputs
        addModalEl.style.display = 'none'; // close the modal
    })
}

// Fill "edit course"-modal with current data and open the modal
function editCourseModal(school_name, course_name, start_date, end_date, id) {
    document.querySelector('#edit_school_name').value = school_name;
    document.querySelector('#edit_course_name').value = course_name;
    document.querySelector('#edit_start_date').value = start_date;
    document.querySelector('#edit_end_date').value = end_date;
    document.querySelector('#edit_course_id').value = id;
    editModalEl.style.display = 'block';
}

// Edit course
function editCourse(event) {
    event.preventDefault();

    let id = document.querySelector('#edit_course_id').value;

    let jsonStr = JSON.stringify({
        "school_name": document.querySelector('#edit_school_name').value,
        "course_name": document.querySelector('#edit_course_name').value,
        "start_date": document.querySelector('#edit_start_date').value,
        "end_date": document.querySelector('#edit_end_date').value
    });

    // Send PUT request to API, to update the data
    fetch(coursesURL+'?id='+id, {
        method: 'PUT',
        header: {
            'Content-Type': 'application/json'
        },
        body: jsonStr
    })
    .then(resp => resp.json())
    .then(data => {
        fetchCourses(); // fetch the new updated content
        editModalEl.style.display = 'none'; // close modal when done
    })
    .catch(error => console.log(error))
}

// Delete course
function deleteCourse(id) {

    // Send DELETE request to API
    fetch(coursesURL+'?id='+id, {
        method: 'DELETE'
    })
    .then(resp => resp.json())
    .then(data => {
        fetchCourses(); // fetch the new content after an item has been removed
    })
    .catch(error => console.log(error))
};



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
        if (worksOutput != null) {
            worksOutput.innerHTML = works;
        }
    })
    .catch(error => console.log(error))
}
// Add new work
function addWork(event) {
    event.preventDefault();

    let jsonStr = JSON.stringify({
        "work_place": document.querySelector('#work_place').value,
        "work_title": document.querySelector('#work_title').value,
        "start_date": document.querySelector('#work_start_date').value,
        "end_date": document.querySelector('#work_end_date').value
    });

    fetch(worksURL, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: jsonStr
    })
    .then(resp => resp.json())
    .then(data => {
        fetchWorks();
        addWorkForm.reset();
        addWorkModalEl.style.display = 'none';
    })
    .catch(error => console.log(error))
}

// Edit work
function editWorksModal(work_place, work_title, start_date, end_date, id) {
    document.querySelector('#edit_work_place').value = work_place;
    document.querySelector('#edit_work_title').value = work_title;
    document.querySelector('#edit_work_start_date').value = start_date;
    document.querySelector('#edit_work_end_date').value = end_date;
    document.querySelector('#edit_work_id').value = id;
    editWorkModalEl.style.display = 'block';
}

function editWork(event) {
    event.preventDefault();

    let id = document.querySelector('#edit_work_id').value;

    let jsonStr = JSON.stringify({
        "work_place": document.querySelector('#edit_work_place').value,
        "work_title": document.querySelector('#edit_work_title').value,
        "start_date": document.querySelector('#edit_work_start_date').value,
        "end_date": document.querySelector('#edit_work_end_date').value
    });

    fetch(worksURL+'?id='+id, {
        method: 'PUT',
        header: {
            'Content-Type': 'application/json'
        },
        body: jsonStr
    })
    .then(resp => resp.json())
    .then(data => {
        fetchWorks();
        editWorkModalEl.style.display = 'none';
    })
    .catch(error => console.log(error))
}


// Delete work
function deleteWorks(id) {
    fetch(worksURL+'?id='+id, {
        method: 'DELETE'
    })
    .then(resp => resp.json())
    .then(data => {
        fetchWorks();
    })
    .catch(error => console.log(error))
};

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
                            <img src="${(item.page_image != '') ? item.page_image : 'https://i.imgur.com/h2vX36m.jpg' }" alt="Bild på hemsidan ${item.page_titel}">
                        </div>
                    </div>
                    <div class="flex-row webpage-links">
                        <div class="webpage-links">
                            <a href="${item.page_url}" class="btn btn-link" target="_blank">Live demo</a>
                            ${item.page_github != "" ? `<a href="${item.page_github}" class="btn btn-link" target="_blank">Github</a>` : ''}
                        </div>
                        <div class="webpage-btn">
                            <button id="${item.id}" class="btn btn-small btn-warning" onClick="deleteWebages(${item.id})"><i class="fas fa-trash-alt"></i></button>
                            <button class="btn btn-small btn-sucess" onClick="editWebpagessModal('${item.page_title}', '${item.page_description}', '${item.page_url}', '${item.page_github}', '${item.page_image}', ${item.id})"><i class="fas fa-edit"></i></button>
                        </div>
                    </div>
                </div>
             </div>
            `
        }).join("");
        if (webpageOutput != null) {
            webpageOutput.innerHTML = webpages;
        }
    })
    .catch(error => console.log(error))
};

// Add new webpage
function addWebpage(event) {
    event.preventDefault();

    let jsonStr = JSON.stringify({
        "title": document.querySelector('#webpage_title').value,
        "page_url": document.querySelector('#webpage_url').value,
        "github_url": document.querySelector('#github_url').value,
        "description": document.querySelector('#webpage_description').value,
        "image": document.querySelector('#webpage_image').value
    });

    fetch(webpagesURL, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: jsonStr
    })
    .then(resp => resp.json())
    .then(data => {
        fetchWebpages();
        addWebpageForm.reset();
        addWebpageModalEl.style.display = 'none';
    })
}

// Fill and open edit modal
function editWebpagessModal(page_title, page_description, page_url, github_url, page_image, page_id) {

    document.querySelector('#edit_webpage_title').value = page_title;
    document.querySelector('#edit_webpage_description').value = page_description;
    document.querySelector('#edit_webpage_url').value = page_url;
    document.querySelector('#edit_github_url').value = github_url;
    document.querySelector('#edit_webpage_image').value = page_image;
    document.querySelector('#edit_webpage_id').value = page_id;

    editWebpageModalEl.style.display = 'block';
}

// Edit webpage
function editWebpage(event) {
    event.preventDefault();

    let id = document.querySelector('#edit_webpage_id').value;

    let jsonStr = JSON.stringify({
        "title": document.querySelector('#edit_webpage_title').value,
        "page_url": document.querySelector('#edit_webpage_url').value,
        "github_url": document.querySelector('#edit_github_url').value,
        "description": document.querySelector('#edit_webpage_description').value,
        "image": document.querySelector('#edit_webpage_image').value,
    });

    fetch(webpagesURL+'?id='+id, {
        method: 'PUT',
        header: {
            'Content-Type': 'application/json'
        },
        body: jsonStr
    })
    .then(resp => resp.json())
    .then(data => {
        fetchWebpages();
        editWebpageModalEl.style.display = 'none';
    })
    .catch(error => console.log(error))
}

// Delete webpage
function deleteWebages(id) {
    fetch(webpagesURL+'?id='+id, {
        method: 'DELETE'
    })
    .then(resp => resp.json())
    .then(data => {
        fetchWebpages();
    })
    .catch(error => console.log(error))
};




/* 
-------------------------------------------------------------
----                   EVENTLISTENERS                    ----
-------------------------------------------------------------
*/

// Call the fetch functions when DOM is loaded
window.addEventListener('DOMContentLoaded', () => {
    fetchCourses();
    fetchWorks();
    fetchWebpages();
});

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

// Eventlistener for login form
if (loginForm != null) {
    loginForm.addEventListener('submit', loginUser)
};

// Eventlistener for the "open modal"-button
if (addModalBtn != null) {
    addModalBtn.addEventListener('click', () => {
        addModalEl.style.display = 'block';
    })
}
if (addWorkModalBtn != null) {
    addWorkModalBtn.addEventListener('click', () => {
        addWorkModalEl.style.display = 'block';
    })
}
if (addWebpageModalBtn != null) {
    addWebpageModalBtn.addEventListener('click', () => {
        addWebpageModalEl.style.display = 'block';
    })
}

// Eventlistener for the close button inside the modals
if (closeModalBtns != null) {
    closeModalBtns.forEach(element => {
        element.addEventListener('click', () => {
            element.parentElement.parentElement.style.display = 'none';
        })
    })
}

// If press outside of modal -> set display to none
window.onclick = function(event) {
    if (event.target == addModalEl || event.target == editModalEl || event.target == addWorkModalEl || event.target == editWorkModalEl || event.target == addWebpageModalEl || event.target == editWebpageModalEl) {
        addModalEl.style.display = "none";
        editModalEl.style.display = "none";
        addWorkModalEl.style.display = 'none';
        editWorkModalEl.style.display = 'none';
        addWebpageModalEl.style.display = 'none';
        editWebpageModalEl.style.display = 'none';
    }
  }

  // Event listener for add form
  if (addCourseForm != null) {
    addCourseForm.addEventListener('submit', addCourse);
  }
  if (addWorkForm != null) {
      addWorkForm.addEventListener('submit', addWork);
  }
  if (addWebpageForm != null) {
      addWebpageForm.addEventListener('submit', addWebpage);
  }
  

  // Event listener for edit  form
  if (editCourseForm != null) {
    editCourseForm.addEventListener('submit', editCourse);
  }
  if (editWorkForm != null) {
      editWorkForm.addEventListener('submit', editWork);
  }
  if (editWebpageForm != null) {
      editWebpageForm.addEventListener('submit', editWebpage);
  }
