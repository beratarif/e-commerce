async function urunGetir() {
  const product_holder = document.getElementById("product-holder");

  try {
    const response = await fetch(`../backend/urun.php?islem=anasayfa`);
    const r = await response.json();

    for (const u of r) {
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

async function urunDetayGetir() {
  const urun_detay = document.getElementById("urun-detay");

  const urun_gorsel = urun_detay.querySelector(".product-img-big");
  const urun_baslik = urun_detay.querySelector(".product-title");
  const urun_aciklama = urun_detay.querySelector(".product-description");
  const urun_fiyat = urun_detay.querySelector(".product-price");

  const urun_id = urun_detay.dataset.id;

  try {
    const sonuc = await fetch(`../backend/urun.php?islem=urun_detay&id=${urun_id}`);
    const sonucJson = await sonuc.json();

    urun_gorsel.src = `../${sonucJson.gorsel}`;
    urun_baslik.innerHTML = sonucJson.ad;
    urun_aciklama.innerHTML = sonucJson.aciklama;
    urun_fiyat.innerHTML = `${sonucJson.fiyat}₺`;
  }
  catch (err) {
    console.error(`hata: ${err}`);
  }
}

document.addEventListener("DOMContentLoaded", async () => {
  await urunDetayGetir();
  await urunGetir();
});

document.getElementById("product-holder").addEventListener("click", (e) => {
  if (e.target.closest(".btn")) return;
  const card = e.target.closest(".product-card");

  if (card) {
    window.location.href = `index.php?id=${card.dataset.id}`;
  }
});
