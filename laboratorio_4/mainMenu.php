<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Main Menu - Act4</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-cyborg-gaming.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

</head>

<body>

    <?php
    session_start();
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];

        // Abre el archivo de texto
        $date = date("d-m-Y H:i:s");
        $file = fopen($username . ".txt", "r");

        while (($line = fgets($file)) !== false) {
            list($storedUsername, $data) = explode(",", trim($line));

            if ($username === $storedUsername) {
                // Muestra los datos del usuario
                $userData = explode("|", $data);
                $profImg = $userData[6];
                break;
            }
        }

        fclose($file);
    } else {
        $errorMessage = "Debes iniciar sesión para ver esta página.";
        echo '<script>';
        echo 'alert("' . $errorMessage . '");';
        echo 'window.location.href = "index.php";'; // Redirige a index.php
        echo '</script>';
        exit;
    }
    ?>

    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="mainMenu.php" class="logo">
                            <img src="assets/images/logoEonias.png" alt="" width="80px" height="80px">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li><a href="mainMenu.php" class="active">Home</a></li>
                            <li><a href="problema1.php">Problema 1</a></li>
                            <li><a href="problema2.php">Problema 2</a></li>
                            <li><a href="problema3.php">Problema 3</a></li>
                            <li><a href="logout.php">Log Out</a></li>
                            <li><a href="mainMenu.php"><?php echo $username ?><img src="<?php echo $profImg ?>" alt=""></a></li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-content">

                    <!-- ***** Banner Start ***** -->
                    <div class="main-banner">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="header-text">
                                    <h6>Bienvenido a la Actividad 4</h6>
                                    <h4><em>Encuentra</em> El Problema Que Quieras Verificar Abajo</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ***** Banner End ***** -->
                    <!-- ***** Problems ***** -->
                    <div class="live-stream">
                        <div class="col-lg-12">
                            <div class="heading-section">
                                <h4><em>Escoge</em> El que deseas</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 mx-auto">
                                <div class="item">
                                    <div class="thumb">
                                        <img src="assets/images/libros.jpg" alt="">
                                        <div class="hover-effect">
                                            <div class="content">
                                                <ul>
                                                    <li><a href="problema1.php"><i class="fa fa-eye"></i>Ver Problema</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="down-content">
                                        <a href="problema1.php"><span><i class="fa fa-eye"></i>Problema 1</span></a>
                                        <a href="problema1.php">
                                            <h4>Libros por: Keily Marín</h4>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 mx-auto">
                                <div class="item">
                                    <div class="thumb">
                                        <img src="assets/images/notas.jpg" alt="">
                                        <div class="hover-effect">
                                            <div class="content">
                                                <ul>
                                                    <li><a href="problema2.php"><i class="fa fa-eye"></i>Ver Problema</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="down-content">
                                        <a href="problema2.php"><span><i class="fa fa-eye"></i>Problema 2</span></a>
                                        <a href="problema2.php">
                                            <h4>Notas por: Samuel Lasso</h4>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 mx-auto">
                                <div class="item">
                                    <div class="thumb">
                                        <img src="assets/images/calculadora.jpg" alt="">
                                        <div class="hover-effect">
                                            <div class="content">
                                                <ul>
                                                    <li><a href="problema3.php"><i class="fa fa-eye"></i>Ver problema</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="down-content">
                                        <a href="problema3.php"><span><i class="fa fa-eye"></i>Problema 3</span></a>
                                        <a href="problema3.php">
                                            <h4>Calculadora por: Miguel Rodríguez</h4>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ***** Live Stream End ***** -->
            </div>
        </div>
    </div>
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright © 2023 <a href="#">Eonias Holdings.</a> All rights reserved.
                        <br>Design With Love By: Keily Marín, Miguel Rodríguez & Samuel Lasso</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>


    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/popup.js"></script>
    <script src="assets/js/custom.js"></script>


</body>

</html>