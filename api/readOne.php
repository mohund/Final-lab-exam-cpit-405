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



// Get the HTTP GET request query parameters  ( e.g.  ?id=140 )
if (empty($_GET['id'])) {
    http_response_code(422);
    echo json_encode(array('message' => 'ID is missing'));
    return;
}



// Set bookmark properties
$bookmark->setId($_GET['id']);
if ($bookmark->readOne()) {
    $bookmarkArr = array(
        'id' => $bookmark->getId(),
        'title' => $bookmark->getTitle(),
        'link' => $bookmark->getLink(),
        'date_added' => $bookmark->getDateAdded()
    );
    echo json_encode($bookmarkArr);
} else {
    http_response_code(404);
    echo json_encode(array('message' => 'Bookmark not found'));
}

