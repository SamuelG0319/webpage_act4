<?php
// Incluimos la clase Libro
include "libro.php";

// Iniciamos la sesión
session_start();

// Si el formulario se ha enviado para agregar un libro
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Enviar'])) {
    // Guardamos los datos del formulario en un arreglo asociativo
    $datos = [
        'titulo' => isset($_POST['titulo']) ? $_POST['titulo'] : '',
        'autor' => isset($_POST['autor']) ? $_POST['autor'] : '',
        'anioPublicacion' => isset($_POST['anioPublicacion']) ? $_POST['anioPublicacion'] : '',
        'numeroHojas' => isset($_POST['numeroHojas']) ? $_POST['numeroHojas'] : '',
        'editorial' => isset($_POST['editorial']) ? $_POST['editorial'] : '',
    ];

    // Creamos un objeto Libro
    $libro = new Libro($datos['titulo'], $datos['autor'], $datos['anioPublicacion'], $datos['numeroHojas'], $datos['editorial']);

    // Agregamos el libro al arreglo de libros
    $_SESSION['libros'][] = $libro;
}

// Si se ha enviado el formulario de limpieza, borramos la sesión de libros
if (isset($_POST['limpiar'])) {
    unset($_SESSION['libros']);
    session_destroy();
}

// Obtenemos los libros del arreglo
$libros = isset($_SESSION['libros']) ? $_SESSION['libros'] : [];

// HTML para mostrar la lista de libros
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Ingreso de libros</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet"> 
    <!-- Link hacia el archivo de estilos css -->
    <link rel="stylesheet" href="assets/css/library.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style type="text/css">
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            text-align: center;
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
<?php
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
    <br><br><br>
    <h1 class='librosK'>Ingreso de libros</h1>
    <div id="contenedor" style="background-image: url('assets/images/books.png'); background-position: center; background-size: cover; display: flex; align-items: center; justify-content: center; margin: 0; padding: 0; min-width: 100vw; min-height: 100vh; width: 100%; height: 100%;">
        <div id="contenedorcentrado">
            <div id="libro">
                <form id="libroform" method="post">
                    <label for="titulo">Título</label>
                    <input id="titulo" type="text" name="titulo" placeholder="Título" required>

                    <label for="autor">Autor</label>
                    <input id="autor" type="text" placeholder="Autor" name="autor" required>

                    <label for="anioPublicacion">Año de publicación</label>
                    <input id="anioPublicacion" type="number" placeholder="Año de publicación" name="anioPublicacion"
                        required>

                    <label for="numeroHojas">Número de páginas</label>
                    <input id="numeroHojas" type="number" placeholder="Número de páginas" name="numeroHojas" required>

                    <label for="editorial">Editorial</label>
                    <input id="editorial" type="text" placeholder="Editorial" name="editorial" required>

                    <button type="submit" title="Enviar" name="Enviar">Enviar</button>
                </form>
                <form method="post">
                    <button type="submit" name="limpiar">Limpiar datos</button>
                </form>
                <br>
                   <a href="menu.php" class="boton">Menú</a>

            </div>
        </div>
    </div>

    <?php
    // Verificamos que el arreglo de libros no esté vacío
    if (!empty($libros)) {
        // Imprimimos los libros en una tabla centrada
        echo "<h2 style='text-align: center;' class='librosK'>Libros ingresados:</h2>";
        echo "<table>";
        echo "<tr><td>Título</td><td>Autor</td><td>Año de Publicación</td><td>Número de Páginas</td><td>Editorial</td></tr>";
        foreach ($libros as $libro) {
            echo "<tr><td>{$libro->getTitulo()}</td><td>{$libro->getAutor()}</td><td>{$libro->getAnioPublicacion()}</td><td>{$libro->getNumeroHojas()}</td><td>{$libro->getEditorial()}</td></tr>";
        }
        echo "</table>";
    } else {
        // No hay libros para mostrar
        echo "<div style='text-align: center;' class='librosK'>No hay libros para mostrar.</div>";
    }
    ?>
</body>
</html>