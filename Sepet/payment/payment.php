<?php require_once '../../backend/kullanici.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../../css/icons.css">
    <link rel="stylesheet" href="style.css">
    <script src="sweatAlert/sweatAlert.js"></script>
    <style>
        .payment-card {
            padding: 25px;
            border: 2px solid #ddd;
            border-radius: 14px;
            cursor: pointer;
            text-align: center;
            transition: 0.25s;
            background: #fff;
        }

        .payment-card:hover {
            border-color: #0d6efd;
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        }

        .payment-card.active {
            border-color: #0d6efd;
            background-color: #eef4ff;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-light border-bottom">
        <div class="container">
            <a class="navbar-brand fw-bold" href="../../index.php">Mağazamız</a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="../../index.php">Anasayfa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../Product/product.php?sayfa=1&kategori=yok">Ürünler</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../basket.php">Sepet</a>
                    </li>

                    <?php if ($giris_yapildi): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-uppercase fw-semibold" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo htmlspecialchars($kullanici['ad_soyad']); ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item text-primary" href="../../Profile/index.php">Profil</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item text-danger"
                                        href="../../backend/logout.php?hangi_cikis=normal">Çıkış
                                        Yap</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a href="../LoginRegister/index.php" class="nav-link">Giriş</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
    <h3 class="mb-4 fw-bold">Ödeme Yöntemleri</h3>
    <div class="payment-method row g-3">

        <div class="col-md-4">
            <div class="payment-card" data-method="Kredi Kartı" data-type="cc">
                <i class="fas fa-credit-card fa-2x mb-2"></i>
                <h5>Kredi Kartı</h5>
                <p class="text-muted small">Visa, Mastercard desteklenir.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="payment-card" data-method="Kapıda Ödeme" data-type="cash">
                <i class="fas fa-truck fa-2x mb-2"></i>
                <h5>Kapıda Ödeme</h5>
                <p class="text-muted small">Teslimatta nakit ödeme.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="payment-card" data-method="Havale / EFT" data-type="transfer">
                <i class="fas fa-university fa-2x mb-2"></i>
                <h5>Havale / EFT</h5>
                <p class="text-muted small">Bankalar arası transfer.</p>
            </div>
        </div>

    </div>

    <!-- Dinamik Form Alanı -->
    <div id="paymentFormArea" class="mt-4"></div>

    <button id="confirmOrder" class="btn btn-success mt-4 w-100 fw-bold">✔ Siparişi Onayla</button>
</div>

    <script>
        const paymentCard = document.querySelectorAll(".payment-card");
        let selectedMethod = null;

        async function sepetBosalt() {
            await fetch('../../backend/sepet.php?islem=sepet_bosalt');
        }

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

            sepetBosalt();

            Swal.fire({
                icon: "success",
                title: "Sipariş Onaylandı!",
                html: `<b>${selectedMethod}</b> yöntemi ile siparişinizi aldık!`,
                confirmButtonText: "Harika!",
                background: "#f0fff4",
                color: "#1e4620",
            });
        });

        /*
        const cards = document.querySelectorAll(".payment-card");
    const formArea = document.getElementById("paymentFormArea");

    cards.forEach(card => {
        card.addEventListener("click", () => {

            cards.forEach(c => c.classList.remove("active"));
            card.classList.add("active");

            const type = card.getAttribute("data-type");

            // Formu değiştir
            if (type === "cc") {
                formArea.innerHTML = `
                    <div class="card p-3 shadow-sm">
                        <h5 class="fw-bold mb-3">Kredi Kartı Bilgileri</h5>

                        <label>Kart Numarası</label>
                        <input type="text" class="form-control mb-2" placeholder="#### #### #### ####">

                        <div class="row">
                            <div class="col-md-6">
                                <label>Son Kullanma Tarihi</label>
                                <input type="text" class="form-control mb-2" placeholder="AA/YY">
                            </div>
                            <div class="col-md-6">
                                <label>CVC</label>
                                <input type="text" class="form-control mb-2" placeholder="123">
                            </div>
                        </div>
                    </div>
                `;
            }

            else if (type === "cash") {
                formArea.innerHTML = `
                    <div class="card p-3 shadow-sm">
                        <h5 class="fw-bold mb-2">Kapıda Ödeme</h5>
                        <p class="text-muted">Teslimatta nakit veya pos cihazı ile ödeme yapabilirsiniz.</p>
                    </div>
                `;
            }

            else if (type === "transfer") {
                formArea.innerHTML = `
                    <div class="card p-3 shadow-sm">
                        <h5 class="fw-bold mb-2">Havale / EFT Bilgileri</h5>
                        <p class="text-muted small">Aşağıdaki IBAN'a ödeme yapabilirsiniz:</p>
                        <div class="alert alert-secondary">
                            <strong>TR 12 3456 7890 1234 5678 9000 01</strong><br>
                            Alıcı: Örnek Şirket A.Ş.
                        </div>
                    </div>
                `;
            }

        });
    });

    // Sipariş Onay Bildirimi
    document.getElementById("confirmOrder").addEventListener("click", () => {
        alert("🎉 Sipariş başarıyla onaylandı!");
    });*/
    </script>

    
</body>

</html>