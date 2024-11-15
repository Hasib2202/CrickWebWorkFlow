<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unauthorized Access</title>
    <link rel="stylesheet" href="../../css/bootstrap/bootstrap.css">
    <style>
        .unauthorized-container {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        .error-code {
            font-size: 120px;
            color: #dc3545;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="unauthorized-container">
        <div class="content">
            <div class="error-code">403</div>
            <h1 class="mb-4">Access Denied</h1>
            <p class="mb-4">You don't have permission to access this page.</p>
            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                <a href="../Controllers/UserController.php?action=logout" class="btn btn-primary">Logout</a>
            <?php else: ?>
                <a href="login.php" class="btn btn-primary">Login</a>
            <?php endif; ?>
            <a href="javascript:history.back()" class="btn btn-secondary ml-2">Go Back</a>
        </div>
    </div>
</body>
</html>