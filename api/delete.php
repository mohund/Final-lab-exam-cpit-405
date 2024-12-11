<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200); // Respond with 200 OK
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    header('Allow: DELETE');
    http_response_code(405);
    echo json_encode(array('message' => 'Method not allowed'));
    return;
}

// Set HTTP response headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

// Include necessary files
include_once '../db/Database.php';
include_once '../models/Bookmark.php';

// Instantiate Database and Bookmark
$database = new Database();
$db = $database->connect();
$bookmark = new Bookmark($db);

// Get The HTTP DELETE request body
$data = json_decode(file_get_contents("php://input"), true);

if (empty($data) || empty($data['id'])) {
    http_response_code(422);
    echo json_encode(array('message' => 'Erorr: Missing required parameter id in request'));
    return;
}

// Check if the ID exists in the database
$bookmark->setId($data['id']);
if (!$bookmark->readOne()) {
    http_response_code(404);
    echo json_encode(array('message' => 'Bookmark not found'));
    return;
}

// Delete the bookmark
if ($bookmark->delete()) {
    http_response_code(200);
    echo json_encode(array('message' => 'Bookmark deleted'));
} else {
    http_response_code(503);
    echo json_encode(array('message' => 'Bookmark not deleted'));
}
