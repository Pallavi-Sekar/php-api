<?php
require_once('../db.php');
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST': // Place an order
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $pdo->prepare("INSERT INTO OrderRecord (user_id, total_amount) VALUES (?, ?)");
        try {
            $stmt->execute([$data['user_id'], $data['total_amount']]);
            echo json_encode(['success' => true, 'message' => 'Order placed successfully.']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
        break;

    case 'GET': // Get all orders for a user
        $user_id = $_GET['user_id'];
        $stmt = $pdo->prepare("SELECT * FROM OrderRecord WHERE user_id = ?");
        $stmt->execute([$user_id]);
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(['success' => true, 'data' => $orders]);
        break;
}
?>
