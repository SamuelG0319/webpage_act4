<?php
class User {
    private $usersFile = 'users.txt';
    private $errorMessage = '';

    public function authenticate($username, $password) {
        //Abrimos el archivo con las credenciales de los usuarios
        $file = fopen($this->usersFile, 'r');
        if ($file) {
            while (($line = fgets($file)) !== false) {
                list($user, $pass) = explode('|', trim($line));
                if ($username === $user && $password === $pass) {
                    //El nicio de sesión fue exitoso
                    fclose($file);
                    session_start();
                    $_SESSION['username'] = $username;
                    $_SESSION['time_session'] = date('Y-m-d H:i:s');
                    header('Location: mainMenu.php'); // Redirigir al menú
                    exit;
                } else if ($username === $user) {
                    //Si el nombre de usuario está bien, quiere decir que la contraseña es incorrecta
                    $this->errorMessage = "Contraseña incorrecta. Inténtalo nuevamente.";
                    fclose($file);
                    return false;
                }
            }
            fclose($file);
        }
        // Autenticación fallida, al ingresar el nombre de usuario incorrectamente
        $this->errorMessage = "Usuario incorrecto. Inténtalo nuevamente.";
        return false;
    }

    public function getErrorMessage() {
        return $this->errorMessage;
    }
}
?>