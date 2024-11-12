<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../models/UserModel.php';

class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // Handle registration
    public function register()
    {
        session_start();
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        // Check if the user already exists
        if (!$this->userModel->registerUser($name, $email, $password, $role)) {
            header('Location: ../Views/registration.php?error=User already exists or registration failed.');
            exit();
        }

        header('Location: ../Views/login.php?success=Registration successful! Please sign in.');
        exit();
    }

    // Handle login
    public function login()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $this->userModel->loginUser($email, $password);

        if ($user) {
            echo "Login successful!";
        } else {
            echo "Invalid email or password.";
        }
    }
}

// Handle actions
$action = $_GET['action'] ?? null;
$controller = new UserController();

if ($action === 'register') {
    $controller->register();
} elseif ($action === 'login') {
    $controller->login();
}
