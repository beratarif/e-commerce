const products = [
  { id: 1, name: "Kulaklık", price: 300, img: "img/headphone.jpeg" },
  { id: 2, name: "T-Shirt", price: 400, img: "img/tshirt.jpeg" },
  { id: 3, name: "Güneş Gözlüğü", price:249, img: "img/sunglasses.webp"},
  { id: 4, name: "Akıllı Saat" , price:399, img:"img/watch.jpeg"}
];

const productList = document.getElementById("productList");

products.forEach((p) => {
  const card = `
    <div class="col-md-3 mb-4">
      <div class="card shadow-sm h-100">
        <img src="${p.img}" class="card-img-top" alt="${p.name}">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title">${p.name}</h5>
          <p class="card-text text-muted mb-4">${p.price} ₺</p>
          <button class="btn btn-primary mt-auto add-cart" data-id="${p.id}">Sepete Ekle</button>
        </div>
      </div>
    </div>`;
  productList.innerHTML += card;
});

document.addEventListener("click", (e) => {
  if (e.target.classList.cotains("add-cart")) {
    const id = e.target.dataset.id;
    let cart = JSON.parse(localStorage.getItem("cart") || "[]");
    const found = cart.find((i) => i.id == id);
    if (found) found.qty++;
    else cart.push({ id, qty: 1 });
    localStorage.setItem("cart", JSON.stringify(cart));
  }
});
