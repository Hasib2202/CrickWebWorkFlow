<?php
require_once '../middleware/AuthMiddleware.php';
AuthMiddleware::checkAuth();
AuthMiddleware::checkRole(['Admin']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - CrickWeb</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet" />

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        :root {
            --sidebar-width: 250px;
            --sidebar-collapsed-width: 70px;
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --success-color: #4cc9f0;
            --bg-light: #f8f9fa;
            --transition-speed: 0.3s;
        }

        /* // Add this to your existing CSS */
        :root {
            /* Modern sports website color scheme */
            --primary-color: #1a73e8;
            /* Sporty blue */
            --secondary-color: #ff4081;
            /* Dynamic pink */
            --accent-color: #00c853;
            /* Victory green */
            --dark-bg: #1e1e2d;
            /* Dark background */
            --light-bg: #f5f6fa;
            /* Light background */
            --text-primary: #2c3e50;
            /* Main text color */
            --text-secondary: #7f8c8d;
            /* Secondary text */
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-light);
            overflow-x: hidden;
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: var(--primary-color);
            color: white;
            transition: all var(--transition-speed) ease;
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            background: var(--dark-bg);
            overflow: hidden;
            /* width: 250px;
            transition: width 0.3s; */
        }

        .sidebar.collapsed {
            /* width: var(--sidebar-collapsed-width); */
            width: 61px;
            /* Adjust width as needed for icons */
        }


        .sidebar-header {
            padding: 1.5rem;
            /* background: var(--info-color); */
            /* background: var(--sidebar-collapsed-); */
            /* background: var(--dark-bg); */
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));

            color: white;
            height: 70px;
            display: flex;
            align-items: center;
        }

        .sidebar-header h4 {
            margin: 0;
            font-size: 1.25rem;
            white-space: nowrap;
            overflow: hidden;
            /* background: var(--primary-color); */
            /* border-bottom: 1px solid rgba(255, 255, 255, 0.1); */
        }

        .sidebar-content {
            padding: 1rem 0;
        }

        /* Add Search Bar Styles */
        .navbar .search-container {
            max-width: 400px;
            width: 100%;
            margin: 0 auto;
        }

        .search-bar {
            width: 100%;
            padding: 0.5rem 1rem;
            border: 1px solid #e0e0e0;
            border-radius: 50px;
            background: var(--light-bg);
            transition: all 0.3s ease;
        }

        .search-bar:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(26, 115, 232, 0.2);
        }

        /* Fix Toggle Button Issues */
        .sidebar-toggle {
            z-index: 1050;
            position: relative;
            width: 40px;
            height: 40px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .sidebar-toggle:hover {
            background: rgba(0, 0, 0, 0.05);
        }



        .nav-link {
            color: rgba(255, 255, 255, 0.85);
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: all var(--transition-speed) ease;
        }

        .nav-link:hover {
            color: white;
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }

        .nav-link i {
            width: 20px;
            text-align: center;
        }

        .nav-text {
            white-space: nowrap;
            overflow: hidden;
        }

        /* Main Content Styles */
        .main-content {
            margin-left: var(--sidebar-width);
            /* transition: all var(--transition-speed) ease; */
            min-height: 100vh;
            /* padding: 20px; */
            width: calc(100% - 250px);
            transition: margin-left 0.3s, width 0.3s;
        }

        .main-content.expanded {
            margin-left: var(--sidebar-collapsed-width);
        }

        /* Navbar Styles */
        .navbar {
            height: 70px;
            background: white !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);

        }

        .navbar .btn-dark {
            background: transparent;
            color: #333;
            border: none;
            padding: 0.5rem;
        }

        .navbar .btn-dark:hover {
            background: rgba(0, 0, 0, 0.05);

        }

        /* Stats Cards */
        .stats-card {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 15px;
            border: none;
            transition: transform var(--transition-speed) ease;
        }

        .stats-card:nth-child(2) {
            background: linear-gradient(135deg, var(--secondary-color), var(--accent-color));
        }

        .stats-card:nth-child(3) {
            background: linear-gradient(135deg, var(--accent-color), var(--primary-color));
        }

        .stats-card:nth-child(4) {
            background: linear-gradient(135deg, var(--primary-color), var(--dark-bg));
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .stats-card .card-body {
            padding: 1.5rem;
        }

        .stats-card i {
            opacity: 0.8;
        }

        /* Activity Card */
        .activity-card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .activity-card .card-header {
            background: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1rem 1.5rem;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                width: var(--sidebar-collapsed-width);
            }

            .main-content {
                margin-left: var(--sidebar-collapsed-width);
            }

            .sidebar.expanded {
                width: var(--sidebar-width);
            }
        }
    </style>
