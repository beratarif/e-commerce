<?php require_once 'global backend/anypage.php'; ?>

<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Mağazam</title>

  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    body {
      background-color: #f8f9fa;
    }

    .hero {
      background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),
        url("img/banner.jpg") center/cover;
      color: #fff;
      text-align: center;
      padding: 6rem 1rem;
      border-radius: 1rem;
    }

    .category-btn {
      border-radius: 25px;
      transition: 0.2s;
    }

    .category-btn:hover {
      background-color: #0d6efd;
      color: #fff;
      transform: scale(1.05);
    }

    footer {
      background: #212529;
      color: #ccc;
      padding: 2rem 0;
      text-align: center;
      margin-top: 4rem;
    }

    .navbar .nav-link.dropdown-toggle {
      display: flex;
      align-items: center;
      gap: 4px;
      padding-top: 0.5rem;
      padding-bottom: 0.5rem;
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

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-light border-bottom">
    <div class="container">
      <a class="navbar-brand fw-bold" href="index.php">Mağazam</a>
      <button
        class="navbar-toggler"
        data-bs-toggle="collapse"
        data-bs-target="#navMenu">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav ms-auto align-items-center">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Anasayfa</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Product/product.php">Ürünler</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Sepet/basket.php">Sepet</a>
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
                <li><a class="dropdown-item text-primary" href="Profil/index.php">Profil</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item text-danger" href="./global backend/logout.php?hangi_cikis=normal">Çıkış Yap</a></li>
              </ul>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a href="./LoginRegister/index.php" class="nav-link">Giriş</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Hero -->
  <section class="hero my-4">
    <div class="container">
      <h1 class="display-4 fw-bold">Yeni Sezon Ürünleri</h1>
      <p class="lead mb-4">
        Modern, uygun fiyatlı ve kaliteli ürünlerle tanış.
      </p>
      <a href="#products" class="btn btn-primary btn-lg px-4">Alışverişe Başla</a>
    </div>
  </section>

  <!-- Kategoriler -->
  <section class="container text-center my-5">
    <h2 class="mb-4 fw-bold">Kategoriler</h2>
    <div class="d-flex flex-wrap justify-content-center gap-3">
      <button class="btn btn-outline-primary category-btn">Elektronik</button>
      <button class="btn btn-outline-primary category-btn">Giyim</button>
      <button class="btn btn-outline-primary category-btn">Aksesuar</button>
      <button class="btn btn-outline-primary category-btn">Ev & Yaşam</button>
    </div>
  </section>

  <!-- Yeni Ürünler -->
  <section id="products" class="container my-5">
    <div class="container my-5">
      <h2 class="mb-4">Yeni Ürünler</h2>
      <div class="row g-4">
        <!-- Ürün Kartı -->
        <div class="col-md-4 col-sm-6">
          <div class="card h-100 shadow-sm">
            <img src="img/headphone.jpeg" class="card-img-top" alt="Ürün Görseli">
            <div class="card-body">
              <h5 class="card-title">Kablosuz Kulaklık</h5>
              <p class="card-text text-muted">Kablosuz</p>
              <p class="fw-bold fs-5 mb-3">₺249,90</p>
              <a href="#" class="btn btn-primary w-100">Sepete Ekle</a>
            </div>
          </div>
        </div>

        <!-- Aynı yapıyı çoğalt -->
        <div class="col-md-4 col-sm-6">
          <div class="card h-100 shadow-sm">
            <img src="img/tshirt.jpeg" class="card-img-top" alt="Ürün Görseli">
            <div class="card-body">
              <h5 class="card-title">T-Shirt</h5>
              <p class="card-text text-muted">Sade siyah t-shirt</p>
              <p class="fw-bold fs-5 mb-3">₺130,90</p>
              <a href="#" class="btn btn-primary w-100">Sepete Ekle</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-6">
          <div class="card h-100 shadow-sm">
            <img src="img/mug.jpeg" class="card-img-top" alt="Ürün Görseli">
            <div class="card-body">
              <h5 class="card-title">Bardak</h5>
              <p class="card-text text-muted">Cam bardak su içilir</p>
              <p class="fw-bold fs-5 mb-3">₺299,90</p>
              <a href="#" class="btn btn-primary w-100">Sepete Ekle</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-6">
          <div class="card h-100 shadow-sm">
            <img src="img/pillow.jpeg" class="card-img-top" alt="Ürün Görseli">
            <div class="card-body">
              <h5 class="card-title">Yastık</h5>
              <p class="card-text text-muted">Yumuşak yastık</p>
              <p class="fw-bold fs-5 mb-3">₺99,90</p>
              <a href="#" class="btn btn-primary w-100">Sepete Ekle</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-6">
          <div class="card h-100 shadow-sm">
            <img src="img/sunglasses.webp" class="card-img-top" alt="Ürün Görseli">
            <div class="card-body">
              <h5 class="card-title">Güneş Gözlüğü</h5>
              <p class="card-text text-muted">Gözünüzü güneşten koruyun</p>
              <p class="fw-bold fs-5 mb-3">₺399,90</p>
              <a href="#" class="btn btn-primary w-100">Sepete Ekle</a>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>

  <!-- Footer -->
  <footer>
    <p>© 2025 Mağazam. Tüm hakları saklıdır.</p>
  </footer>

  <script src="js/product.js"></script>
  <script src="js/app.js"></script>
</body>

</html>