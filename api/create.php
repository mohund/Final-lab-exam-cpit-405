<?php

// Set HTTP response headers for CORS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

// Handle OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Allow: POST');
    http_response_code(405);
    echo json_encode(array('message' => 'Method not allowed'));
    exit;
}

// Include necessary files
include_once '../db/Database.php';
include_once '../models/Bookmark.php';

try {
    // Instantiate Database and Bookmark
    $database = new Database();
    $db = $database->connect();
    $bookmark = new Bookmark($db);

    // Get posted data
    $data = json_decode(file_get_contents("php://input"), true);

    // Validate incoming data
    if (empty($data)) {
        http_response_code(422);
        echo json_encode(array('message' => 'No data received'));
        exit;
    }

    if (empty($data['title'])) {
        http_response_code(422);
        echo json_encode(array('message' => 'Title is missing'));
        exit;
    }

    if (empty($data['link'])) {
        http_response_code(422);
        echo json_encode(array('message' => 'Link is missing'));
        exit;
    }

    // Set bookmark properties
    $bookmark->setTitle($data['title']);
    $bookmark->setLink($data['link']);

    // Create the bookmark
    if ($bookmark->create()) {
        http_response_code(201);
        echo json_encode(array('message' => 'Bookmark created successfully'));
    } else {
        http_response_code(503);
        echo json_encode(array('message' => 'Error creating bookmark'));
    }
} catch (Exception $e) {
    // Handle exceptions
    http_response_code(500);
    echo json_encode(array('message' => 'Internal Server Error', 'error' => $e->getMessage()));
}
?>
