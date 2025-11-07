<?php
require_once "../backend/db.php";

$stmt = $conn->prepare("SELECT * FROM urunler ORDER BY id DESC");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($products);
?>