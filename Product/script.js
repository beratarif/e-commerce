function bekle(ms) {
  return new Promise((resolve) => setTimeout(resolve, ms));
}

async function urunGetir(sayfa, kategori) {
  const product_holder = document.getElementById("product-holder");

  try {
    const response = await fetch(
      `../backend/urun.php?islem=urunler&sayfa=${sayfa}&kategori=${kategori}`
    );
    const r = await response.json();

    for (const u of r) {
      // await bekle(125);

      product_holder.innerHTML += `
        <div class="col-md-4 col-sm-6">
          <div class="card h-100 shadow-sm product-card" data-id="${u.urun_id}" style="cursor:pointer;">
            <img src="../${u.gorsel}" class="card-img-top" alt="Ürün Görseli"> 
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
document.getElementById("product-holder").addEventListener("click", (e) => {
  if (e.target.closest(".btn")) return;
  const card = e.target.closest(".product-card");

  if (card) {
    window.location.href = `../ProductDetail/index.php?id=${card.dataset.id}`;
  }
});
