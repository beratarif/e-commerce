<?php require_once '../backend/page.php'; ?>


<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ürün Detay</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    footer {
      background: #212529;
      color: #ccc;
      padding: 2rem 0;
      text-align: center;
      margin-top: 4rem;
    }

    .product-img-big {
      width: 100%;
      border-radius: 14px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, .15);
    }

    .product-title {
      font-size: 2.2rem;
      font-weight: 700;
      margin-bottom: .5rem;
    }

    .product-price {
      font-size: 1.9rem;
      font-weight: 800;
      color: #28a745;
    }

    .other-card img {
      height: 170px;
      object-fit: cover;
      border-radius: 10px;
    }

    .other-card {
      transition: .25s ease;
      border-radius: 12px !important;
      overflow: hidden;
    }

    .other-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, .12);
    }

    .card-img-top {
      height: 200px;
      object-fit: contain;
      /* resim orantılı küçülür, boşluk kalabilir */
      background-color: #f8f9fa;
      /* arka plan boş kalırsa hoş durur */
    }
  </style>
</head>

<body class="bg-light">

  <!-- NAVBAR -->
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


  <!-- ÜRÜN DETAY -->
  <div class="container my-5">
    <div class="row g-5">

      <div class="col-md-6">
        <img src="../img/pillow.jpeg" class="product-img-big">
      </div>

      <div class="col-md-6">
        <h1 class="product-title">Ürün İsmi Buraya</h1>
        <p class="text-muted mb-3">Bu ürünün açıklaması lorem ipsum tarzı bir şeyler buraya gelecek.</p>

        <div class="product-price mb-4">999₺</div>

        <button class="btn btn-success btn-lg px-4">
          <i class="fa-solid fa-cart-shopping me-2"></i> Sepete Ekle
        </button>
      </div>

    </div>
  </div>


  <!-- BENZER ÜRÜNLER -->
  <section id="products" class="container my-5">
    <div class="container my-5">
      <h2 class="mb-4">Diğer Ürünler</h2>
      <div id="product-holder" class="row g-4">
        <!-- products are here -->
      </div>
    </div>

  </section>


  <!-- FOOTER -->
  <footer>
    <p>© 2025 Mağazam. Tüm hakları saklıdır.</p>
  </footer>
  <script src="script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>