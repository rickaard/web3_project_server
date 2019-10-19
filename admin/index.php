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
                    <li><a href="#">Din portfolio</a></li>
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
                                <td>Slutdatum</td>
                                <td>Startdatum</td>
                            </tr>
                        </thead>
                        <tbody id="courses-output">

                        </tbody>
                    </table>
                    <form class="courses-form">
                        
                    </form>
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