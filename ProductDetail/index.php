<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ürünler</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
  footer {
    background: #212529;
    color: #ccc;
    padding: 2rem 0;
    text-align: center;
    margin-top: 4rem;
  }
</style>

<body>
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
            <a class="nav-link" href="../index.php">Anasayfa</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Product/product.php">Ürünler</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Sepet/basket.php">Sepet</a>
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

  <div class="container my-5">
    <div class="row">
      <div class="col-md-6">
        <img src="../img/headphone.jpeg" class="img-fluid rounded" />
      </div>
      <div class="col-md-6">
        <h1>Kulaklık</h1>
        <p>Yüksek Ses Kalitesi sunar.</p>
        <h4>300₺</h4>
        <button class="btn btn-success" id="addToCart" data-id="1">
          Sepete Ekle
        </button>
      </div>
    </div>

    <div class="container my-5">
      <h2 class="mb-4">Diğer Ürünler</h2>
      <div class="row g-4">
        <div class="col-md-4 col-sm-6">
          <div class="card h-100 shadow-sm">
            <img src="../img/tshirt.jpeg" class="card-img-top" alt="Ürün Görseli">
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
            <img src="../img/mug.jpeg" class="card-img-top" alt="Ürün Görseli">
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
            <img src="../img/pillow.jpeg" class="card-img-top" alt="Ürün Görseli">
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
            <img src="../img/sunglasses.webp" class="card-img-top" alt="Ürün Görseli">
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

    <footer>
      <p>© 2025 Mağazam. Tüm hakları saklıdır.</p>
    </footer>

    <script>
      const productList = document.getElementById("productList");

      // Ürünleri backend'den al
      async function loadProducts() {
        try {
          const res = await fetch("../backend/api/urunler.php");
          const products = await res.json();

          productList.innerHTML = products
            .map(
              (p) => `
            <div class="col-md-3 mb-4">
              <div class="card shadow-sm h-100">
                <img src="${p.img}" class="card-img-top" alt="${p.name}">
                <div class="card-body d-flex flex-column">
                  <h5 class="card-title">${p.name}</h5>
                  <p class="card-text text-muted mb-4">${p.price} ₺</p>
                  <button class="btn btn-primary mt-auto add-cart" data-id="${p.id}">Sepete Ekle</button>
                </div>
              </div>
            </div>
          `
            )
            .join("");
        } catch (err) {
          console.error(err);
          productList.innerHTML = `<p class="text-center text-danger py-5">Ürünler yüklenemedi.</p>`;
        }
      }

      // Sepete ekleme işlemi artık backend'e istek gönderiyor
      async function addToCart(productId) {
        try {
          const res = await fetch("../backend/api/sepet_ekle.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/json"
            },
            body: JSON.stringify({
              product_id: productId
            }),
          });

          const data = await res.json();
          if (data.success) {
            alert("Ürün sepete eklendi!");
          } else {
            alert("Sepete eklenirken bir hata oluştu.");
          }
        } catch (err) {
          console.error(err);
          alert("Sunucuya bağlanırken hata oluştu.");
        }
      }

      document.addEventListener("click", (e) => {
        if (e.target.classList.contains("add-cart")) {
          const id = e.target.dataset.id;
          addToCart(id);
        }
      });

      loadProducts();
    </script>
</body>

</html>