<?php require_once '../backend/kullanici.php'; ?>

<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sepetim</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    .card-img-top {
      height: 200px;
      object-fit: contain;
      /* resim orantılı küçülür, boşluk kalabilir */
      background-color: #f8f9fa;
      /* arka plan boş kalırsa hoş durur */
    }

    footer {
      background: #212529;
      color: #ccc;
      padding: 2rem 0;
      text-align: center;
      margin-top: 4rem;
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
            <a class="nav-link" href="../Product/product.php?sayfa=1&kategori=yok">Ürünler</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="basket.php">Sepet</a>
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
                <li><a class="dropdown-item text-danger" href="../backend/logout.php?hangi_cikis=normal">Çıkış
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
  <!-- SEPET -->
  <div class="container my-5">
    <h2 class="mb-4">🛒 Sepetim</h2>

    <div class="row g-4">
      <div class="col-lg-8">
        <!-- Ürün listesi -->
        <div class="card mb-3">
          <div class="row g-0 align-items-center" id="basket-holder">

            <!-- card mb-3 -->
            <div class="col-md-3">
              <img
                src="data:image/jpeg;base64,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"
                class="img-fluid rounded-start" alt="Ürün 1" />
            </div>
            <div class="col-md-6">
              <div class="card-body">
                <h5 class="card-title mb-1">Mekanik RGB Klavye</h5>
                <p class="text-muted small mb-2">
                  Dayanıklı, sessiz tuşlu, USB bağlantılı.
                </p>
                <div class="d-flex align-items-center">
                  <button class="btn btn-outline-secondary btn-sm">-</button>
                  <span class="mx-2">1</span>
                  <button class="btn btn-outline-secondary btn-sm">+</button>
                </div>
              </div>
            </div>
            <div class="col-md-3 text-center">
              <p class="fw-semibold mb-1">₺899</p>
              <button class="btn btn-outline-danger btn-sm">Kaldır</button>
            </div>
          </div>


        </div>

        <!-- card mb-3 -->
        <div class="card mb-3">
          <div class="row g-0 align-items-center">
            <div class="col-md-3">
              <img
                src="data:image/jpeg;base64,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"
                class="img-fluid rounded-start" alt="Ürün 2" />
            </div>
            <div class="col-md-6">
              <div class="card-body">
                <h5 class="card-title mb-1">Gaming Mouse</h5>
                <p class="text-muted small mb-2">
                  RGB ışıklı, 16000 DPI, 7 tuşlu.
                </p>
                <div class="d-flex align-items-center">
                  <button class="btn btn-outline-secondary btn-sm">-</button>
                  <span class="mx-2">2</span>
                  <button class="btn btn-outline-secondary btn-sm">+</button>
                </div>
              </div>
            </div>
            <div class="col-md-3 text-center">
              <p class="fw-semibold mb-1">₺998</p>
              <button class="btn btn-outline-danger btn-sm">Kaldır</button>
            </div>
          </div>
        </div>
      </div>

      <!-- ÖZET -->
      <div class="col-lg-4">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Sipariş Özeti</h5>
            <p class="card-text d-flex justify-content-between">
              <span>Ara Toplam:</span> <span id="subtotal">₺1897</span>
            </p>
            <p class="card-text d-flex justify-content-between">
              <span>Kargo:</span> <span id="shipping">₺50</span>
            </p>
            <hr />
            <p class="card-text d-flex justify-content-between fw-bold">
              <span>Toplam:</span> <span id="total">₺1947</span>
            </p>
            <button class="btn btn-success w-100 mt-3">Siparişi Onayla</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer>
    <p>© 2025 Mağazam. Tüm hakları saklıdır.</p>
  </footer>

  <script src="script.js"></script>
</body>

</html>