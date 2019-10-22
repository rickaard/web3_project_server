<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once('../../includes/config.php');

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
$webpages = new Webpages();

// Check for what HTTP Verb is getting used
switch ($method) {
    case 'GET':
        // CODE FOR 'GET' METHOD
        // Check if logged in, otherwise not allowed to use POST, PUT and DELETE requests
        if (isset($_GET['id'])) {
            $response = $webpages->getSingleWebpage($_GET['id']);
        } else {
            $response = $webpages->getAllWebpages();
        }
        break;

    case 'POST':
        // CODE FOR 'POST' METHOD
        // Check if logged in, otherwise not allowed to use POST, PUT and DELETE requests
        if (!$_SESSION['id']) {
            http_response_code(401);
            return;
        } else {
            if ($webpages->addWebpage($input['title'], $input['page_url'], $input['github_url'], $input['description'], $input['image'])) {
                $response = array("status" => "ok", "message" => "webpage added");
            } else {
                $response = array("status" => "error", "message" => "error adding webpage");
            }
        }
        break;

    case 'PUT':
        // CODE FOR 'PUT' METHOD
        // Check if logged in, otherwise not allowed to use POST, PUT and DELETE requests
        if (!$_SESSION['id']) {
            http_response_code(401);
            return;
        } else {
            if ($webpages->editWebpage($input['title'], $input['page_url'], $input['github_url'], $input['description'], $input['image'], $_GET['id'])) {
                $response = array("status" => "ok", "message" => "webpage added");
            } else {
                $response = array("status" => "error", "message" => "error adding webpage");
            }
        }
        break;

    case 'DELETE':
        // CODE FOR 'DELETE' METHOD
        // Check if logged in, otherwise not allowed to use POST, PUT and DELETE requests
        if (!$_SESSION['id']) {
            http_response_code(401);
            return;
        } else {
            if ($webpages->deleteWebpage($_GET['id'])) {
                $response = array("status" => "ok", "message" => "webpage deleted");
            } else {
                $response = array("status" => "ok", "message" => "error deleting webpage");
            }
        }
        break;
}




// Display the response from every method in JSON format
echo json_encode($response);
?>