function UrunGetir(urunSayisi) {
      const product_holder = document.getElementById('product-holder');

      fetch(`./backend/urun.php?islem=anasayfa`)
        .then(response => response.json())
        .then(r => {
          let preparedProductsHTML = '';

          r.forEach(u => {
            preparedProductsHTML +=
              `
          <div class="col-md-4 col-sm-6">
            <div class="card h-100 shadow-sm">
              <img src="${u.gorsel}" class="card-img-top" alt="Ürün Görseli">
              <div class="card-body">
                <h5 class="card-title">${u.ad}</h5>
                <p class="card-text text-muted">${u.aciklama}</p>
                <p class="fw-bold fs-5 mb-3">₺${u.fiyat}</p>
                <a href="#" class="btn btn-primary w-100">Sepete Ekle</a>
              </div>
            </div>
          </div>
          `;
          });

          product_holder.innerHTML = preparedProductsHTML;
        })
        .catch(err => {
          console.error(`hata: ${err}`);
        });
    }

    document.addEventListener("DOMContentLoaded", () => {
      UrunGetir(3);
    });