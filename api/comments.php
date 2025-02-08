<?php
require_once('../db.php');
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET': // Fetch all comments for a product
        $product_id = $_GET['product_id'];
        $stmt = $pdo->prepare("SELECT * FROM Comments WHERE product_id = ?");
        $stmt->execute([$product_id]);
        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(['success' => true, 'data' => $comments]);
        break;

    case 'POST': // Add a comment
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $pdo->prepare("INSERT INTO Comments (product_id, user_id, rating, image, text) VALUES (?, ?, ?, ?, ?)");
        try {
            $stmt->execute([$data['product_id'], $data['user_id'], $data['rating'], $data['image'], $data['text']]);
            echo json_encode(['success' => true, 'message' => 'Comment added successfully.']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
        break;
}
?>
