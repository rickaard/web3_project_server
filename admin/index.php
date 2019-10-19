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
                                <label for="school_name">Lärosäte:</label>
                                <input type="text" id="edit_school_name" placeholder="T.ex. Mittuniversitetet.." required>
                            </div>
                            <div class="input_wrapper">
                                <label for="course_name">Kursnamn:</label>
                                <input type="text" id="edit_course_name" placeholder="T.ex. Webbutveckling I..." required>
                            </div>
                            <div class="input_wrapper">
                                <label for="start_date">Startdatum:</label>
                                <input type="text" id="edit_start_date" placeholder="ÅR/MÅNAD, t.ex. 2019/01" required>
                            </div>
                            <div class="input_wrapper">
                                <label for="end_date">Slutdatum:</label>
                                <input type="text" id="edit_end_date" placeholder="ÅR/MÅNAD, t.ex. 2019/01" required>
                            </div>
                            <div class="input_wrapper">
                                <input type="hidden" id="edit_course_id">
                                <input type="submit" id="edit_submitBtn" class="btn btn-success" value="Redigera kurs">
                                
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
                    <form class="works-form">
                        
                    </form>
                </div>

            </section>

            <section class="webpages_wrapper output_wrapper">
                <div class="output-header_wrapper">
                    <h2>Websidor</h2><span class="show-btn"><i class="fas fa-sort-down"></i></span>
                </div>
                <div class="webpages-items_wrapper">
                    <div id="webpages-output">
                    
                    </div>
                    <form class="webpages-form">
                    
                    </form>
                </div>
            </section>

        </main>
    </div>



<?php include_once('layout_includes/footer.php'); ?>