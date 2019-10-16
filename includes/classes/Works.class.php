<?php

class Works {

    private $db;

    public function __construct() {
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
        if ($this->db->connect_errno > 0) {
            die('Fel vid anslutning till databasen: ' . $this->db->connect_error);
        }
        mysqli_set_charset($this->db,"utf8");
    }

    // Get all works record from database
    public function getAllWorks() {
        $sql = "SELECT * FROM works";
        $result = $this->db->query($sql);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Get Single work record from database
    public function getSingleWork($id) {

    }

    // Add work record to database
    public function addWork($place, $title, $startDate, $endDate) {

    }

    // Edit work record in the database
    public function editWork($place, $title, $startDate, $endDate, $id) {
        
    }

    // Delete work record from database
    public function deleteWork($id) {
        
    }


    // Sanitize inputs
    public function sanitizeString($var) {
        $var = strip_tags($var);
        $var = htmlentities($var);
    
        if(get_magic_quotes_gpc()) {
            $var = stripslashes($var);
        }
        return $this->db->real_escape_string($var);
    }
}