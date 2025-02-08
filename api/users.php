<?php
require_once('../db.php');
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Allow API testing
header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

$method = $_SERVER['REQUEST_METHOD'];
$endpoint = $_GET['action'] ?? '';

switch ($method) {
    case 'POST':
        if ($endpoint === 'register') { // User Registration
            $data = json_decode(file_get_contents("php://input"), true);
            if (!isset($data['email'], $data['password'], $data['username'], $data['shipping_address'])) {
                echo json_encode(['success' => false, 'message' => 'Missing required fields']);
                exit;
            }

            $purchaseHistory = $data['purchase_history'] ?? ''; // Default to empty if not provided

            $stmt = $pdo->prepare(
                "INSERT INTO User (email, password, username, shipping_address, purchase_history) VALUES (?, ?, ?, ?, ?)"
            );

            try {
                $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);
                $stmt->execute([$data['email'], $hashedPassword, $data['username'], $data['shipping_address'], $purchaseHistory]);
                echo json_encode(['success' => true, 'message' => 'User registered successfully.']);
            } catch (PDOException $e) {
                echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
            }
        } elseif ($endpoint === 'login') { // User Login
            $data = json_decode(file_get_contents("php://input"), true);
            if (!isset($data['email'], $data['password'])) {
                echo json_encode(['success' => false, 'message' => 'Missing required fields']);
                exit;
            }

            $stmt = $pdo->prepare("SELECT * FROM User WHERE email = ?");
            $stmt->execute([$data['email']]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($data['password'], $user['password'])) {
                unset($user['password']); // Remove sensitive information
                echo json_encode(['success' => true, 'message' => 'Login successful', 'user' => $user]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid credentials']);
            }
        }
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Unsupported request method']);
}
?>
