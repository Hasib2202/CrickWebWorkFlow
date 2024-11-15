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
            $error = "User already exists or registration failed.";
            header("Location: ../Views/registration.php?error=" . urlencode($error));
            exit();
        }

        header('Location: ../Views/login.php?success=Registration successful! Please sign in.');
        exit();
    }


    // Handle login

    private function validateLogin($email, $password)
    {
        $errors = [];

        // Validate email
        if (empty($email)) {
            $errors[] = 'Email is required';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Invalid email format';
        }

        // Validate password
        if (empty($password)) {
            $errors[] = 'Password is required';
        } elseif (strlen($password) < 6) {
            $errors[] = 'Password must be at least 6 characters';
        }

        return $errors;
    }

    public function login()
    {
        session_start();

        // Get and sanitize inputs
        $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'] ?? '';

        // Validate inputs
        $errors = $this->validateLogin($email, $password);

        if (!empty($errors)) {
            $_SESSION['error'] = $errors[0];
            header('Location: ../Views/login.php');
            exit();
        }

        // Attempt login
        $user = $this->userModel->loginUser($email, $password);

        if (!$user) {
            $_SESSION['error'] = 'Invalid email or password';
            header('Location: ../Views/login.php');
            exit();
        }

        // Set session data
        $roles = $this->userModel->getUserRoles($user['id']);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['roles'] = $roles;
        $_SESSION['logged_in'] = true;

        // Redirect based on role
        $roleRedirects = [
            'Admin' => '../Views/admin_dashboard.php',
            'Manager' => '../Views/manager_dashboard.php',
            'Player' => '../Views/player_dashboard.php',
            'Sponsor' => '../Views/sponsor_dashboard.php',
        ];

        foreach ($roles as $role) {
            if (isset($roleRedirects[$role])) {
                header('Location: ' . $roleRedirects[$role]);
                exit();
            }
        }

        header('Location: ../Views/dashboard.php');
        exit();
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();

        // Check if the request is an AJAX request
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
        ) {
            header('Content-Type: application/json');
            echo json_encode(['success' => true]);
            exit;
        }

        // For a regular request, redirect to login page
        header('Location: ../Views/login.php');
        exit();
    }
}

// Handle actions
$action = $_GET['action'] ?? '';
$controller = new UserController();

switch ($action) {
    case 'login':
        $controller->login();
        break;
    case 'register':
        $controller->register();
        break;
    case 'logout':
        $controller->logout();
        break;
    default:
        header('Location: ../Views/login.php');
        exit();
}
