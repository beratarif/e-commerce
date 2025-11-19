// Mock siparişler (gerçek backend gelene kadar)
let orders = [
  { id: 1, customer: "Ahmet Yılmaz", amount: 250, status: "Bekliyor" },
  { id: 2, customer: "Ayşe Demir", amount: 120, status: "Kargolandı" },
  { id: 3, customer: "Mehmet Kaya", amount: 400, status: "Tamamlandı" },
];

const tbody = document.getElementById("ordersTableBody");

function renderOrders() {
  tbody.innerHTML = "";

  orders.forEach((o, i) => {
    tbody.innerHTML += `
      <tr>
        <td>${o.id}</td>
        <td>${o.customer}</td>
        <td>${o.amount} ₺</td>
        
        <td>
          <span class="badge ${
            o.status === "Bekliyor"
              ? "bg-warning text-dark"
              : o.status === "Kargolandı"
              ? "bg-info text-dark"
              : "bg-success"
          }">
            ${o.status}
          </span>
        </td>

        <td>
          <select class="form-select form-select-sm" onchange="updateStatus(${i}, this.value)">
            <option value="Bekliyor"   ${
              o.status === "Bekliyor" ? "selected" : ""
            }>Bekliyor</option>
            <option value="Kargolandı" ${
              o.status === "Kargolandı" ? "selected" : ""
            }>Kargolandı</option>
            <option value="Tamamlandı" ${
              o.status === "Tamamlandı" ? "selected" : ""
            }>Tamamlandı</option>
          </select>
        </td>
      </tr>
    `;
  });
}

function updateStatus(index, newStatus) {
  orders[index].status = newStatus;
  renderOrders();
}

renderOrders();
