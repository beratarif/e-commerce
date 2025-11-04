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
    <h2 class="mb-4 fw-bold text-center">Yeni Ürünler</h2>
    <div class="row" id="productList"></div>
  </section>

  <!-- Footer -->
  <footer>
    <p>© 2025 Mağazam. Tüm hakları saklıdır.</p>
  </footer>

  <script src="js/product.js"></script>
  <script src="js/app.js"></script>
</body>

</html>