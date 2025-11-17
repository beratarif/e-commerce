<?php
require_once 'db.php';
require_once 'session.php';

try {
    $eposta = $_POST['eposta'];
    $sifre = $_POST['sifre'];

    // yetkili getirme işlemi (şifre kontrolü için)
    $yetkili_getir = $pdo->prepare('SELECT * FROM yetkililer WHERE eposta = :eposta');
    $yetkili_getir->execute([':eposta' => $eposta]);
    $yetkili = $yetkili_getir->fetch(PDO::FETCH_ASSOC);

    // yetkili kontrolü
    if (!$yetkili)
        die('yetkili bulunamadı');

    if ($sifre != $yetkili['sifre'])
        die('şifre yanlış');

    GirisYapAdminSession(['eposta' => $eposta]);
}
catch (PDOException $ex) {
    die('admin girişyap hatası: ' . $ex->getMessage());
}
?>