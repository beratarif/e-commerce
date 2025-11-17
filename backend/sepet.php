<?php
header('Content-Type: application/json; charset=utf-8');

require_once 'db.php';
require_once 'kullanici.php';

$kullanici_id = $kullanici['id'];

switch ($_GET['islem']) {
    case 'ekle':
        $urun_id = $_GET['id'];
        $eklenecek_adet = 1;

        $sepet_getir = $pdo->prepare('SELECT * FROM sepetler WHERE kullanici_id = :kullanici_id AND urun_id = :urun_id LIMIT 1');
        $sepet_getir->execute([
            ':urun_id' => $urun_id,
            ':kullanici_id' => $kullanici_id
        ]);
        
        $sepet = $sepet_getir->fetch(PDO::FETCH_ASSOC);
        if ($sepet) {
            $sepet_guncelle = $pdo->prepare('UPDATE sepetler SET adet = :yeni_adet WHERE kullanici_id = :kullanici_id AND urun_id = :urun_id');
            $sepet_guncelle->execute([
                ':yeni_adet' => $sepet['adet'] + $eklenecek_adet,
                ':kullanici_id' => $kullanici_id,
                ':urun_id' => $urun_id
            ]);
        } else {
            $sepet_ekle = $pdo->prepare('INSERT INTO sepetler (kullanici_id, urun_id, adet) VALUES (:kullanici_id, :urun_id, :adet)');
            $sepet_ekle->execute([
                ':kullanici_id' => $kullanici_id,
                ':urun_id' => $urun_id,
                ':adet' => $eklenecek_adet
            ]);
        }

        header("location: ../Sepet/basket.php");
        break;
    case 'getir':
        $sepet_getir = $pdo->prepare('SELECT * FROM sepetler WHERE kullanici_id = :kullanici_id');
        $sepet_getir->execute([':kullanici_id' => $kullanici_id]);

        // ürün => adet

        echo var_dump($sepet_getir->fetchAll(PDO::FETCH_ASSOC));
        break;
}
?>