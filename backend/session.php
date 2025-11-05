<?php
    session_start();

    function GirisYapSession($kullanici) {
        $_SESSION['giris_yapildi'] = true;
        $_SESSION['kullanici'] = $kullanici;

        header('location: ../index.php');
    }

    function GirisYapAdminSession($admin) {
        $_SESSION['yetkili_giris_yapildi'] = true;
        $_SESSION['yetkili'] = $admin;

        header('location: ../admin/dashboard.php');
    }
    
    function CikisYap() {
        session_unset();
        session_destroy();

        header("location: ../index.php");
    }

    function CikisYapYetkili() {
        session_unset();
        session_destroy();

        header("location: ../admin/index.html");
    }
?>