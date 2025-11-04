<?php require_once '../global backend/anypage.php'; ?>

<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sepetim</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet" />
  <scrip src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-light border-bottom">
    <div class="container">
      <a class="navbar-brand fw-bold" href="../index.php">Mağazam</a>
      <button
        class="navbar-toggler"
        data-bs-toggle="collapse"
        data-bs-target="#navMenu">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav ms-auto align-items-center">
          <li class="nav-item">
            <a class="nav-link" href="../index.php">Anasayfa</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Product/product.php">Ürünler</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="basket.php">Sepet</a>
          </li>
          <?php if ($giris_yapildi): ?>
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle text-uppercase fw-semibold"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false">
                <?php echo htmlspecialchars($kullanici['ad_soyad']); ?>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item text-danger" href="../global backend/logout.php?hangi_cikis=normal">Çıkış Yap</a></li>
              </ul>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a href="LoginRegister/index.html" class="nav-link">Giriş</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>

  <!-- SEPET -->
  <div class="container my-5">
    <h2 class="mb-4">🛒 Sepetim</h2>

    <div class="row">
      <div class="col-lg-8">
        <!-- Ürün listesi -->
        <div id="cart-items" class="list-group mb-4">
          <p class="text-muted text-center">Sepetiniz boş.</p>
        </div>
      </div>

      <!-- ÖZET -->
      <div class="col-lg-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Sipariş Özeti</h5>
            <p class="card-text d-flex justify-content-between">
              <span>Ara Toplam:</span> <span id="subtotal">₺0</span>
            </p>
            <p class="card-text d-flex justify-content-between">
              <span>Kargo:</span> <span id="shipping">₺50</span>
            </p>
            <hr />
            <p class="card-text d-flex justify-content-between fw-bold">
              <span>Toplam:</span> <span id="total">₺50</span>
            </p>
            <button class="btn btn-success w-100 mt-3">
              Siparişi Onayla
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>