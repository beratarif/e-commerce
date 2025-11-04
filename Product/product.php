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

  <div class="container my-5">
    <h2 class="mb-4">Ürünler</h2>
    <div id="product-list" class="row"></div>
  </div>

  <script>
    const products = [{
        id: 1,
        name: "Kablosuz Kulaklık",
        price: 750,
        image: "../img/headphone.jpeg",
      },
      {
        id: 2,
        name: "Akıllı Saat",
        price: 1250,
        image: "../img/mug.jpeg",
      },
      {
        id: 3,
        name: "Güneş Gözlüğü",
        price: 550,
        image: "../img/sunglasses.webp",
      },
    ];

    const list = document.getElementById("product-list");
    list.innerHTML = products
      .map(
        (p) => `
        <div class="col-md-4 mb-4">
          <div class="card p-3 text-center">
            <img src="${p.image}" class="card-img-top mb-2" alt="${p.name}">
            <h5>${p.name}</h5>
            <p>₺${p.price}</p>
            <button class="btn btn-primary" onclick="addToCart(${p.id})">Sepete Ekle</button>
          </div>
        </div>
      `
      )
      .join("");

    function addToCart(id) {
      const product = products.find((p) => p.id === id);
      let cart = JSON.parse(localStorage.getItem("cart")) || [];

      const existing = cart.find((item) => item.id === id);
      if (existing) {
        existing.quantity++;
      } else {
        cart.push({
          ...product,
          quantity: 1
        });
      }

      localStorage.setItem("cart", JSON.stringify(cart));
      alert(`${product.name} sepete eklendi.`);
    }
  </script>
</body>

</html>