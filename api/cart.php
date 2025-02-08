<?php
require_once('../db.php');
header('Content-Type: application/json');
 
$method = $_SERVER['REQUEST_METHOD'];
 
switch ($method) {
    case 'GET': // Get user's cart
        $user_id = $_GET['user_id'];
        $stmt = $pdo->prepare("SELECT * FROM Cart WHERE user_id = ?");
        $stmt->execute([$user_id]);
        $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(['success' => true, 'data' => $cartItems]);
        break;
 
    case 'POST': // Add product to cart
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $pdo->prepare("INSERT INTO Cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
        try {
            $stmt->execute([$data['user_id'], $data['product_id'], $data['quantity']]);
            echo json_encode(['success' => true, 'message' => 'Product added to cart.']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
        break;
}
?>