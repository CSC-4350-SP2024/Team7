<?php
include 'connectDB.php';

if (!isset($_COOKIE["user_id"]) || $_COOKIE["user_id"] < 0) {
    header("Location: login.php");
    exit;
}

function saveScreenshot($base64ImageData) {
    $filename = uniqid() . '.png';
    $imageData = base64_decode($base64ImageData);
    $filepath = 'saved_puzzle_images/' . $filename;
    file_put_contents($filepath, $imageData);
    return $filepath;
}

$data = json_decode(file_get_contents('php://input'), true);

$userId = $_COOKIE["user_id"];
$puzzleState = $data['puzzleState'];
$imageData = $data['imageData']; 

$imagePath = saveScreenshot($imageData);

try {
    $stmt = $conn->prepare('INSERT INTO saved_puzzle_states (user_id, puzzle_state, image_path) VALUES (?, ?, ?)'); 
    $stmt->bind_param('iss', $userId, $puzzleState, $imagePath);
    $stmt->execute();

    echo 'Puzzle state saved successfully.';
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>


