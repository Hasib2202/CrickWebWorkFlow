<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// if (isset($_GET['error'])) {
//     echo '<script>alert("' . htmlspecialchars($_GET['error']) . '");</script>';
// }
?>
<?php
// if (isset($_GET['error'])) {
//     echo "<p style='color: red;'>" . htmlspecialchars($_GET['error']) . "</p>";
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>CrickWeb - Registration</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../login/css/style.css">
    <style>
        /* .error-message {
            color: #ff4c4c;
            margin-top: 5px;
            font-size: 14px;
            display: none;

        } */

        .message {
            text-align: center;
            font-size: 14px;
            margin-top: 10px;
        }

        .error-message {
            color: #ff4c4c;
        }

        .success-message {
            color: #28a745;
        }


        .form-group input,
        .form-group select {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #007bff;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .submit {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .submit:hover {
            background-color: #0056b3;
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
                        <li><a href="login.php" class="nav-link">login</a></li>
                        <li class="active"><a href="registration.php" class="nav-link">Register</a></li>
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
                    <h1 class="display-2 text-white">CrickWeb </h1>
                    <h1 class="display-2 text-white">Registration</h1>
                </div>
            </div>
            <form id="registrationForm" action="../Controllers/UserController.php?action=register" method="POST">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <div class="login-wrap p-0">
                            <div class="form-group">
                                <input type="text" id="name" name="name" class="form-control" placeholder="Full Name">
                                <div class="error-message" id="nameError"></div>
                            </div>
                            <div class="form-group">
                                <input type="email" id="email" name="email" class="form-control " placeholder="Email">
                                <div class="error-message" id="emailError"></div>
                            </div>
                            <div class="form-group">
                                <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                                <div class="error-message" id="passwordError"></div>
                            </div>
                            <div class="form-group">
                                <select id="role" name="role" class="form-control">
                                    <option class="bg-dark" value="">Select Role</option>
                                    <option class="bg-dark" value="Admin">Admin</option>
                                    <option class="bg-dark" value="Manager">Manager</option>
                                    <option class="bg-dark" value="Player">Player</option>
                                    <option class="bg-dark" value="Sponsor">Sponsor</option>
                                </select>
                                <div class="error-message" id="roleError"></div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary submit px-3">Register</button>
                            </div>
                            <!-- Error/Success Message -->
                            <?php if (isset($_GET['error'])): ?>
                                <div class="message error-message"><?= htmlspecialchars($_GET['error']); ?></div>
                            <?php endif; ?>
                            <?php if (isset($_GET['success'])): ?>
                                <div class="message success-message"><?= htmlspecialchars($_GET['success']); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="text-center mt-4">
                            <a href="login.php" class="text-white" style="text-decoration: none;">
                                Already have an account? Login
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <script>
        // Update your existing sidebar toggle script
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const button = this;

            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');

            // Optional: Rotate icon when sidebar is toggled
            const icon = button.querySelector('i');
            icon.style.transform = sidebar.classList.contains('collapsed') ? 'rotate(180deg)' : '';
        });
    </script>

    <script src="../../login/js/jquery.min.js"></script>
    <script src="../../login/js/popper.js"></script>
    <script src="../../login/js/bootstrap.min.js"></script>
</body>

</html>