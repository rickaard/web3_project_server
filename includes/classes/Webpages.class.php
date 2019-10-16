<?php

class Webpages {

    private $db;

    public function __construct() {
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
        if ($this->db->connect_errno > 0) {
            die('Fel vid anslutning till databasen: ' . $this->db->connect_error);
        }
        mysqli_set_charset($this->db,"utf8");
    }


    // Get all webpages
    public function getAllWebpages() {
        $sql = "SELECT * FROM webpages";
        $result = $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }


    // Get a single webpage
    public function getSingleWebpage($id) {

    }

    // Add a new webpage
    public function addWebpage($title, $pageURL, $githubURL, $description, $image) {

    }

    // Edit a webpage
    public function editWebpage($title, $pageURL, $githubURL, $description, $image, $id) {
        
    }

    // Delete a webpage
    public function deleteWebpage($id) {

    }

    // Sanitize input
    public function sanitizeString($var) {
        $var = strip_tags($var);
        $var = htmlentities($var);
    
        if(get_magic_quotes_gpc()) {
            $var = stripslashes($var);
        }
        return $this->db->real_escape_string($var);
    }

}

?>