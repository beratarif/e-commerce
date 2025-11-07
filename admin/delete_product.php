<?php
require_once "../backend/db.php";
header('Content-Type: application/json');

$id = $_GET['id'] ?? null;

if (!$id) {
  echo json_encode(["success" => false, "message" => "Geçersiz ID"]);
  exit;
}

try {
  $stmt = $conn->prepare("DELETE FROM urunler WHERE id = ?");
  $stmt->execute([$id]);
  echo json_encode(["success" => true]);
} catch (PDOException $e) {
  echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
?>