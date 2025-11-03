// let cart = JSON.parse(localStorage.getItem("cart")) || [];

// // her işlem sonrası localStorage'ı güncel tut
// function renderCart() {
//   const container = document.getElementById("cart-items");
//   container.innerHTML = "";

//   if (cart.length === 0) {
//     container.innerHTML = `<p class="text-muted">Sepetiniz boş.</p>`;
//     updateSummary();
//     return;
//   }

//   cart.forEach((item) => {
//     const div = document.createElement("div");
//     div.className =
//       "list-group-item d-flex justify-content-between align-items-center";
//     div.innerHTML = `
//       <div class="d-flex align-items-center">
//         <img src="${item.image}" class="rounded me-3" width="60" />
//         <div>
//           <h6>${item.name}</h6>
//           <p class="text-muted mb-1">₺${item.price}</p>
//           <div class="btn-group btn-group-sm">
//             <button class="btn btn-outline-secondary" onclick="changeQuantity(${item.id}, -1)">-</button>
//             <button class="btn btn-outline-secondary disabled">${item.quantity}</button>
//             <button class="btn btn-outline-secondary" onclick="changeQuantity(${item.id}, 1)">+</button>
//           </div>
//         </div>
//       </div>
//       <button class="btn btn-sm btn-outline-danger" onclick="removeFromCart(${item.id})">Sil</button>
//     `;
//     container.appendChild(div);
//   });

//   updateSummary();
//   localStorage.setItem("cart", JSON.stringify(cart)); // ✅ burası eklendi
// }
