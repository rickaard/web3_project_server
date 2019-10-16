<?php

include_once('includes/config.php');

$userlogin = new Users;


if ($_POST['username'] != NULL && $_POST['password'] != NULL) {
    $username = $_POST['username'];
    $password = $_POST['password'];


    if ($userlogin->getUser($username, $password)) {
        return array("status" => "ok", "message" => "Inloggning lyckad");
    } else {
        return array("status" => "error", "message" => "Inloggning misslyckad");
    }
}


?>