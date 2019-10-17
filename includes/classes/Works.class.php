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
        $id = intval($id);
        $sql = "SELECT * FROM works WHERE id=$id";
        $result = $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Add work record to database
    public function addWork($place, $title, $startDate, $endDate) {
        $place = $this->sanitizeString($place);
        $title = $this->sanitizeString($title);
        $startDate = $this->sanitizeString($startDate);
        $endDate = $this->sanitizeString($endDate);

        $sql = "INSERT INTO works (work_place, work_title, start_date, end_date) VALUES ('$place', '$title', '$startDate', '$endDate')";
        return $result = $this->db->query($sql);
    }

    // Edit work record in the database
    public function editWork($place, $title, $startDate, $endDate, $id) {
        $place = $this->sanitizeString($place);
        $title = $this->sanitizeString($title);
        $startDate = $this->sanitizeString($startDate);
        $endDate = $this->sanitizeString($endDate);
        $id = intval($id);

        $sql = "UPDATE works SET work_place='$place', work_title='$title', start_date='$startDate', end_date='$endDate' WHERE id=$id";
        return $result = $this->db->query($sql);

    }

    // Delete work record from database
    public function deleteWork($id) {
        $id = intval($id);

        $sql = "DELETE FROM works WHERE id=$id";
        return $result = $this->db->query($sql);
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