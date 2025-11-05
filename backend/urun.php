<?php
header('Content-Type: application/json; charset=utf-8');

require_once 'db.php';

if (isset($_GET['islem'])) {
    try {
        switch ($_GET['islem']) {
        case 'anasayfa':
            $urun_sayisi = 9;

            $urun_getir_biraz = $pdo->prepare('SELECT * FROM urunler LIMIT :urun_sayisi');
            $urun_getir_biraz->bindValue(':urun_sayisi', $urun_sayisi, PDO::PARAM_INT);
            $urun_getir_biraz->execute();
            
            echo json_encode($urun_getir_biraz->fetchAll(PDO::FETCH_ASSOC));
            break;
    }
    }
    catch (PDOException $ex) {
        die('ürün hatası: ' . $ex->getMessage());
    }
}
?>