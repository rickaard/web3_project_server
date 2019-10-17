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
$work = new Works();




// Check for what HTTP Verb is getting used
switch ($method) {

    case 'GET':
        // CODE FOR 'GET' METHOD
        if (isset($_GET['id'])) {
            $response = $work->getSingleWork($_GET['id']);
        } else {
            $response = $work->getAllWorks();
        }
        break;

    case 'POST':
        // CODE FOR 'POST' METHOD
        if ($work->addWork($input['work_place'], $input['work_title'], $input['start_date'], $input['end_date'])) {
            $response = array("status" => "ok", "message" => "work added");
        } else {
            $response = array("status" => "error", "message" => "error adding new work");
        }
        break;

    case 'PUT':
        // CODE FOR 'PUT' METHOD
        if ($work->editWork($input['work_place'], $input['work_title'], $input['start_date'], $input['end_date'], $_GET['id'])) {
            $response = array("status" => "ok", "message" => "work updated");
        } else {
            $response = array("status" => "ok", "message" => "error updating work");
        }
        break;

    case 'DELETE':
        // CODE FOR 'DELETE' METHOD
        if ($work->deleteWork($_GET['id'])) {
            $response = array("status" => "ok", "message" => "work deleted");
        } else {
            $response = array("status" => "error", "message" => "error deleting work");
        }
        break;
}




// Display the response from every method in JSON format
echo json_encode($response);
?>