<?php

include_once('includes/config.php');

$userlogin = new Users;


if ($_POST['username'] != NULL && $_POST['password'] != NULL) {
    $username = $_POST['username'];
    $password = $_POST['password'];


    if ($userlogin->getUser($username, $password)) {
        $response = array("status" => "ok", "message" => "Inloggning lyckad");
    } else {
        $response = array("status" => "error", "message" => "Inloggning misslyckad");
    }
}

echo json_encode($response);
?>