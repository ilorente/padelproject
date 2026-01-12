<?php
class AuthController {

    private function redirect(string $path): void {
        header("Location: " . BASE_URL . $path);
        exit;
    }

    public function login(): void {
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($email === '' || $password === '') {
                $error = "Rellena email y contraseña.";
            } else {
                $userModel = new User();
                $user = $userModel->verifyLogin($email, $password);

                if (!$user) {
                    $error = "Credenciales incorrectas.";
                } else {
                    $_SESSION['user'] = [
                        'id' => (int)$user['id'],
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'role' => $user['role']
                    ];
                    $this->redirect('/home');
                }
            }
        }

        require 'views/auth/login.php';
    }

    public function register(): void {
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($name === '' || $email === '' || $password === '') {
                $error = "Rellena todos los campos.";
            } elseif (strlen($password) < 4) {
                $error = "La contraseña debe tener al menos 4 caracteres.";
            } else {
                $userModel = new User();
                if ($userModel->findByEmail($email)) {
                    $error = "Ese email ya está registrado.";
                } else {
                    $userModel->create($name, $email, $password);
                    $this->redirect('/login');
                }
            }
        }

        require 'views/auth/register.php';
    }

    public function logout(): void {
        unset($_SESSION['user']);
        $this->redirect('/home');
    }
}
