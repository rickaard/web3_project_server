<?php


class Users {

    private $db;

    public function __construct() {
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
        if ($this->db->connect_errno > 0) {
            die('Fel vid anslutning till databasen: ' . $this->db->connect_error);
        }
        mysqli_set_charset($this->db,"utf8");
    }

    // Check if user and password is a match
    public function getUser($username, $password) {
        $sql = "SELECT id FROM userlogin WHERE username='$username' AND password='$password'";

        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
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