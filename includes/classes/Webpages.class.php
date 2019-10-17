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
        $sql = "SELECT * FROM webpages WHERE id=$id";
        $result = $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Add a new webpage
    public function addWebpage($title, $pageURL, $githubURL, $description, $image) {
        $title = $this->sanitizeString($title);
        $pageURL = $this->sanitizeString($pageURL);
        $githubURL = $this->sanitizeString($githubURL);
        $description = $this->sanitizeString($description);
        $image = $this->sanitizeString($image);

        $sql = "INSERT INTO webpages (page_title, page_url, page_github, page_description, page_image) VALUES ('$title', '$pageURL', '$githubURL', '$description', '$image')";
        return $result = $this->db->query($sql);
    }

    // Edit a webpage
    public function editWebpage($title, $pageURL, $githubURL, $description, $image, $id) {
        $title = $this->sanitizeString($title);
        $pageURL = $this->sanitizeString($pageURL);
        $githubURL = $this->sanitizeString($githubURL);
        $description = $this->sanitizeString($description);
        $image = $this->sanitizeString($image);
        $id = intval($id);

        $sql = "UPDATE webpages SET page_title='$title', page_url='$pageURL', page_github='$githubURL', page_description='$description', page_image='$image' WHERE id=$id";
        return $result = $this->db->query($sql);
    }

    // Delete a webpage
    public function deleteWebpage($id) {
        $id = intval($id);

        $sql = "DELETE from webpages WHERE id=$id";
        return $result = $this->db->query($sql);
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