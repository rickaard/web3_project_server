<?php

// Set the content-type to json
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Headers: Content-Type');

// Allow the CRUD verbs POST
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Origin: *');

$input = json_decode(file_get_contents('php://input'), true);


$response = [];


if ($input['email_name'] != NULL && $input['email'] != NULL && $input['msg'] != NULL) {
    $name = $input['email_name'];
    $email = $input['email'];
    $msg = $input['msg'];
    $response = mailValidation($name, $email, $msg);
}

function mailValidation($name, $email, $msg) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return array("email_validation" => "error", "message" => "Ingen giltig e-postadress");
    } 
    if (strlen($name <= 1) && strlen($msg) <= 1) {
        return array("email_validation" => "error", "message" => "Du måste fylla i alla fält");
    }
    return sendMail($name, $email, $msg);
}

function sendMail($name, $email, $msg) {
    $to = "rickaard@gmail.com";
    $subject = "Portfolio-sida";
    $message = $msg;
    $headers = "From: '$email'";


    if (mail($to, $subject, $message, $headers)) {
        return array("email_validation" => "ok", "message" => "Ditt meddelande är skickat!");
    }
    else {
        return array("email_validation" => "error", "message" => "Något gick fel vid skickande av mailet");
    }
}


echo json_encode($response);
?>