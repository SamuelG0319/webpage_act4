<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/Mstyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Mooli&family=Oswald:wght@300;500&family=Roboto+Condensed:ital,wght@0,300;0,400;1,300;1,400&family=Roboto:wght@300;400;700&display=swap"
        rel="stylesheet">
    <title>Calculator</title>
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
                            <li><a href="mainMenu.php" class="active text1">Home</a></li>
                            <li><a href="problema1.php" class="text1">Problema 1</a></li>
                            <li><a href="problema2.php" class="text1">Problema 2</a></li>
                            <li><a href="problema3.php" class="text1">Problema 3</a></li>
                            <li><a href="logout.php" class="text1">Log Out</a></li>
                            <li><a href="#" class="text1">
                                    <?php echo $username ?><img src="<?php echo $profImg ?>" alt="">
                                </a></li>
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

    <nav>
        <div class="header">
            <h1 class="title">Calculator</h1>
        </div>
    </nav>

    <section class="calContainer">
        <div class="calFormContainer">
            <form action="" method="POST">
                <div class="inputContainer">
                    <label for="num1" class="textInput">Ingrese el Primer Número: </label>
                    <input type="text" name="num1" id="num1" required class="inputForm"
                        placeholder=" Primer Número"><br><br>
                    <label for="num2" class="textInput">Ingrese el Segundo Número: </label>
                    <input type="text" name="num2" id="num2" required class="inputForm"
                        placeholder=" Segundo Número"><br><br><br>
                </div>

                <div class="btnsContainer">
                    <div>
                        <select name="operacion" class="text btnForm">
                            <option value="suma" class="text btnSelect">Suma</option>
                            <option value="resta" class="text btnSelect">Resta</option>
                            <option value="multiplicacion" class="text btnSelect">Multiplicación</option>
                            <option value="division" class="text btnSelect">División</option>
                        </select>
                    </div>

                    <div class="submit">

                        <input type="submit" value="Realizar Proceso" class="btnForm text">

                    </div>
                </div>
            </form>
            <button onclick="mostrar();" class="btnForm text">Ingresar Notas</button>
        </div>
    </section>



    <?php
    error_reporting(0);
    class MiClase
    {
        private $num1;
        private $num2;
        public function setNum1($num1)
        {
            $this->num1 = $num1;
        }
        public function getNum1()
        {
            return $this->num1;
        }
        public function setNum2($num2)
        {
            $this->num2 = $num2;
        }
        public function getNum2()
        {
            return $this->num2;
        }
    }
    //Bloquede metodos (abstracto y sencillo)
    abstract class Calculadora
    {
        abstract public function sumar(int $a, int $b): int;
        public function restar(int $a, int $b): int
        {
            return $a - $b;
        }
    }
    class CalculadoraBasica extends Calculadora
    {
        public function sumar(int $a, int $b): int
        {
            return $a + $b;
        }
    }
    $calculadora = new CalculadoraBasica();
    //fin de bloque de metodos
    
    //Bloque de Interfaz
    interface MiInterfaz
    {
        public static function multiply($a, $b);
        public function divide($a, $b);
    }
    class ClaseImplementadora implements MiInterfaz
    {

        public static function multiply($a, $b)
        {
            $multi = $a * $b;
            return $multi;
        }
        public function divide($a, $b)
        {
            // Implementación del método no estático
            $div = $a / $b;
            return $div;
        }
    }
    //fin de bloque abstracto
    $clase = new ClaseImplementadora();
    $objeto = new MiClase();
    $objeto->setNum1(0);
    $objeto->setNum2(0);
    $resultado = 0;
    // Recibir los datos del usuario
    $objeto->setNum1($_POST['num1']);
    $objeto->setNum2($_POST['num2']);
    $operacion = $_POST['operacion'];
    // Realizar la operación matemática correspondiente
    switch ($operacion) {
        case "suma":
            $resultado = $calculadora->sumar($objeto->getNum1(), $objeto->getNum2());
            break;
        case "resta":
            $resultado = $calculadora->restar($objeto->getNum1(), $objeto->getNum2());
            break;
        case "multiplicacion":
            $resultado = $clase->multiply($objeto->getNum1(), $objeto->getNum2());
            break;
        case "division":
            $resultado = $clase->divide($objeto->getNum1(), $objeto->getNum2());
            break;
    }
    // Mostrar el resultado al usuario
    echo "
    <div class='resultContainer' >
        <div class='result' id='resultContainer'>
            <h2 class='title'>Resultado</h2>
            <p class='text resultText'>$resultado</p>
            <br>";
    // Comprobar si los dos números son iguales, mayores o menores
    if ($objeto->getNum1() == $objeto->getNum2()) {
        echo "<h3 class='resultText mmi'>El primer número: " . $objeto->getNum1() . " y el segundo número: " . $objeto->getNum2() . " son iguales.</h3>";
    } else if ($objeto->getNum1() > $objeto->getNum2()) {
        echo "<h3 class='resultText mmi'>El primer número: " . $objeto->getNum1() . ", es mayor que el segundo número: " . $objeto->getNum2() . ".</h3>";
    } else {
        echo "<h3 class='resultText mmi'>El segundo número: " . $objeto->getNum2() . ", es mayor que el primer número: " . $objeto->getNum1() . ".</h3> 
            </div>
        </div>";
    }
    ?>
</body>
</html>