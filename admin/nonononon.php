<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once('../includes/config.php');

// Set the content-type to json
header('Content-Type: application/json; charset=UTF-8');
// Allow everyone to access the api
header('Access-Control-Allow-Headers: Content-Type');
// Allow the CRUD verbs POST, GET, DELETE, PUT
header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT');

$method = $_SERVER['REQUEST_METHOD'];
// $request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$input = json_decode(file_get_contents('php://input'), true);




// Initialize new work objects
$userlogin = new Users();

// Check for what HTTP Verb is getting used
switch ($method) {
    case 'GET':
        // CODE FOR 'GET' METHOD

        break;
    case 'POST':
        // CODE FOR 'POST' METHOD
        if ($userlogin->getUser($input['username'], $input['password'])) {
            $response = array("status" => "ok", "message" => "logged in", "id" => getUser($input['username'], $input['password']));
        } else {
            $response = array("status" => "error", "message" => "error, wrong username or password");
        }

        break;
    case 'PUT':
        // CODE FOR 'PUT' METHOD
        break;
    case 'DELETE':
        // CODE FOR 'DELETE' METHOD
        break;
}





// Display the response from every method in JSON format
echo json_encode($response);
?>