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
        $sql = "SELECT * FROM courses WHERE id=$id";
        $result = $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Add new course
    public function addCourse($schoolName, $courseName, $startDate, $endDate) {

        $schoolName = $this->sanitizeString($schoolName);
        $courseName = $this->sanitizeString($courseName);
        $startDate = $this->sanitizeString($startDate);
        $endDate = $this->sanitizeString($endDate);

        $sql = "INSERT INTO courses (school_name, course_name, start_date, end_date) VALUES ('$schoolName', '$courseName', '$startDate', '$endDate')";
        return $result = $this->db->query($sql);
        
    }

    // Edit course
    public function editCourse($schoolName, $courseName, $startDate, $endDate, $id) {
        $schoolName = $this->sanitizeString($schoolName);
        $courseName = $this->sanitizeString($courseName);
        $startDate = $this->sanitizeString($startDate);
        $endDate = $this->sanitizeString($endDate);
        $id = intval($id);

        $sql = "UPDATE courses SET school_name='$schoolName', course_name='$courseName', start_date='$startDate', end_date='$endDate' WHERE id=$id";
        return $result = $this->db->query($sql);
    }

    // Delete course
    public function deleteCourse($id) {
        $id = intval($id);

        $sql = "DELETE FROM courses WHERE id=$id";
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