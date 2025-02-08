<?php
require_once('../db.php');
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET': // Get all products
        try {
            $stmt = $pdo->query("SELECT * FROM Product");
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode(['success' => true, 'data' => $products]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
        break;

    case 'POST': // Create a new product
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $pdo->prepare("INSERT INTO Product (description, image, pricing, shipping_cost) VALUES (?, ?, ?, ?)");
        try {
            $stmt->execute([$data['description'], $data['image'], $data['pricing'], $data['shipping_cost']]);
            echo json_encode(['success' => true, 'message' => 'Product added successfully.']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
        break;
}
?>
