<?php
require_once '../backend/admin_page.php';

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
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet" />
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
          <button
            class="btn btn-outline-light btn-sm dropdown-toggle fw-semibold"
            type="button"
            id="userDropdown"
            data-bs-toggle="dropdown"
            aria-expanded="false">
            <?php echo htmlspecialchars($yetkili['eposta']); ?>
          </button>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <li><a class="dropdown-item text-danger" href="../backend/logout.php?hangi_cikis=yetkili">Çıkış Yap</a></li>
          </ul>
        </div>
      <?php else: ?>
        <button
          onclick="window.location.href='./index.html'"
          class="btn btn-outline-light btn-sm">
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
          <th>İşlemler</th>
        </tr>
      </thead>
      <tbody id="productsTableBody">
        
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
          <input type="text" name="urun_adi" class="form-control mb-2" placeholder="Ürün Adı" required>
          <input type="text" name="kategori" class="form-control mb-2" placeholder="Kategori" required>
          <textarea name="aciklama" class="form-control mb-2" placeholder="Açıklama"></textarea>
          <input type="number" name="fiyat" class="form-control mb-2" placeholder="Fiyat" required>
          <input type="file" name="resim" class="form-control mb-2">
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
</body>

</html>