<?php
require_once '../backend/db.php';
require_once '../backend/admin_page.php';


$stmt = $pdo->query("SELECT * FROM urunler");
$urunler = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$giris_yapildi) {
  header("location: index.html");
}
?>

<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Panel - Ürünler</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css" />
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
    <a class="navbar-brand" href="dashboard.html">Admin Panel</a>

    <div class="ms-auto d-flex align-items-center gap-2">
      <button onclick="window.location.href='dashboard.php'" class="btn btn-outline-light btn-sm">
        Dashboard
      </button>
      <button onclick="window.location.href='products.php'" class="btn btn-outline-light btn-sm">
        Ürünler
      </button>
      <button onclick="window.location.href='orders.php'" class="btn btn-outline-light btn-sm">
        Sipariş Durumu
      </button>
      <?php if ($giris_yapildi): ?>
        <div class="dropdown">
          <button class="btn btn-outline-light btn-sm dropdown-toggle fw-semibold" type="button" id="userDropdown"
            data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo htmlspecialchars($yetkili['eposta']); ?>
          </button>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <li><a class="dropdown-item text-danger" href="../backend/logout.php?hangi_cikis=yetkili">Çıkış Yap</a></li>
          </ul>
        </div>
      <?php else: ?>
        <button onclick="window.location.href='./index.html'" class="btn btn-outline-light btn-sm">
          Giriş Yap
        </button>
      <?php endif; ?>
    </div>
  </nav>

  <div class="container mt-4">
    <h3>Ürünler</h3>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
      Ürün Ekle
    </button>


    <table class="table table-bordered">
      <thead class="table-dark">
        <tr>
          <th>İsim</th>
          <th>Fiyat</th>
          <th>Kategori</th>
          <th>Stok</th>
          <th>Görsel</th>
          <th>İşlemler</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($urunler)): ?>
          <?php foreach ($urunler as $urun): ?>
            <tr>
              <td><?= htmlspecialchars($urun['ad']) ?></td>
              <td><?= htmlspecialchars($urun['fiyat']) ?> ₺</td>
              <td><?= htmlspecialchars($urun['kategori']) ?></td>
              <td><?= htmlspecialchars($urun['stock']) ?></td>
              <td>
                <img src="../img/<?= htmlspecialchars($urun['gorsel']) ?>" alt="" width="60">
              </td>
              <td>
                <button class="btn btn-sm btn-warning">Düzenle</button>
                <button class="btn btn-sm btn-danger">Sil</button>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="5" class="text-center text-muted">Hiç ürün bulunamadı.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST" action="add_product.php" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title" id="addProductModalLabel">Yeni Ürün Ekle</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <input type="text" name="productName" class="form-control mb-2" placeholder="Ürün Adı" required>
            <input type="text" name="productCategory" class="form-control mb-2" placeholder="Kategori" required>
            <input type="number" name="productPrice" class="form-control mb-2" placeholder="Fiyat" required>
            <input type="number" class="form-control mb-2" name="productStock" id="productStock" placeholder="Stok"
              required>
            <input type="text" name="productDesc" class="form-control mb-2" id="productDesc" placeholder="Açıklama"
              required>
            <input type="file" name="productImage" id="productImage" class="form-control mb-2" placeholder="Görsel"
              required>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Kaydet</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script src="js/products.js"></script>
  <script>
    async function fetchProducts() {
      const res = await fetch('get_product.php');
      const products = await res.json();

      const list = document.getElementById('product-list');
      list.innerHTML = '';

      products.forEach(product => {
        const div = document.createElement('div');
        div.innerHTML = `
            <h3>${product.name}</h3>
            <button onclick="deleteProduct(${product.id})">Sil</button>
        `;
        list.appendChild(div);
      });
    }

    async function deleteProduct(id) {
      if (!confirm("Silmek istediğine emin misin?")) return;

      const res = await fetch(`delete_product.php?id=${id}`);
      const result = await res.json();

      if (result.success) {
        alert("Ürün silindi");
        fetchProducts(); // listeyi tekrar çek
      } else {
        alert("Hata: " + result.message);
      }
    }

    // Sayfa açıldığında ürünleri listele
    fetchProducts();
  </script>
</body>

</html>