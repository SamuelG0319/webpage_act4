<?php 
    class Estudiante {

        private $nombre;
        private $apellido;
        private $edad;

        public function __construct($nombre, $apellido, $edad)
        {
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->edad = $edad;
        }

        public function getNombre() {
            return $this->nombre;
        }

        public function setNombre($nombre) {
            $this->nombre = $nombre;
        }

        public function getApellido() {
            return $this->apellido;
        }

        public function setApellido($apellido) {
            $this->apellido = $apellido;
        }

        public function getEdad() {
            return $this->edad;
        }

        public function setEdad($edad) {
            $this->edad = $edad;
        }

        public function printData() {
            echo "Nombre: {$this->nombre}<br>";
            echo "Apellido: {$this->apellido}<br>";
            echo "Edad: {$this->edad}<br>";
        }
    }
?>