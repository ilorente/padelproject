<?php require_once 'views/layout/header.php'; ?>
<h2 class="mb-4">Catálogo Completo</h2>
<div class="row row-cols-1 row-cols-md-3 g-4">
    <?php foreach($products as $p): ?>
    <div class="col">
        <div class="card h-100 shadow-sm border-0 product-card">
            <a href="<?= BASE_URL ?>/product/<?= $p['id'] ?>">
                <img src="<?= $p['image'] ?>" class="card-img-top p-3" alt="Producto">
            </a>
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($p['name']) ?></h5>
                <p class="text-danger fw-bold h5"><?= $p['price'] ?>€</p>
                <form action="<?= BASE_URL ?>/cart/add" method="POST">
                    <input type="hidden" name="id" value="<?= $p['id'] ?>">
                    <button class="btn btn-warning w-100"><i class="fas fa-cart-plus"></i> Añadir</button>
                </form>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php require_once 'views/layout/footer.php'; ?>