<?php require_once '../../backend/kullanici.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../../css/icons.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-light border-bottom">
    <div class="container">
      <a class="navbar-brand fw-bold" href="../../index.php">Mağazamız</a>
      <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navMenu">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav ms-auto align-items-center">
          <li class="nav-item">
            <a class="nav-link" href="../../index.php">Anasayfa</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../Product/product.php?sayfa=1&kategori=yok">Ürünler</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../basket.php">Sepet</a>
          </li>

          <?php if ($giris_yapildi): ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-uppercase fw-semibold" href="#" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                <?php echo htmlspecialchars($kullanici['ad_soyad']); ?>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item text-primary" href="../../Profile/index.php">Profil</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item text-danger" href="../../backend/logout.php?hangi_cikis=normal">Çıkış
                    Yap</a></li>
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

    <div class="container my-5 ">
        <h3 class="mb-4 fw-bold">Ödeme Yöntemleri</h3>
        <div class="payment-method row g-3">
            <!-- Kredi Kartı Alanı -->
            <div class="col-md-4">
                <div class="payment-card" data-method="kredi">
                    <i class="fas fa-credit-card fa-2x mb-2"></i>
                    <h5>Kredi / Banka Kartı</h5>
                    <p class="classtext-muted small">Visa, Mastercard desteklenir.</p>
                </div>
            </div>

            <!-- Kapıda Ödeme -->
             <div class="col-md-4">
                <div class="payment-card" data-method="kapida">
                    <i class="fas fa-truck fa-2x mb-2"></i>
                    <h5>Kapıda Ödeme</h5>
                    <p class="text-muted small">Teslimatta nakit ödeme.</p>
                </div>
             </div>

             <!-- Havale / Eft yöntemi -->
             <div class="col-md-4">
                <div class="payment-card" data-method="eft">
                    <i class="fas fa-university fa-2x mb-2"></i>
                    <h5>Havale / EFT</h5>
                    <p class="text-muted small">Bankalar arası güvenli transfer.</p>
                </div>
             </div>
        </div>
        <div class="mt-4" id="selectedMethodBox" style="display: none;">
            <div class="alert alert-info">
                Seçilen ödeme yöntemi: <strong id="selectedMethodText"></strong>
            </div>
        </div>
        <button id="confirmOrder" class="btn btn-success mt-4 w-100 fw-bold">
            Siparişi onayla
        </button>
    </div>
    <script src="script.js"></script>
</body>

</html>