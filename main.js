const products = [
  {
    id: 1,
    name: "Kablosuz Kulaklık",
    price: 399,
    img: "img/headphone.jpeg",
    category: "Elektronik",
  },
  {
    id: 2,
    name: "Akıllı Saat",
    price: 899,
    img: "img/watch.jpeg",
    category: "Elektronik",
  },
  {
    id: 3,
    name: "T-shirt",
    price: 149,
    img: "img/tshirt.jpeg",
    category: "Giyim",
  },
  {
    id: 4,
    name: "Güneş Gözlüğü",
    price: 249,
    img: "img/sunglasses.webp",
    category: "Aksesuar",
  },
  {
    id: 5,
    name: "Kupa Bardak",
    price: 79,
    img: "img/mug.jpeg",
    category: "Ev & Yaşam",
  },
  {
    id: 6,
    name: "Yastık",
    price: 199,
    img: "img/pillow.jpeg",
    category: "Ev & Yaşam",
  },
];

const productList = document.getElementById("productList");
const categoryButtons = document.querySelectorAll(".category-btn");

function renderProducts(filterCategory = null) {
  productList.innerHTML = "";

  const filtered = filterCategory
    ? products.filter((p) => p.category === filterCategory)
    : products;

  if (filtered.length === 0) {
    productList.innerHTML = `<p class="text-center text-muted py-5">Bu kategoride ürün bulunamadı.</p>`;
    return;
  }

  filtered.forEach((p) => {
    const card = `
      <div class="col-md-3 mb-4">
        <div class="card shadow-sm h-100">
          <img href="ProductDetail/index.html" src="${p.img}" class="card-img-top" alt="${p.name}">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">${p.name}</h5>
            <p class="card-text text-muted mb-4">${p.price} ₺</p>
            <button class="btn btn-primary mt-auto add-cart" data-id="${p.id}">Sepete Ekle</button>
          </div>
        </div>
      </div>`;
    productList.innerHTML += card;
  });
}

renderProducts(); // Başta tüm ürünler gözüksün

// Kategori tıklama
categoryButtons.forEach((btn) => {
  btn.addEventListener("click", () => {
    const selected = btn.textContent.trim();
    document
      .querySelectorAll(".category-btn")
      .forEach((b) => b.classList.remove("active"));
    btn.classList.add("active");
    renderProducts(selected);
  });
});

// Sepete ekleme
document.addEventListener("click", (e) => {
  if (e.target.classList.contains("add-cart")) {
    const id = e.target.dataset.id;
    let cart = JSON.parse(localStorage.getItem("cart") || "[]");
    const found = cart.find((i) => i.id == id);
    if (found) found.qty++;
    else cart.push({ id, qty: 1 });
    localStorage.setItem("cart", JSON.stringify(cart));
  }
});
