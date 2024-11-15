<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>CrickWeb - Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../login/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
    <style>
        .error-message {
            color: #ff4c4c;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            text-align: center;
        }

        .shake {
            animation: shake 0.5s;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: translateX(-5px);
            }

            20%,
            40%,
            60%,
            80% {
                transform: translateX(5px);
            }
        }

        .is-invalid {
            border-color: #ff4c4c !important;
        }

        .img {
            min-height: 100vh;
            background-size: cover;
            overflow: hidden;
        }

        .field-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #999;
        }

        .form-group {
            position: relative;
            /* So the eye icon is positioned relative to the form group */
        }
    </style>

    <script src="../js/registrationValidation.js" defer></script>

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
                        <form id="loginForm" action="../Controllers/UserController.php?action=login" class="signin-form" method="POST">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input name="password" type="password" class="form-control" placeholder="Password">
                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary submit px-3">Login</button>
                            </div>
                            <?php if (isset($_SESSION['error'])): ?>
                                <div class="error-message">
                                    <?php
                                    echo htmlspecialchars($_SESSION['error']);
                                    unset($_SESSION['error']); // Clear error after displaying
                                    ?>
                                </div>
                            <?php endif; ?>
                        </form>
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

    <script src="../../login/js/jquery.min.js"></script>
    <script src="../../login/js/popper.js"></script>
    <script src="../../login/js/bootstrap.min.js"></script>
    <script src="../js/loginValidation.js"></script>
</body>

</html>