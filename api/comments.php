<?php
require_once('../db.php');
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');
 
$method = $_SERVER['REQUEST_METHOD'];
 
if ($method === 'GET') {
    try {
        $stmt = $pdo->prepare(
            "SELECT DISTINCT p.product_id, p.description, p.image, p.pricing, p.shipping_cost
            FROM Product p
            JOIN Comments c ON p.product_id = c.product_id"
        );
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
        echo json_encode(['success' => true, 'data' => $products]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Unsupported request method']);
}
?>
 