<?php
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    header('Allow: GET');
    http_response_code(405);
    echo json_encode(array('message' => 'Method not allowed'));
    return;
}

// Set HTTP response headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

// Include necessary files
include_once '../db/Database.php';
include_once '../models/Bookmark.php';

// Instantiate Database and Bookmark
$database = new Database();
$db = $database->connect();
$bookmark = new Bookmark($db);

// Read all bookmarks
$result =$bookmark->readAll();
if(!empty($result)){
    echo json_encode($result);
} else {
    http_response_code(404);
    echo json_encode(array('message' => 'Bookmark not found'));
}