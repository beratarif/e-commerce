document.addEventListener("DOMContentLoaded", () => {
  const productModal = new bootstrap.Modal(document.getElementById("productModal"));
  const productForm = document.getElementById("productForm");

  document.getElementById("addProductBtn").addEventListener("click", () => {
    document.getElementById("modalTitle").textContent = "Ürün Ekle";
    productForm.reset();
    document.getElementById("productIndex").value = "";
    productModal.show();
  });
});
