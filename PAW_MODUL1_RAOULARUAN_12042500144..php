<?php
// data cia store
$products = [
    [
        "nama" => "Laptop Gaming",
        "kategori" => "Laptop",
        "harga" => 8500000,
        "stok" => 3
    ],
    [
        "nama" => "Monitor 24 Inch",
        "kategori" => "Monitor",
        "harga" => 1800000,
        "stok" => 4
    ],
    [
        "nama" => "Headset Wireless",
        "kategori" => "Audio",
        "harga" => 1200000,
        "stok" => 5
    ],
    [
        "nama" => "Smartwatch Fitness",
        "kategori" => "Wearable",
        "harga" => 950000,
        "stok" => 8
    ],
    [
        "nama" => "Mechanical Keyboard",
        "kategori" => "Aksesoris",
        "harga" => 750000,
        "stok" => 12
    ],
    [
        "nama" => "Wireless Mouse",
        "kategori" => "Aksesoris",
        "harga" => 250000,
        "stok" => 0 // stok habis
    ]
];

//Format Rupiah
function formatRupiah($angka) {
    return "Rp" . number_format($angka, 0, ',', '.');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cia Store - Simple Tech Store</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f8f9fa;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar {
            background-color: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.2rem 5%;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar .brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1a1d20;
        }

        .navbar .nav-links {
            display: flex;
            list-style: none;
            gap: 20px;
        }

        .navbar .nav-links a {
            text-decoration: none;
            color: #555;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .navbar .nav-links a:hover {
            color: #0d6efd;
        }

        .hero-container {
            padding: 2rem 5%;
        }

        .hero {
            background: linear-gradient(135deg, #1e2530, #11161d);
            color: #ffffff;
            border-radius: 16px;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .hero span {
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 0.85rem;
            color: #9ba4b5;
            font-weight: 600;
        }

        .hero h1 {
            font-size: 2.3rem;
            font-weight: 700;
        }

        .hero p {
            color: #adbbd1;
            max-width: 600px;
            font-size: 1rem;
            line-height: 1.5;
        }

        .hero-btn {
            margin-top: 8px;
            padding: 10px 24px;
            background-color: #ffffff;
            color: #1e2530;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.2s ease;
        }

        .hero-btn:hover {
            background-color: #e2e8f0;
        }

        .main-content {
            padding: 1rem 5% 3rem 5%;
            flex: 1;
        }

        .catalog-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 25px;
        }

        .subtitle {
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 1.5px;
            color: #6c757d;
            font-weight: 600;
        }

        .catalog-header h2 {
            font-size: 1.8rem;
            color: #1a1d20;
        }

        .total-badge {
            background-color: #e9ecef;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            color: #495057;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .product-card {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 22px;
            border: 1px solid #e9ecef;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.06);
        }

        .badge-discount {
            position: absolute;
            top: 15px;
            right: 15px;
            background-color: #dc3545;
            color: #ffffff;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 700;
        }

        .product-category {
            font-size: 0.8rem;
            color: #6c757d;
            text-transform: uppercase;
            font-weight: 600;
            display: block;
            margin-bottom: 4px;
        }

        .product-name {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 12px;
            padding-right: 55px;
            color: #212529;
        }

        .price-box {
            margin-bottom: 12px;
        }

        .original-price {
            text-decoration: line-through;
            color: #888;
            font-size: 0.88rem;
            margin-right: 6px;
        }

        .final-price {
            font-size: 1.25rem;
            font-weight: 700;
            color: #0d6efd;
        }

        .stock-info {
            font-size: 0.9rem;
            margin-bottom: 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .status-badge {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-available {
            background-color: #d1e7dd;
            color: #0f5132;
        }

        .status-empty {
            background-color: #f8d7da;
            color: #842029;
        }

        /* style tombol */
        .buy-btn {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 6px;
            background-color: #0d6efd;
            color: #ffffff;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .buy-btn:hover:not(:disabled) {
            background-color: #0b5ed7;
        }

        .buy-btn:disabled {
            background-color: #6c757d;
            cursor: not-allowed;
            opacity: 0.65;
        }

        /* footer */
        footer {
            background-color: #ffffff;
            border-top: 1px solid #e9ecef;
            text-align: center;
            padding: 1.5rem;
            color: #6c757d;
            font-size: 0.9rem;
        }

        @media (max-width: 900px) {
            .product-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .product-grid {
                grid-template-columns: 1fr;
            }
            .hero {
                padding: 2rem 1.5rem;
            }
            .hero h1 {
                font-size: 1.7rem;
            }
            .catalog-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="brand">Cia Store</div>
        <ul class="nav-links">
            <li><a href="#">Home</a></li>
            <li><a href="#katalog">Products</a></li>
            <li><a href="#">About</a></li>
        </ul>
    </nav>

    <div class="hero-container">
        <section class="hero">
            <span>CIA STORE</span>
            <h1>Simple Tech Store.</h1>
            <p>Temukan berbagai perangkat dan aksesoris teknologi untuk kebutuhanmu.</p>
            <a href="#katalog" class="hero-btn">Lihat Produk</a>
        </section>
    </div>

    <main class="main-content" id="katalog">
        <div class="catalog-header">
            <div>
                <div class="subtitle">OUR PRODUCTS</div>
                <h2>Katalog Produk</h2>
            </div>
            <div class="total-badge">
                Total Produk: <?= count($products); ?>
            </div>
        </div>

        <!-- PRODUCT GRID -->
        <div class="product-grid">
            <?php foreach ($products as $item): ?>
                <?php
                // logika diskon 10%
                $hasDiscount = $item['harga'] >= 1000000;
                $discountPercent = 10;
                $finalPrice = $hasDiscount ? $item['harga'] * (1 - $discountPercent / 100) : $item['harga'];
                $isAvailable = $item['stok'] > 0;
                ?>
                <article class="product-card">
                    <?php if ($hasDiscount): ?>
                        <div class="badge-discount">DISKON <?= $discountPercent; ?>%</div>
                    <?php endif; ?>

                    <div>
                        <span class="product-category"><?= htmlspecialchars($item['kategori']); ?></span>
                        <h3 class="product-name"><?= htmlspecialchars($item['nama']); ?></h3>
                        
                        <div class="price-box">
                            <?php if ($hasDiscount): ?>
                                <span class="original-price"><?= formatRupiah($item['harga']); ?></span>
                            <?php endif; ?>
                            <span class="final-price"><?= formatRupiah($finalPrice); ?></span>
                        </div>

                        <div class="stock-info">
                            <span>Stok: <?= $item['stok']; ?></span>
                            <span class="status-badge <?= $isAvailable ? 'status-available' : 'status-empty'; ?>">
                                <?= $isAvailable ? 'Tersedia' : 'Stok Habis'; ?>
                            </span>
                        </div>
                    </div>

                    <button class="buy-btn" <?= !$isAvailable ? 'disabled' : ''; ?>>
                        <?= $isAvailable ? 'Beli Sekarang' : 'Stok Habis'; ?>
                    </button>
                </article>
            <?php endforeach; ?>
        </div>
    </main>

    <footer>
        <p>&copy; <?= date('Y'); ?> Cia Store. All rights reserved.</p>
    </footer>

</body>
</html>