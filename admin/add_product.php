<?php
require_once "../backend/db.php";

header('Content-Type: application/json');

$name = $_POST['productName'] ?? '';
$price = $_POST['productPrice'] ?? '';
$category = $_POST['productCategory'] ?? '';
$stock = $_POST['productStock'] ?? '';

if (empty($_POST['name']) || empty($_POST['price']) || empty($_POST['category']) || empty($_POST['stock'])) {
    echo json_encode(["success" => false, "message" => "Tüm alanları doldurun."]);
    exit;
}

try {
  $stmt = $conn->prepare("INSERT INTO urunler (name, price, category, stock) VALUES (?, ?, ?, ?)");
  $stmt->execute([$name, $price, $category, $stock]);
  echo json_encode(["success" => true]);
} catch (PDOException $e) {
  echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
