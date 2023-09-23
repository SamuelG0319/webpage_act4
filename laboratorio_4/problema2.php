<!DOCTYPE html>
<html lang="es">

<head>
    <title>Problema 2 - Act4</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
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

    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li><a href="mainMenu.php" class="active">Home</a></li>
                            <li><a href="problema1.php">Problema 1</a></li>
                            <li><a href="problema2.php">Problema 2</a></li>
                            <li><a href="problema3.php">Problema 3</a></li>
                            <li><a href="logout.php">Log Out</a></li>
                            <li><a href="#"><?php echo $username ?><img src="<?php echo $profImg ?>" alt=""></a></li>
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

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-10 mx-auto">
                    <div class="wrap d-md-flex">
                        <div class="login-wrap p-4 p-md-5">
                            <div class="w-100">
                                <h3 class="mb-4">Datos Personales</h3>
                            </div>
                            <form method="POST" action="problema2.php" class="signin-form">
                                <div class="form-group mb-3">
                                    <label class="label" for="name">Nombre</label>
                                    <input type="text" class="form-control" name="name" placeholder="Nombre" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="lastName">Apellido</label>
                                    <input type="text" class="form-control" name="lastName" placeholder="Apellido" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="age">Edad</label>
                                    <input type="number" class="form-control" name="age" placeholder="Edad" required>
                                </div>
                                <div class="form-group">
                                    <button onclick="showHide();" class="form-control btn btn-primary rounded submit px-3">Ingresar Notas</button>
                                </div>
                                <div id="content" class="oculto">
                                    <div class="w-100">
                                        <h3 class="mb-4">Notas</h3>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="label" for="parciales">Parciales</label>
                                        <input type="number" class="form-control" name="parciales" placeholder="Parciales" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="label" for="laboratorios">Laboratorios</label>
                                        <input type="number" class="form-control" name="laboratorios" placeholder="Laboratorios" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="label" for="proyecto">Proyecto</label>
                                        <input type="number" class="form-control" name="proyecto" placeholder="Proyecto" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="label" for="semestral">Semestral</label>
                                        <input type="number" class="form-control" name="semestral" placeholder="Semestral" required>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="form-control btn btn-primary rounded submit px-3">Calcular Nota</button>
                                    </div>
                                </div>
                            </form>

                            <?php
                            require_once('estudiante_fisica.php');

                            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                $nombre = $_POST['name'];
                                $apellido = $_POST['lastName'];
                                $edad = intval($_POST['age']);
                                $nota1 = floatval($_POST['parciales']);
                                $nota2 = floatval($_POST['laboratorios']);
                                $nota3 = floatval($_POST['proyecto']);
                                $nota4 = floatval($_POST['semestral']);

                                $estudiante = new EstudianteFisica($nombre, $apellido, $edad, $nota1, $nota2, $nota3, $nota4);

                                echo <<<HTML
                                <div class="w-100">
                                    <h3 class="mb-4">Datos del Estudiante</h3>
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-offset-1 col-md-10">
                                            <div class="panel">
                                                <div class="panel-heading">
                                                    <div class="row">
                                                        <div class="col col-sm-3 col-xs-12">
                                                            <h4 class="title">Desglose</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel-body table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Nombre</th>
                                                                <th>Apellido</th>
                                                                <th>Edad</th>
                                                                <th>Nota</th>
                                                                <th>Rango</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>{$estudiante->getNombre()}</td>
                                                                <td>{$estudiante->getApellido()}</td>
                                                                <td>{$estudiante->getEdad()}</td>
                                                                <td>{$estudiante->calcularNota()}</td>
                                                                <td>{$estudiante->calcularRango()}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button onclick="window.location.href='problema2.php'" class="form-control btn btn-primary rounded submit px-3">Ingresar otro estudiante</button>
                                </div>
                                HTML;
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <script>
        function showHide() {
            var content = document.getElementById("content");
            if (content.classList.contains("oculto")) {
                content.classList.remove("oculto");
                content.classList.add("visible");
            } else {
                content.classList.remove("visible");
                content.classList.add("oculto");
            }
        }
    </script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>