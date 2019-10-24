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

header('Access-Control-Allow-Origin: *');






$method = $_SERVER['REQUEST_METHOD'];
// $request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$input = json_decode(file_get_contents('php://input'), true);


// Initialize new objects
$course = new Courses();


// Check for what HTTP Verb is getting used
switch ($method) {
    case 'GET':
        // CODE FOR 'GET' METHOD

        if (isset($_GET['id'])) {
            $response = $course->getCourse($_GET['id']);
        } else {
            $response = $course->getAllCourses();
        }
        break;

    case 'POST':
        // CODE FOR 'POST' METHOD
        // Check if logged in, otherwise not allowed to use POST, PUT and DELETE requests
        if (!$_SESSION['id']) {
            http_response_code(401);
            return;
        } else {
            if ($course->addCourse($input['school_name'], $input['course_name'], $input['start_date'], $input['end_date'])) {
                $response = array("status" => "ok", "message" => "course added");
            } else {
                $response = array("status" => "error", "message" => "error adding course");
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
            if ($course->editCourse($input['school_name'], $input['course_name'], $input['start_date'], $input['end_date'], $_GET['id'])) {
                $response = array("status" => "ok", "message" => "course updated");
            } else {
                $response = array("status" => "erro", "message" => "error updating course");
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
            if ($course->deleteCourse($_GET['id'])) {
                $response = array("status" => "ok", "message" => "course deleted");
            } else {
                $response = array("status" => "error", "message" => "error deleting message");
            }
        }
        break;
}



// Display the response from every method in JSON format
echo json_encode($response);
?>