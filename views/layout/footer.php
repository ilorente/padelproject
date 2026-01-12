</main>

<footer class="bg-light border-top">
  <div class="container py-3 text-center text-muted">
    © <?= date('Y') ?> <?= APP_NAME ?> - Tienda de Pádel
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- BASE_URL para el JS -->
<script>
  window.BASE_URL = "<?= BASE_URL ?>";
</script>

<!-- JS AJAX carrito -->
<script src="<?= ASSETS_URL ?>/js/cart.js"></script>

</body>
</html>
