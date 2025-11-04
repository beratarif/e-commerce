<?php
require_once 'session.php';

$giris_yapildi = isset($_SESSION['giris_yapildi']) && $_SESSION['giris_yapildi'];

if ($giris_yapildi) {
  $kullanici = $_SESSION['kullanici'];
}
?>