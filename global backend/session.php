<?php
    session_start();

    function GirisYapSession($kullanici) {
        $_SESSION['giris_yapildi'] = true;
        $_SESSION['kullanici'] = $kullanici;

        header('location: ../../index.php');
    }
    
    function CikisYap() {
        session_unset();
        session_destroy();

        header("location: ../../index.php");
    }
?>