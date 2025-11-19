const paymentCard = document.querySelectorAll(".payment-card");
let selectedMethod = null;

paymentCard.forEach((card) => {
  card.addEventListener("click", () => {
    paymentCard.forEach((c) => c.classList.remove("active-card"));
    card.classList.add("active-card");

    selectedMethod = card.getAttribute("data-method");

    document.getElementById("selectedMethodBox").style.display = "block";
    document.getElementById("selectedMethodText").innerText = selectedMethod;
  });
});

document.getElementById("confirmOrder").addEventListener("click", () => {
  if (!selectedMethod) {
    Swal.fire({
      icon: "warning",
      title: "Ödeme yöntemi seçilmedi!",
      text: "Devam etmek için önce bir ödeme türü seçmelisin.",
      confirmButtonText: "Tamam",
    });
    return;
  }
  Swal.fire({
    icon: "success",
    title: "Sipariş Onaylandı!",
    html: `<b>${selectedMethod}</b> yöntemi ile siparişinizi aldık!`,
    confirmButtonText: "Harika!",
    background: "#f0fff4",
    color: "#1e4620",
  });
});
