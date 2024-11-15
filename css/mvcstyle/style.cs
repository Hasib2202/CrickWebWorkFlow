/* sidebar.css */
.sidebar {
    position: fixed;
    left: 0;
    top: 0;
    height: 100%;
    width: 250px;
    background: #2c3e50;
    color: #fff;
    transition: all 0.3s;
    z-index: 1000;
}

.sidebar.collapsed {
    width: 70px;
}

.sidebar-header {
    padding: 20px;
    background: #1a2634;
}

.sidebar-content {
    padding: 0;
}

.nav-item {
    padding: 10px 20px;
    transition: all 0.3s;
}

.nav-item:hover {
    background: #34495e;
    cursor: pointer;
}

.nav-link {
    color: #fff;
    text-decoration: none;
    display: flex;
    align-items: center;
}

.nav-link i {
    margin-right: 10px;
    width: 20px;
    text-align: center;
}

.nav-text {
    opacity: 1;
    transition: opacity 0.3s;
}

.sidebar.collapsed .nav-text {
    opacity: 0;
    display: none;
}

.main-content {
    margin-left: 250px;
    transition: all 0.3s;
}

.main-content.expanded {
    margin-left: 70px;
}

/* Custom scrollbar for sidebar */
.sidebar::-webkit-scrollbar {
    width: 5px;
}

.sidebar::-webkit-scrollbar-track {
    background: #1a2634;
}

.sidebar::-webkit-scrollbar-thumb {
    background: #34495e;
}

/* sidebar.css */
.sidebar {
    position: fixed;
    left: 0;
    top: 0;
    height: 100vh;
    width: 250px;
    background: #2c3e50;
    color: #fff;
    transition: all 0.3s ease;
    z-index: 1000;
}

.sidebar.collapsed {
    width: 70px;
}

.sidebar-brand {
    padding: 15px 20px;
    font-size: 1.5rem;
    background: #1a2634;
    height: 60px;
    display: flex;
    align-items: center;
}

.sidebar-menu {
    padding: 0;
    margin: 0;
    list-style: none;
}

.menu-item {
    padding: 15px 20px;
    display: flex;
    align-items: center;
    transition: all 0.3s;
}

.menu-item:hover {
    background: #34495e;
    cursor: pointer;
}

.menu-item i {
    font-size: 1.2rem;
    min-width: 30px;
}

.menu-text {
    margin-left: 10px;
    white-space: nowrap;
    opacity: 1;
    transition: opacity 0.3s;
}

.sidebar.collapsed .menu-text {
    opacity: 0;
    display: none;
}

.main-content {
    margin-left: 250px;
    transition: all 0.3s ease;
    padding: 15px;
}

.main-content.expanded {
    margin-left: 70px;
}

/* Toggle Button Styles */
.toggle-btn {
    background: transparent;
    border: none;
    padding: 10px 15px;
    color: #fff;
    cursor: pointer;
    position: fixed;
    left: 250px;
    top: 15px;
    z-index: 1001;
    transition: all 0.3s ease;
}

.toggle-btn.collapsed {
    left: 70px;
}

.toggle-btn:hover {
    color: #3498db;
}

.toggle-btn:focus {
    outline: none;
}

/* Add this for the toggle icon rotation */
.toggle-btn i {
    transition: transform 0.3s ease;
}

.toggle-btn.collapsed i {
    transform: rotate(180deg);
}

  /* Additional custom styles */
        .card {
            border: none;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #eee;
        }

        .stat-card {
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .navbar {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Custom scrollbar for main content */
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

        /* Add to sidebar.css */
        .sidebar-toggle {
            padding: 0.5rem;
            font-size: 1.25rem;
            border: none;
            background: transparent !important;
            color: #fff;
            transition: all 0.3s;
        }

        .sidebar-toggle:hover {
            color: #fff;
            transform: scale(1.1);
        }

        .sidebar-toggle:focus {
            box-shadow: none !important;
            outline: none !important;
        }

        /* Dropdown styling */
        .dropdown-toggle {
            background: transparent !important;
            border: none !important;
            padding: 8px 15px;
        }

        .dropdown-toggle:hover,
        .dropdown-toggle:focus {
            background: rgba(255, 255, 255, 0.1) !important;
            box-shadow: none !important;
        }

        .dropdown-menu {
            background: #ffffff;
            border: none;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 0.5rem 0;
        }

        .dropdown-item {
            padding: 0.5rem 1rem;
            color: #333;
            transition: all 0.3s;
        }

        .dropdown-item:hover {
            background: #f8f9fa;
            color: #0d6efd;
        }

        .dropdown-divider {
            margin: 0.3rem 0;
        }

        /* User icon and name styling */
        .dropdown-toggle i {
            font-size: 1.2rem;
            margin-right: 0.5rem;
        }