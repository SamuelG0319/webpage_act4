<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Recogemos los datos del form
    $username = $_POST['username'];
    $password = $_POST['password'];

    require_once('user.php');

    $login = new User();
    if ($login->authenticate($username, $password)) {
        // El usuario se redirige a la página principal
    } else {
        //Sino, creamos el mensaje de error
        $errorMessage = $login->getErrorMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Inicio de Sesión - Act4</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div class="img" style="background-image: url(assets/images/bg-1.jpg);">
                        </div>
                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4">Iniciar Sesión</h3>
                                </div>
                                <div class="w-100">
                                    <p class="social-media d-flex justify-content-end">
                                        <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-instagram"></span></a>
                                        <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
                                    </p>
                                </div>
                            </div>
                            <form method= "POST" action="index.php" class="signin-form">
                                <div class="form-group mb-3">
                                    <label class="label" for="name">Usuario</label>
                                    <input type="text" class="form-control" name="username" placeholder="Usuario" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="password">Contraseña</label>
                                    <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3">Iniciar Sesión</button>
                                </div>
                                <div class="form-group d-md-flex">
                                    <div class="w-50 text-left">
                                        <label class="checkbox-wrap checkbox-primary mb-0">Recuérdame
                                            <input type="checkbox" checked>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="w-50 text-md-right">
                                        <a href="#">Olvidé la Contraseña</a>
                                    </div>
                                </div>
                            </form>
                            <p class="text-center">No eres miembro? <a data-toggle="tab" href="#signup">Crear Cuenta</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        <?php
        //Determinamos si la variable de error está definida para mostrarla con alert()
        if (isset($errorMessage)) {
            echo "alert('$errorMessage');";
        }
        ?>
    </script>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>