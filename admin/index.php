<?php
include_once('../includes/config.php');

if (!$_SESSION['id']) {
    header('Location: login.php');
}

include_once('layout_includes/header.php');
?>



    <div class="container">

        <header>
            <div class="logo-item_wrapper">
                <span class="logo-item">R</span>
            </div>
            <nav>
                <ul>
                    <li><a href="#">Min portfolio</a></li>
                    <li><a href="logout.php">Logga ut</a></li>
                </ul>
            </nav>
        </header>

        <main>

            <section class="courses_wrapper output_wrapper">
                <div class="output-header_wrapper">
                    <h2>Kurser</h2><span class="show-btn"><i class="fas fa-sort-down"></i></span>
                </div>
                <div class="courses-items_wrapper">
                    <table class="courses-table">
                        <thead>
                            <tr>
                                <td>Lärosäte</td>
                                <td>Kursnamn</td>
                                <td>Startdatum</td>
                                <td>Slutdatum</td>
                            </tr>
                        </thead>
                        <tbody id="courses-output">

                        </tbody>
                    </table>
                    <button id="course-add-modal" class="add-btn">Lägg till ny</button>
                </div>

                <div class="add-modal">
                    <div class="form_wrapper add-form">
                        <span class="close">&times;</span>
                        <form id="add-course-form">
                            <div class="input_wrapper">
                                <label for="school_name">Lärosäte:</label>
                                <input type="text" id="school_name" placeholder="T.ex. Mittuniversitetet.." required>
                            </div>
                            <div class="input_wrapper">
                                <label for="course_name">Kursnamn:</label>
                                <input type="text" id="course_name" placeholder="T.ex. Webbutveckling I..." required>
                            </div>
                            <div class="input_wrapper">
                                <label for="course_start_date">Startdatum:</label>
                                <input type="text" id="course_start_date" placeholder="YYYY/MM" required>
                            </div>
                            <div class="input_wrapper">
                                <label for="course_end_date">Slutdatum:</label>
                                <input type="text" id="course_end_date" placeholder="YYYY/MM" required>
                            </div>
                            <div class="input_wrapper">
                                <input type="submit" id="submitBtn" class="btn btn-success" value="Lägg till kurs">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="edit-modal">
                    <div class="form_wrapper edit-form">
                        <span class="close">&times;</span>
                        <form id="edit-course-form">
                            <div class="input_wrapper">
                                <label for="edit_school_name">Lärosäte:</label>
                                <input type="text" id="edit_school_name" placeholder="T.ex. Mittuniversitetet.." required>
                            </div>
                            <div class="input_wrapper">
                                <label for="edit_course_name">Kursnamn:</label>
                                <input type="text" id="edit_course_name" placeholder="T.ex. Webbutveckling I..." required>
                            </div>
                            <div class="input_wrapper">
                                <label for="edit_start_date">Startdatum:</label>
                                <input type="text" id="edit_start_date" placeholder="ÅR/MÅNAD, t.ex. 2019/01" required>
                            </div>
                            <div class="input_wrapper">
                                <label for="edit_end_date">Slutdatum:</label>
                                <input type="text" id="edit_end_date" placeholder="ÅR/MÅNAD, t.ex. 2019/01" required>
                            </div>
                            <div class="input_wrapper">
                                <input type="hidden" id="edit_course_id">
                                <input type="submit" id="course_edit_submitBtn" class="btn btn-success" value="Redigera kurs">
                                
                            </div>
                        </form>
                    </div>
                </div>


            </section>

            <section class="works_wrapper output_wrapper">
                <div class="output-header_wrapper">
                    <h2>Arbete</h2><span class="show-btn"><i class="fas fa-sort-down"></i></span>
                </div>
                <div class="works-items_wrapper">
                    <table>
                        <thead>
                            <tr>
                                <td>Arbetsplats</td>
                                <td>Titel</td>
                                <td>Slutdatum</td>
                                <td>Startdatum</td>
                            </tr>
                        </thead>
                        <tbody id="works-output">
                        
                        </tbody>
                    </table>
                    <button id="work-add-modal" class="add-btn">Lägg till ny</button>
                    

                    <div class="add-work_modal">
                    <div class="form_wrapper add-form">
                        <span class="close">&times;</span>
                        <form id="add-works-form">
                            <div class="input_wrapper">
                                <label for="work_place">Arbetsplats:</label>
                                <input type="text" id="work_place" placeholder="T.ex. Google.." required>
                            </div>
                            <div class="input_wrapper">
                                <label for="work_title">Titel:</label>
                                <input type="text" id="work_title" placeholder="T.ex. frontend-utvecklare..." required>
                            </div>
                            <div class="input_wrapper">
                                <label for="work_start_date">Startdatum:</label>
                                <input type="text" id="work_start_date" placeholder="YYYY/MM" required>
                            </div>
                            <div class="input_wrapper">
                                <label for="work_end_date">Slutdatum:</label>
                                <input type="text" id="work_end_date" placeholder="YYYY/MM" required>
                            </div>
                            <div class="input_wrapper">
                                <input type="submit" id="work_submitBtn" class="btn btn-success" value="Lägg till arbete">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="edit-work_modal">
                    <div class="form_wrapper edit-form">
                        <span class="close">&times;</span>
                        <form id="edit-work-form">
                            <div class="input_wrapper">
                                <label for="edit_work_place">Arbetsplats:</label>
                                <input type="text" id="edit_work_place" placeholder="T.ex. Google.." required>
                            </div>
                            <div class="input_wrapper">
                                <label for="work_title">Titel:</label>
                                <input type="text" id="edit_work_title" placeholder="T.ex. frontend-utvecklare..." required>
                            </div>
                            <div class="input_wrapper">
                                <label for="edit_work_start_date">Startdatum:</label>
                                <input type="text" id="edit_work_start_date" placeholder="YYYY/MM" required>
                            </div>
                            <div class="input_wrapper">
                                <label for="edit_work_end_date">Slutdatum:</label>
                                <input type="text" id="edit_work_end_date" placeholder="YYYY/MM" required>
                            </div>
                            <div class="input_wrapper">
                                <input type="hidden" id="edit_work_id">
                                <input type="submit" id="work_edit_submitBtn" class="btn btn-success" value="Redigera arbete">
                                
                            </div>
                        </form>
                    </div>
                </div>







                </div>

            </section>

            <section class="webpages_wrapper output_wrapper">
                <div class="output-header_wrapper">
                    <h2>Websidor</h2><span class="show-btn"><i class="fas fa-sort-down"></i></span>
                </div>
                <div class="webpages-items_wrapper">
                    <div id="webpages-output">
                    
                    </div>
                    <button id="webpage-add-modal" class="add-btn">Lägg till ny</button>
                    

                    <div class="add-webpage_modal">
                        <div class="form_wrapper add-form">
                            <span class="close">&times;</span>
                            <form id="add-webpages-form">
                                <div class="input_wrapper">
                                    <label for="webpage_title">Titel: *</label>
                                    <input type="text" id="webpage_title" placeholder="Namn på websidan/appen.." required>
                                </div>
                                <div class="input_wrapper">
                                    <label for="webpage_description">Beskrivning: *</label>
                                    <input type="text" id="webpage_description" placeholder="Beskrivning av websidan/appen..." required>
                                </div>
                                <div class="input_wrapper">
                                    <label for="webpage_url">URL till websidan: *</label>
                                    <input type="text" id="webpage_url" placeholder="https://example.com" required>
                                </div>
                                <div class="input_wrapper">
                                    <label for="github_url">URL till Github-repo:</label>
                                    <input type="text" id="github_url" placeholder="https://github.com/">
                                </div>
                                <div class="input_wrapper">
                                    <label for="webpage_image">Bild på websidan/appen: Bild kan laddas upp <a href="https://imgur.com/upload?beta" target="_blank">HÄR *</a></label>
                                    <input type="text" id="webpage_image" placeholder="https://example.com/example.jpeg" required>
                                </div>
                                <div class="input_wrapper">
                                    <input type="submit" id="webpage_submitBtn" class="btn btn-success" value="Lägg till hemsida">
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="edit-webpage_modal">
                        <div class="form_wrapper edit-form">
                            <span class="close">&times;</span>
                            <form id="edit-webpages-form">
                                <div class="input_wrapper">
                                    <label for="edit_webpage_title">Titel: *</label>
                                    <input type="text" id="edit_webpage_title" placeholder="Namn på websidan/appen.." required>
                                </div>
                                <div class="input_wrapper">
                                    <label for="edit_webpage_description">Beskrivning: *</label>
                                    <input type="text" id="edit_webpage_description" placeholder="Beskrivning av websidan/appen..." required>
                                </div>
                                <div class="input_wrapper">
                                    <label for="edit_webpage_url">URL till websidan: *</label>
                                    <input type="text" id="edit_webpage_url" placeholder="https://example.com" required>
                                </div>
                                <div class="input_wrapper">
                                    <label for="edit_github_url">URL till Github-repo:</label>
                                    <input type="text" id="edit_github_url" placeholder="https://github.com/">
                                </div>
                                <div class="input_wrapper">
                                    <label for="edit_webpage_image">Bild på websidan/appen: Bild kan laddas upp <a href="https://imgur.com/upload?beta" target="_blank">HÄR *</a></label>
                                    <input type="text" id="edit_webpage_image" placeholder="https://example.com/example.jpeg" required>
                                </div>
                                <div class="input_wrapper">
                                    <input type="hidden" id="edit_webpage_id">
                                    <input type="submit" id="edit_webpage_submitBtn" class="btn btn-success" value="Redigera hemsida">
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </section>

        </main>
    </div>



<?php include_once('layout_includes/footer.php'); ?>