async function sepetGetir() {
    const basket_holder = document.getElementById('basket-holder');

    try {
        const sonuc = await fetch(`../backend/sepet.php?islem=getir`);
        const sonucJson = await sonuc.text();

        alert(sonucJson);
    }
    catch (err) {
        console.error(err);
    }
}

document.addEventListener("DOMContentLoaded", async () => {
  await sepetGetir();
});