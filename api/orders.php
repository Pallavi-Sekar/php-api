<?php
require_once('../db.php');
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Allow cross-origin requests
header('Access-Control-Allow-Methods: GET'); // Allow only GET method
header('Access-Control-Allow-Headers: Content-Type'); // Allow Content-Type header
 
$method = $_SERVER['REQUEST_METHOD'];
 
switch ($method) {
    case 'GET': // Get all orders for a user
        if (!isset($_GET['user_id'])) {
            echo json_encode(['success' => false, 'message' => 'Missing required parameter: user_id']);
            exit;
        }
 
        $user_id = $_GET['user_id'];
        $stmt = $pdo->prepare("SELECT * FROM OrderRecord WHERE user_id = ?");
        $stmt->execute([$user_id]);
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
        if ($orders) {
            echo json_encode(['success' => true, 'data' => $orders]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No orders found for the user']);
        }
        break;
 
    default:
        echo json_encode(['success' => false, 'message' => 'Unsupported request method']);
}
?>
 