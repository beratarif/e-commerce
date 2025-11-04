// Token kontrolü
if (!localStorage.getItem("adminToken")) {
  localStorage.setItem("adminToken", "mockToken123"); // Mock token
}

// Çıkış
document.getElementById("logoutBtn").addEventListener("click", () => {
  localStorage.removeItem("adminToken");
  window.location.href = "index.html";
});

// Mock siparişler
let orders = [
  { id: 1, customer: "Ahmet Yılmaz", amount: 250, status: "Bekliyor" },
  { id: 2, customer: "Ayşe Demir", amount: 120, status: "Kargolandı" },
  { id: 3, customer: "Mehmet Kaya", amount: 400, status: "Tamamlandı" },
];

const ordersTableBody = document.getElementById("ordersTableBody");

// Siparişleri tabloya yaz
function renderOrders() {
  ordersTableBody.innerHTML = "";
  orders.forEach((order, index) => {
    const tr = document.createElement("tr");
    tr.innerHTML = `
      <td>${order.id}</td>
      <td>${order.customer}</td>
      <td>${order.amount} ₺</td>
      <td>
        <span class="badge ${
          order.status === "Bekliyor"
            ? "bg-warning text-dark"
            : order.status === "Kargolandı"
            ? "bg-info text-dark"
            : "bg-success"
        }">${order.status}</span>
      </td>
      <td>
        <select class="form-select form-select-sm" onchange="updateStatus(${index}, this.value)">
          <option value="Bekliyor" ${
            order.status === "Bekliyor" ? "selected" : ""
          }>Bekliyor</option>
          <option value="Kargolandı" ${
            order.status === "Kargolandı" ? "selected" : ""
          }>Kargolandı</option>
          <option value="Tamamlandı" ${
            order.status === "Tamamlandı" ? "selected" : ""
          }>Tamamlandı</option>
        </select>
      </td>
    `;
    ordersTableBody.appendChild(tr);
  });
}

// Durum güncelle
function updateStatus(index, newStatus) {
  orders[index].status = newStatus;
  renderOrders();
}

// İlk render
renderOrders();
