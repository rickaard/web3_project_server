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



// if($request[0] != "courses"){ 
// 	http_response_code(404);
// 	exit();
// }




// Initialize new work objects
$webpages = new Webpages();

// Check for what HTTP Verb is getting used
switch ($method) {
    case 'GET':
        // CODE FOR 'GET' METHOD
        $response = $webpages->getAllWebpages();
        break;
    case 'POST':
        // CODE FOR 'POST' METHOD
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