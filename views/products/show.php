<?php require_once 'views/layout/header.php'; ?>
<div class="row">
    <div class="col-md-6 text-center"><img src="<?= $product->image ?>" class="img-fluid rounded shadow-sm"></div>
    <div class="col-md-6">
        <h1><?= htmlspecialchars($product->name) ?></h1>
        <h2 class="text-danger my-3"><?= $product->price ?>€</h2>
        <p><?= htmlspecialchars($product->description) ?></p>
        <form action="<?= BASE_URL ?>/cart/add" method="POST">
            <input type="hidden" name="id" value="<?= $product->id ?>">
            <button class="btn btn-warning btn-lg w-100"><i class="fas fa-cart-plus"></i> Añadir al carrito</button>
        </form>
    </div>
</div>
<?php require_once 'views/layout/footer.php'; ?>