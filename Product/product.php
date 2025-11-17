<?php
require_once '../backend/page.php';
require_once '../backend/db.php';

$guncel_sayfa = $_GET['sayfa'];
$kategori = $_GET['kategori'];

// sonraki sayfa kontrolü
$sayfa_basina_urun_sayisi = 9;
$offset = $sayfa_basina_urun_sayisi * $guncel_sayfa;
if ($kategori == 'yok') {
  $sayfa_getir = $pdo->prepare('SELECT * FROM urunler LIMIT :sayfa_basina_urun_sayisi OFFSET :offset');
} else {
  $sayfa_getir = $pdo->prepare('SELECT * FROM urunler WHERE kategori = :kategori LIMIT :sayfa_basina_urun_sayisi OFFSET :offset');
  $sayfa_getir->bindValue(':kategori', $kategori, PDO::PARAM_STR);
}
$sayfa_getir->bindValue(':sayfa_basina_urun_sayisi', $sayfa_basina_urun_sayisi, PDO::PARAM_INT);
$sayfa_getir->bindValue(':offset', $offset, PDO::PARAM_INT);
$sayfa_getir->execute();
$sayfa_urun_sayisi = count($sayfa_getir->fetchAll(PDO::FETCH_ASSOC));

function OncekiSayfa($guncel_sayfa)
{
  return $guncel_sayfa - 1;
}

function SonrakiSayfa($guncel_sayfa)
{
  return $guncel_sayfa + 1;
}

function OncekiSayfayaGidilebilirMi($onceki_sayfa)
{
  return $onceki_sayfa <= 0;
}

function SonrakiSayfayaGidebilirMi($sonraki_sayfa_urun_sayisi)
{
  if ($sonraki_sayfa_urun_sayisi == 0) {
    return true;
  } else {
    return false;
  }
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
          <a href="product.php?sayfa=1&kategori=yok" class="list-group-item list-group-item-action">Tümü</a>
          <a href="product.php?sayfa=1&kategori=elektronik"
            class="list-group-item list-group-item-action">Elektronik</a>
          <a href="product.php?sayfa=1&kategori=giyim" class="list-group-item list-group-item-action">Giyim</a>
          <a href="product.php?sayfa=1&kategori=aksesuar" class="list-group-item list-group-item-action">Aksesuar</a>
          <a href="product.php?sayfa=1&kategori=ev_yasam" class="list-group-item list-group-item-action">Ev & Yaşam</a>
        </div>
      </div>
      <div class="col-lg-9">
        <div id="product-holder" class="row g-4">
          <!-- Products -->
        </div>

        <!-- Sayfa geçişleri -->
        <?php if (!SonrakiSayfayaGidebilirMi($sayfa_urun_sayisi) || $guncel_sayfa > 1): ?>
          <div class="d-flex justify-content-center align-items-center mt-4">
            <a id="prevBtn"
              href="product.php?sayfa=<?php echo OncekiSayfa($guncel_sayfa); ?>&kategori=<?php echo $kategori; ?>"
              class="btn btn-outline-primary me-2 <?php if (OncekiSayfayaGidilebilirMi(OncekiSayfa($guncel_sayfa))): ?> disabled <?php endif; ?>">
              <i class="fas fa-arrow-left"></i>
            </a>

            <span class="mx-2">Sayfa <?php echo $guncel_sayfa; ?></span>

            <a id="nextBtn"
              href="product.php?sayfa=<?php echo SonrakiSayfa($guncel_sayfa); ?>&kategori=<?php echo $kategori; ?>"
              class="btn btn-outline-primary ms-2 <?php if (SonrakiSayfayaGidebilirMi($sayfa_urun_sayisi)): ?> disabled <?php endif; ?>">
              <i class="fas fa-arrow-right"></i>
            </a>
          </div>
        <?php else: ?>
          <!-- burası eğer o kategoride ürün bulunmaz ise görünecek kısım -->
        <?php endif; ?>
      </div>
    </div>
  </div>

  <script src="script.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", async () => {
      await urunGetir(<?php echo $_GET['sayfa'] ?>, '<?php echo $_GET['kategori'] ?>');
    });

    const categories = document.querySelectorAll('#category-list a');

    switch ('<?php echo $_GET['kategori']; ?>') {
      case 'yok': categories[0].classList.add("active"); break;
      case 'elektronik': categories[1].classList.add("active"); break;
      case 'giyim': categories[2].classList.add("active"); break;
      case 'aksesuar': categories[3].classList.add("active"); break;
      case 'ev_yasam': categories[4].classList.add("active"); break;
      default: break;
    }
  </script>
</body>

</html>