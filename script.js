async function urunGetir() {
  const product_holder = document.getElementById("product-holder");

  try {
    const response = await fetch(`./backend/urun.php?islem=anasayfa`);
    const r = await response.json();

    for (const u of r) {
      product_holder.innerHTML += `
        <div class="col-md-4 col-sm-6">
          <div class="card h-100 shadow-sm product-card" data-id="${u.id}" style="cursor:pointer;">
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
    }
  } catch (err) {
    console.error(`hata: ${err}`);
  }
}

// Event delegation
document.getElementById("product-holder").addEventListener("click", (e) => {
  // Eğer kartın içindeysek
  const card = e.target.closest(".product-card");
  if (card) {
    window.location.href = `ProductDetail/index.php`;
  }
});

document.addEventListener("DOMContentLoaded", () => {
  urunGetir();
});
