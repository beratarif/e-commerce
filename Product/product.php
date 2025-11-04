<?php require_once '../global backend/anypage.php'; ?>

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
            <a class="nav-link" href="product.php">Ürünler</a>
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
                <li><a class="dropdown-item text-danger" href="../LoginRegister/backend/logout.php">Çıkış Yap</a></li>
              </ul>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a href="../LoginRegister/index.html" class="nav-link">Giriş</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container my-5">
    <h2 class="mb-4">Ürünler</h2>
    <div id="product-list" class="row"></div>
  </div>

  <script>
    const list = document.getElementById("product-list");

    // Backend'den ürünleri çek
    async function loadProducts() {
      try {
        const res = await fetch("../backend/api/urunler.php");
        const data = await res.json();

        list.innerHTML = data.map(p => `
          <div class="col-md-4 mb-4">
            <div class="card p-3 text-center">
              <img src="${p.image}" class="card-img-top mb-2" alt="${p.name}">
              <h5>${p.name}</h5>
              <p>₺${p.price}</p>
              <button class="btn btn-primary" onclick="addToCart(${p.id})">Sepete Ekle</button>
            </div>
          </div>
        `).join("");
      } catch (err) {
        list.innerHTML = `<p class="text-danger text-center">Ürünler yüklenemedi.</p>`;
        console.error(err);
      }
    }

    // Sepete ekleme işlemi artık backend'e istek atıyor
    async function addToCart(id) {
      try {
        const res = await fetch("../backend/api/sepet_ekle.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json"
          },
          body: JSON.stringify({
            product_id: id
          })
        });

        const result = await res.json();
        if (result.success) {
          alert("Ürün sepete eklendi!");
        } else {
          alert("Sepete eklenirken hata oluştu.");
        }
      } catch (err) {
        console.error(err);
        alert("Bağlantı hatası.");
      }
    }

    loadProducts();
  </script>
</body>

</html>