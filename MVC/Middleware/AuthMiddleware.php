<?php
class AuthMiddleware {
    public static function checkAuth() {
        session_start();
        
        // Check if user is not logged in
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            // Store the requested URL in session (for redirect after login)
            $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
            
            header("Location: ../Views/login.php");
            exit();
        }
        
        return true;
    }

    public static function checkRole($allowedRoles) {
        if (!isset($_SESSION['roles'])) {
            header("Location: ../Views/login.php");
            exit();
        }

        $userRoles = $_SESSION['roles'];
        $hasPermission = false;

        foreach ($allowedRoles as $role) {
            if (in_array($role, $userRoles)) {
                $hasPermission = true;
                break;
            }
        }

        if (!$hasPermission) {
            header("Location: ../Views/unauthorized.php");
            exit();
        }

        return true;
    }


    // for auto log out

    public function __construct() {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function checkSession() {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }

        // Check for session timeout (3 minutes = 180 seconds)
        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 180)) {
            $this->logout();
        }

        // Update last activity time
        $_SESSION['last_activity'] = time();
    }

    public function logout() {
        // Destroy all session data
        session_unset();
        session_destroy();
        
        // Redirect to login page
        header('Location: /login');
        exit();
    }
    
}