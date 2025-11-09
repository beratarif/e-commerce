<?php
require_once "../backend/db.php";

header('Content-Type: application/json');

$name = $_POST['productName'] ?? '';
$price = $_POST['productPrice'] ?? '';
$category = $_POST['productCategory'] ?? '';
$stock = $_POST['productStock'] ?? '';
$img = $_FILES['productImage']['name'] ?? '';
$desc = $_POST['productDesc'] ?? '';

if (empty($name) || empty($price) || empty($category) || empty($stock) || empty($desc)) {
  echo json_encode(["success" => false, "message" => "Tüm alanları doldurun. (test)"]);
  exit;
}


try {
  $stmt = $pdo->prepare("INSERT INTO urunler (ad, fiyat, kategori, stock, gorsel, aciklama) VALUES (?, ?, ?, ?,?,?)");
  $stmt->execute([$name, $price, $category, $stock, $img, $desc]);
  echo json_encode(["success" => true]);
} catch (PDOException $e) {
  echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
