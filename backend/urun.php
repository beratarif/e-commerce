<?php
header('Content-Type: application/json; charset=utf-8');

require_once 'db.php';

function test() {
    echo 'test';
}

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
            case 'urunler':
                $sayfa_basina_urun_sayisi = 9;
                
                $sayfa = $_GET['sayfa'];
                $kategori = $_GET['kategori'];

                $offset = $sayfa_basina_urun_sayisi * ($sayfa - 1);

                if ($kategori == 'yok') {
                    $sayfa_getir = $pdo->prepare('SELECT * FROM urunler LIMIT :sayfa_basina_urun_sayisi OFFSET :offset');
                }
                else {
                    $sayfa_getir = $pdo->prepare('SELECT * FROM urunler WHERE kategori = :kategori LIMIT :sayfa_basina_urun_sayisi OFFSET :offset');
                    $sayfa_getir->bindValue(':kategori', $kategori, PDO::PARAM_STR);
                }

                $sayfa_getir->bindValue(':sayfa_basina_urun_sayisi', $sayfa_basina_urun_sayisi, PDO::PARAM_INT);
                $sayfa_getir->bindValue(':offset', $offset, PDO::PARAM_INT);
                
                $sayfa_getir->execute();

                $urunler = $sayfa_getir->fetchAll(PDO::FETCH_ASSOC);

                echo json_encode($urunler);
                break;
        }
    } catch (PDOException $ex) {
        die('ürün hatası: ' . $ex->getMessage());
    }
}
?>