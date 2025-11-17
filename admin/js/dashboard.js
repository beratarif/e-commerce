// Token kontrolü (mock)
let token = localStorage.getItem("adminToken");
if (!token) {
  // Test için sahte token ekleyelim
  token = "mockToken123";
  localStorage.setItem("adminToken", token);
}

// Çıkış butonu
document.getElementById("logoutBtn").addEventListener("click", () => {
  localStorage.removeItem("adminToken");
  window.location.href = "index.html";
});

// Mock veri ile istatistik gösterimi
const statsRow = document.getElementById("statsRow");
const mockData = {
  totalOrders: 125,
  totalRevenue: 48250,
  totalProducts: 58,
};
const cards = [
  { title: "Toplam Sipariş", value: mockData.totalOrders },
  { title: "Toplam Gelir", value: mockData.totalRevenue + " ₺" },
  { title: "Toplam Ürün", value: mockData.totalProducts },
];

cards.forEach((card) => {
  const col = document.createElement("div");
  col.className = "col-md-4 mb-3";
  col.innerHTML = `
        <div class="card text-center shadow">
            <div class="card-body">
                <h5 class="card-title">${card.title}</h5>
                <p class="card-text fs-4">${card.value}</p>
            </div>
        </div>
    `;
  statsRow.appendChild(col);
});


// TOKEN OLDUGU ZAMAN BURASI KULLANILACAK

// Token kontrolü
// const token = localStorage.getItem('adminToken');
// if(!token){
//     window.location.href = 'index.html';
// }

// document.getElementById('logoutBtn').addEventListener('click', () => {
//     localStorage.removeItem('adminToken');
//     window.location.href = 'index.html';
// });

// // İstatistikleri API'den çek
// fetch('http://localhost/api/admin/stats.php', {
//     headers: { 'Authorization': `Bearer ${token}` }
// })
// .then(res => res.json())
// .then(data => {
//     const statsRow = document.getElementById('statsRow');
//     const cards = [
//         { title: 'Toplam Sipariş', value: data.totalOrders },
//         { title: 'Toplam Gelir', value: data.totalRevenue + ' ₺' },
//         { title: 'Toplam Ürün', value: data.totalProducts }
//     ];
    
//     cards.forEach(card => {
//         const col = document.createElement('div');
//         col.className = 'col-md-4 mb-3';
//         col.innerHTML = `
//             <div class="card text-center shadow">
//                 <div class="card-body">
//                     <h5 class="card-title">${card.title}</h5>
//                     <p class="card-text fs-4">${card.value}</p>
//                 </div>
//             </div>
//         `;
//         statsRow.appendChild(col);
//     });
// })
// .catch(err => {
//     console.error(err);
//     alert('İstatistikler yüklenemedi.');
// });
