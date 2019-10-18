<?php

include_once('../includes/config.php');
$input = json_decode(file_get_contents('php://input'), true);

$userlogin = new Users;


if ($input['username'] != NULL && $input['password'] != NULL) {
    $username = $input['username'];
    $password = $input['password'];


    if ($userlogin->getUser($username, $password)) {
        $_SESSION['id'] = 'admin';
        $response = array("status" => "ok", "message" => "Inloggning lyckad. Du skickas nu vidare till adminsidan");
    } else {
        $response = array("status" => "error", "message" => "Inloggning misslyckad. Användarnamnet eller lösenordet är fel.");
    }
}

echo json_encode($response);
?>