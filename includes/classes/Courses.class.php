<?php

class Courses {
    private $db;

    public function __construct() {
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
        if ($this->db->connect_errno > 0) {
            die('Fel vid anslutning till databasen: ' . $this->db->connect_error);
        }
        mysqli_set_charset($this->db,"utf8");
    }

    // Get all the courses
    public function getAllCourses() {
        $sql = "SELECT * FROM courses";
        $result = $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Get single course
    public function getCourse($id) {

    }

    // Add new course
    public function addCourse($schoolName, $courseName, $startDate, $endDate) {

    }

    // Edit course
    public function editCourse($schoolName, $courseName, $startDate, $endDate, $id) {

    }

    // Delete course
    public function deleteCourse($id) {

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