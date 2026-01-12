<?php
class AdminController {
    public function dashboard(): void {
        require_once 'views/layout/header.php';
        echo "<div class='container py-5'><h2>Panel Admin</h2><p>(Pendiente: CRUD productos)</p></div>";
        require_once 'views/layout/footer.php';
    }
}
