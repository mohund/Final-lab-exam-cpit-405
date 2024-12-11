<?php
// Allow CORS for all origins and methods
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Handle OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200); // Respond with 200 OK
    exit;
}

// Check if the HTTP request method is PUT
if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
    header('Allow: PUT');
    http_response_code(405);
    echo json_encode(array('message' => 'Method not allowed'));
    return;
}

// Include necessary files
include_once '../db/Database.php';
include_once '../models/Bookmark.php';

// Instantiate Database and Bookmark
$database = new Database();
$db = $database->connect();
$bookmark = new Bookmark($db);

// Get The HTTP PUT request body
$data = json_decode(file_get_contents("php://input"), true);

if (empty($data)) {
    http_response_code(422);
    echo json_encode(array('message' => 'No data received'));
    return;
}

// Check if the ID exists in the database
$bookmark->setId($data['id']);
if (!$bookmark->readOne()) {
    http_response_code(404);
    echo json_encode(array('message' => 'Bookmark not found'));
    return;
}

// Set bookmark properties for update
$bookmark->setTitle($data['title']);
$bookmark->setLink($data['link']);

// Update the bookmark
if ($bookmark->update()) {
    http_response_code(200);
    echo json_encode(array('message' => 'Bookmark updated'));
} else {
    http_response_code(503);
    echo json_encode(array('message' => 'Bookmark not updated'));
}
?>
