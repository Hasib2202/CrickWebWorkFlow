<?php

require_once 'db.php';

class UserModel
{
    
    public function registerUser($name, $email, $password, $role)
    {
        // Get database connection
        $connection = $this->db;

        // Check if email already exists using prepared statements to avoid SQL injection
        $checkQuery = "SELECT * FROM users WHERE email = ?";
        $stmt = mysqli_prepare($connection, $checkQuery);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            return false; // User already exists
        }

        // Hash the password securely
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Insert the user into the database
        $insertQuery = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($connection, $insertQuery);
        mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashedPassword);

        if (mysqli_stmt_execute($stmt)) {
            // Fetch the newly inserted user id
            $userId = mysqli_insert_id($connection);

            // Get the role_id based on the role name
            $roleQuery = "SELECT id FROM roles WHERE name = ?";
            $stmt = mysqli_prepare($connection, $roleQuery);
            mysqli_stmt_bind_param($stmt, "s", $role);
            mysqli_stmt_execute($stmt);
            $roleResult = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($roleResult) > 0) {
                $roleRow = mysqli_fetch_assoc($roleResult);
                $roleId = $roleRow['id'];

                // Assign the role to the user in the user_roles table
                $roleInsertQuery = "INSERT INTO user_roles (user_id, role_id) VALUES (?, ?)";
                $stmt = mysqli_prepare($connection, $roleInsertQuery);
                mysqli_stmt_bind_param($stmt, "ii", $userId, $roleId);
                mysqli_stmt_execute($stmt);
            }

            return true; // Registration successful
        }

        return false; // Registration failed
    }

    // Login the user
    private $db;

    public function __construct()
    {
        $this->db = getConnection();
    }

    public function loginUser($email, $password)
    {
        try {
            $query = "SELECT * FROM users WHERE email = ?";
            $stmt = mysqli_prepare($this->db, $query);
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $user = mysqli_fetch_assoc($result);

            if ($user && password_verify($password, $user['password'])) {
                return $user;
            }
            return false;
        } catch (Exception $e) {
            error_log("Login error: " . $e->getMessage());
            return false;
        }
    }

    public function getUserRoles($userId)
    {
        try {
            $query = "SELECT r.name FROM roles r
                     INNER JOIN user_roles ur ON ur.role_id = r.id
                     WHERE ur.user_id = ?";
            $stmt = mysqli_prepare($this->db, $query);
            mysqli_stmt_bind_param($stmt, "i", $userId);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            $roles = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $roles[] = $row['name'];
            }
            return $roles;
        } catch (Exception $e) {
            error_log("Get user roles error: " . $e->getMessage());
            return [];
        }
    }
}

?>
