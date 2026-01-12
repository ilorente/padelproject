<?php require_once 'views/layout/header.php'; ?>

<h2 class="mb-3">Registro</h2>

<?php if (!empty($error)): ?>
  <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="POST" action="<?= BASE_URL ?>/register" class="card p-4 shadow-sm" style="max-width:520px;">
  <div class="mb-3">
    <label class="form-label">Nombre</label>
    <input class="form-control" type="text" name="name" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Email</label>
    <input class="form-control" type="email" name="email" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Contraseña</label>
    <input class="form-control" type="password" name="password" required>
    <small class="text-muted">Mínimo 4 caracteres.</small>
  </div>

  <button class="btn btn-success w-100">Crear cuenta</button>

  <div class="text-center mt-3">
    ¿Ya tienes cuenta?
    <a href="<?= BASE_URL ?>/login">Login</a>
  </div>
</form>

<?php require_once 'views/layout/footer.php'; ?>
