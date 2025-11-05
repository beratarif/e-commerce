<?php
require_once '../backend/page.php';

$guncel_sayfa = $_GET['sayfa'];
$kategori = $_GET['kategori'];

function OncekiSayfa($guncel_sayfa)
{
  $onceki_sayfa = $guncel_sayfa - 1;

  if ($onceki_sayfa < 1) {
    $onceki_sayfa = 1;
  }

  return $onceki_sayfa;
}

function SonrakiSayfa($guncel_sayfa)
{
  return $guncel_sayfa + 1;
}
?>

<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ürünler</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/icons.css">
  <style>
    .card-img-top {
      height: 200px;
      object-fit: contain;
      /* resim orantılı küçülür, boşluk kalabilir */
      background-color: #f8f9fa;
      /* arka plan boş kalırsa hoş durur */
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-light border-bottom">
    <div class="container">
      <a class="navbar-brand fw-bold" href="../index.php">Mağazam</a>
      <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navMenu">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav ms-auto align-items-center">
          <li class="nav-item">
            <a class="nav-link" href="../index.php">Anasayfa</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="product.php?sayfa=1&kategori=yok">Ürünler</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Sepet/basket.php">Sepet</a>
          </li>

          <?php if ($giris_yapildi): ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-uppercase fw-semibold" href="#" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                <?php echo htmlspecialchars($kullanici['ad_soyad']); ?>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item text-primary" href="../Profile/index.php">Profil</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item text-danger" href="../backend/logout.php?hangi_cikis=normal">Çıkış Yap</a>
                </li>
              </ul>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a href="../LoginRegister/index.php" class="nav-link">Giriş</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container my-5">
    <h2 class="mb-4">🛍 Ürünler</h2>
    <div class="row">
      <div class="col-lg-3 mb-4">
        <div class="list-group" id="category-list">
          <a href="#" class="list-group-item list-group-item-action">Tümü</a>
          <a href="#" class="list-group-item list-group-item-action">Elektronik</a>
          <a href="#" class="list-group-item list-group-item-action">Giyim</a>
          <a href="#" class="list-group-item list-group-item-action">Kozmetik</a>
          <a href="#" class="list-group-item list-group-item-action">Ev & Yaşam</a>
        </div>
      </div>
      <div class="col-lg-9">
        <div id="product-holder" class="row g-4">
          <!-- Products -->
        </div>

        <!-- Sayfa geçişleri -->
        <div class="d-flex justify-content-center align-items-center mt-4">
          <a
            id="prevBtn"
            href="product.php?sayfa=<?php echo OncekiSayfa($guncel_sayfa); ?>&kategori=<?php echo $kategori; ?>"
            class="btn btn-outline-primary me-2">
            <i class="fas fa-arrow-left"></i>
          </a>

          <span class="mx-2">Sayfa <?php echo $guncel_sayfa; ?></span>

          <a
            id="nextBtn"
            href="product.php?sayfa=<?php echo SonrakiSayfa($guncel_sayfa); ?>&kategori=<?php echo $kategori; ?>"
            class="btn btn-outline-primary ms-2">
            <i class="fas fa-arrow-right"></i>
          </a>
        </div>
      </div>
    </div>

    <script src="script.js"></script>
    <script>
      document.addEventListener("DOMContentLoaded", () => {
        urunGetir(<?php echo $_GET['sayfa'] ?>, '<?php echo $_GET['kategori'] ?>');
      });
    </script>
</body>

<!-- <a
  class="btn btn-outline-primary me-2 <?php echo ($guncel_sayfa <= 1) ? 'disabled' : ''; ?>"
  href="<?php echo ($guncel_sayfa <= 1) ? '#' : 'product.php?sayfa=' . OncekiSayfa($guncel_sayfa) . '&kategori=' . $kategori; ?>"
>
  <i class="fas fa-arrow-left"></i>
</a>

<a
  class="btn btn-outline-primary ms-2 <?php echo ($guncel_sayfa >= $toplam_sayfa) ? 'disabled' : ''; ?>"
  href="<?php echo ($guncel_sayfa >= $toplam_sayfa) ? '#' : 'product.php?sayfa=' . SonrakiSayfa($guncel_sayfa) . '&kategori=' . $kategori; ?>"
>
  <i class="fas fa-arrow-right"></i>
</a> -->

</html>