</head>

<body>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h4>CrickWeb Admin</h4>
        </div>
        <div class="sidebar-content">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="dashboard.php" class="nav-link active">
                        <i class="fas fa-home"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="users.php" class="nav-link">
                        <i class="fas fa-users"></i>
                        <span class="nav-text">Users</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="matches.php" class="nav-link">
                        <i class="fas fa-trophy"></i>
                        <span class="nav-text">Matches</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="teams.php" class="nav-link">
                        <i class="fas fa-user-friends"></i>
                        <span class="nav-text">Teams</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="reports.php" class="nav-link">
                        <i class="fas fa-chart-bar"></i>
                        <span class="nav-text">Reports</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="settings.php" class="nav-link">
                        <i class="fas fa-cog"></i>
                        <span class="nav-text">Settings</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-content" id="main-content">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <button class="btn btn-dark sidebar-toggle" id="sidebar-toggle">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="search-container mx-auto d-none d-md-block">
                    <input type="search" class="search-bar" placeholder="Search for matches, teams, or users...">
                </div>

                <div class="ms-auto">
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle"></i>
                            <span class="d-none d-md-inline"><?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="profile.php">
                                    <i class="fas fa-user me-2"></i>Profile
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" onclick="handleLogout()">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container-fluid p-4">
            <div class="row g-4">
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card stats-card bg-primary text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-2">Total Users</h6>
                                    <h2 class="mb-0">500</h2>
                                </div>
                                <i class="fas fa-users fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card stats-card bg-success text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-2">Active Matches</h6>
                                    <h2 class="mb-0">10</h2>
                                </div>
                                <i class="fas fa-trophy fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card stats-card" style="background: var(--success-color); color: white;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-2">Total Teams</h6>
                                    <h2 class="mb-0">24</h2>
                                </div>
                                <i class="fas fa-user-friends fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card stats-card bg-info text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-2">Total Revenue</h6>
                                    <h2 class="mb-0">$15.4K</h2>
                                </div>
                                <i class="fas fa-dollar-sign fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card activity-card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Recent Activity</h5>
                            <button class="btn btn-sm btn-primary">View All</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Action</th>
                                            <th>Time</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>John Doe</td>
                                            <td>Created new match</td>
                                            <td>2 minutes ago</td>
                                            <td><span class="badge bg-success">Completed</span></td>
                                        </tr>
                                        <tr>
                                            <td>Jane Smith</td>
                                            <td>Updated team roster</td>
                                            <td>5 minutes ago</td>
                                            <td><span class="badge bg-warning">Pending</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script src="../js/autoLogout.js"></script>
    <script>
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('collapsed');
            document.getElementById('main-content').classList.toggle('expanded');
        });

        // Initialize Auto Logout
        document.addEventListener('DOMContentLoaded', function() {
            new AutoLogout();
        });

        function handleLogout() {
            fetch('../controllers/UserController.php?action=logout', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest' // Identifies the request as AJAX
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Redirect to login page after successful logout
                        window.location.href = '../Views/login.php';
                    }
                })
                .catch(error => console.error('Logout failed:', error));
        }
    </script>
</body>

</html>