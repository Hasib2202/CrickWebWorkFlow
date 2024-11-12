<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>CrickWeb - Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts and Icons -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../login/css/style.css">

    <!-- Inline Styling for Error Messages -->
    <style>
        .error-message {
            color: #ff4c4c;
            margin-top: 10px;
            display: none;
        }
    </style>

    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="../../fonts/icomoon/style.css" />

    <link rel="stylesheet" href="../../css/bootstrap/bootstrap.css" />
    <link rel="stylesheet" href="../../css/jquery-ui.css" />
    <link rel="stylesheet" href="../../css/owl.carousel.min.css" />
    <link rel="stylesheet" href="../../css/owl.theme.default.min.css" />
    <link rel="stylesheet" href="../../css/owl.theme.default.min.css" />

    <link rel="stylesheet" href="../../css/jquery.fancybox.min.css" />

    <link rel="stylesheet" href="../../css/bootstrap-datepicker.css" />

    <link rel="stylesheet" href="../../fonts/flaticon/font/flaticon.css" />

    <link rel="stylesheet" href="../../css/aos.css" />

    <link rel="stylesheet" href="../../css/style.css" />
</head>

<header class="site-navbar py-4" role="banner">
    <div class="container">
        <div class="d-flex align-items-center">
            <div class="site-logo">
                <a href="index.html">
                    <img src="../../images/Llogo.png" alt="CrickWeb" />
                </a>
            </div>
            <div class="ml-auto">
                <nav
                    class="site-navigation position-relative text-right"
                    role="navigation">
                    <ul
                        class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                        <li><a href="index.html" class="nav-link">Home</a></li>
                        <li>
                            <a href="matches.html" class="nav-link">Matches</a>
                        </li>
                        <li><a href="players.html" class="nav-link">Players</a></li>
                        <li><a href="blog.html" class="nav-link">Blog</a></li>
                        <li><a href="single.html" class="nav-link">Details</a></li>

                        <li><a href="contact.html" class="nav-link">Contact</a></li>
                        <li class="active"><a href="login.php" class="nav-link">login</a></li>
                        <li><a href="registration.php" class="nav-link">Register</a></li>
                    </ul>
                </nav>

                <a
                    href="#"
                    class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black float-right text-white"><span class="icon-menu h3 text-white"></span></a>
            </div>
        </div>
    </div>
</header>

<body class="img js-fullheight" style="background-image: url('../../login/images/bg.jpg');">

    <?php
    if (isset($_GET['success'])) {
        echo '<script>alert("' . htmlspecialchars($_GET['success']) . '");</script>';
    }
    ?>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h1 class="display-2 text-white">CrickWeb</h1>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        <h3 class="mb-4 text-center text-white">Sign in to your account</h3>
                        <form id="loginForm" class="signin-form">
                            <div class="form-group">
                                <input type="email" id="email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <input id="password" type="password" class="form-control" placeholder="Password" required>
                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary submit px-3">Login</button>
                            </div>
                            <div class="error-message" id="errorMessage"></div>
                            <div class="form-group d-md-flex">
                                <div class="w-50">
                                    <label class="checkbox-wrap checkbox-primary">Remember Me
                                        <input type="checkbox" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="w-50 text-md-right">
                                    <a href="registration.php" style="color: #fff">Register account?</a>
                                </div>
                            </div>
                        </form>

                        <!-- Back Button with Link Style -->
                        <div class="text-center mt-4">
                            <a href="javascript:history.back()" class="text-white" style="text-decoration: none;">
                                <i class="fa fa-arrow-left me-2"></i> Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- JavaScript Files -->
    <script src="../../login/js/jquery.min.js"></script>
    <script src="../../login/js/popper.js"></script>
    <script src="../../login/js/bootstrap.min.js"></script>
    <script src="../../login/js/main.js"></script>

    <!-- Inline JavaScript for Login Functionality -->
    <script>
        document.getElementById('loginForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const errorMessage = document.getElementById('errorMessage');
            errorMessage.style.display = 'none';

            try {
                const response = await fetch('http://localhost:3000/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        email,
                        password
                    })
                });

                const data = await response.json();

                if (response.status === 200) {
                    alert(`Welcome, ${data.role}!`);

                    // Redirect based on user role
                    if (data.role === 'Admin') window.location.href = '/admin/dashboard';
                    else if (data.role === 'Manager') window.location.href = '/manager/dashboard';
                    else if (data.role === 'Player') window.location.href = '/player/dashboard';
                    else if (data.role === 'Sponsor') window.location.href = '/sponsor/dashboard';
                } else {
                    errorMessage.textContent = data.message;
                    errorMessage.style.display = 'block';
                }
            } catch (err) {
                errorMessage.textContent = 'Server error. Please try again later.';
                errorMessage.style.display = 'block';
            }
        });
    </script>


</body>

</html>