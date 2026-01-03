<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PadelPro V5</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --primary: #ff6600; --dark: #131921; }
        body { font-family: sans-serif; background-color: #f8f9fa; }
        .top-nav { background-color: var(--dark); padding: 10px 0; }
        .logo { color: white; font-weight: bold; font-size: 24px; text-decoration: none; }
        .logo span { color: var(--primary); }
        .nav-link { color: white !important; }
        .product-card img { transition: transform 0.3s; }
        .product-card:hover img { transform: scale(1.05); }
    </style>
</head>
<body>
<header>
    <div class="top-nav">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="<?= BASE_URL ?>/" class="logo">PADEL<span>PRO</span></a>

            <nav>
                <a href="<?= BASE_URL ?>/" class="btn btn-link nav-link">Inicio</a>
                <a href="<?= BASE_URL ?>/products" class="btn btn-link nav-link">Catálogo</a>
                <a href="<?= BASE_URL ?>/cart" class="btn btn-warning text-dark fw-bold rounded-pill px-3">
                    <i class="fas fa-shopping-cart"></i> <span class="cart-count"><?= isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0 ?></span>
                </a>
            </nav>
        </div>
    </div>
</header>
<main class="container py-4">
