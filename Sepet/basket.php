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

    .sepet {
      cursor: pointer;
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
      <div class="col-lg-8" id="basket-holder">





      </div>

      <div class="col-lg-4">
        <div class="card shadow-sm">


          <div class="card-body toplam_tutar">
            <h5 class="card-title">Sipariş Özeti</h5>
            <p class="card-text d-flex justify-content-between ara_toplam">
              <span>Ara Toplam:</span> <span id="subtotal">₺0</span>
            </p>
            <p class="card-text d-flex justify-content-between kargo_ucreti">
              <span>Kargo:</span> <span id="shipping">₺0</span>
            </p>
            <hr />
            <p class="card-text d-flex justify-content-between fw-bold">
              <span>Toplam:</span> <span id="total">₺0</span>
            </p>
            <button onclick="window.location.href='Payment/index.php';" class="btn btn-success w-100 mt-3 siparis-onayla">Siparişi Onayla</button>
          </div>
        </div>
      </div>

    </div>
  </div>
  <footer>
    <p>© 2025 Mağazam. Tüm hakları saklıdır.</p>
  </footer>

  <script>
    async function sepetGetir() {
      const basket_holder = document.getElementById('basket-holder');

      try {
        const sonuc = await fetch(`../backend/sepet.php?islem=getir`);

        let ara_toplam = 0;
        const kargo_ucreti = 50;

        for (const s of await sonuc.json()) {
          basket_holder.innerHTML +=
            `
          <div class="card mb-3 sepet" data-id="${s.urun.id}">
            <div class="row g-0 align-items-center">
              <div class="col-md-3">
                <img
                  src="../${s.urun.gorsel}"
                  class="img-fluid rounded-start" alt="Ürün 2" />
              </div>
              <div class="col-md-6">
                <div class="card-body">
                  <h5 class="card-title mb-1">${s.urun.ad}</h5>
                  <p class="text-muted small mb-2">
                    ${s.urun.aciklama}
                  </p>
                  <div class="d-flex align-items-center">
                    <button class="btn btn-outline-secondary btn-sm sepet_cikar">-</button>
                    <span class="mx-2">${s.adet}</span>
                    <button class="btn btn-outline-secondary btn-sm sepete_ekle">+</button>
                  </div>
                </div>
              </div>
              <div class="col-md-3 text-center">
                <p class="fw-semibold mb-1">₺${s.urun.fiyat}</p>
                <button class="btn btn-outline-danger btn-sm sepet_tum_urunler_cikar">Kaldır</button>
              </div>
            </div>
          </div>
        </div>
            `;

          ara_toplam += s.urun.fiyat * s.adet;
        }

        document.getElementById("subtotal").innerHTML = `₺${ara_toplam.toFixed(2)}`;

        if (ara_toplam > 0) {
          document.getElementById("shipping").innerHTML = `₺${kargo_ucreti.toFixed(2)}`;
          document.getElementById("total").innerHTML = `₺${(ara_toplam + kargo_ucreti).toFixed(2)}`;
        }
        else {
          document.getElementById("shipping").innerHTML = `₺${ara_toplam.toFixed(2)}`;
          document.getElementById("total").innerHTML = `₺${ara_toplam.toFixed(2)}`;
        }
        

        document.querySelectorAll(".sepet").forEach(card => {
          card.addEventListener("click", function(e) {
            if (e.target.tagName === "BUTTON")return;
            window.location.href = "../ProductDetail/index.php?id=" + this.dataset.id;
          });
        });

        for (const sepet of document.querySelectorAll(".sepet")) {
          sepet.querySelector(".sepete_ekle").onclick = () => {
            sepeteEkle(sepet.dataset.id);
          };
          sepet.querySelector(".sepet_cikar").onclick = () => {
            sepetCikar(sepet.dataset.id, false);
          };
          sepet.querySelector(".sepet_tum_urunler_cikar").onclick = () => {
            sepetCikar(sepet.dataset.id, true);
          };
        }
      }
      catch (err) {
        console.error(err);
      }
    }

    function sepeteEkle(id) {
      if (<?php echo $giris_yapildi ? 'true' : 'false' ?>) {
        window.location.href = `../backend/sepet.php?islem=ekle&id=${id}`;
      }
      else {
        window.location.href = `../LoginRegister/index.php`;
      }
    }

    function sepetCikar(id, tumUrunler) {
      if (<?php echo $giris_yapildi ? 'true' : 'false' ?>) {
        window.location.href = `../backend/sepet.php?islem=cikar&id=${id}&tum_urunler=${tumUrunler}`;
      }
      else {
        window.location.href = `../LoginRegister/index.php`;
      }
    }

    document.addEventListener("DOMContentLoaded", async () => {
      await sepetGetir();
    });
  </script>
</body>

</html>