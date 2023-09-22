<?php
require_once('estudiante.php');

class EstudianteFisica extends Estudiante {
    private $parciales;
    private $laboratorios;
    private $proyecto;
    private $semestral;

    public function __construct($nombre, $apellido, $edad, $parciales, $laboratorios, $proyecto, $semestral)
    {
        parent::__construct($nombre, $apellido, $edad);
        $this->parciales = $parciales;
        $this->laboratorios = $laboratorios;
        $this->proyecto = $proyecto;
        $this->semestral = $semestral;
    }

    public function getParciales() {
        return $this->parciales;
    }

    public function setParciales($parciales) {
        $this->parciales = $parciales;
    }

    public function getLaboratorios() {
        return $this->laboratorios;
    }

    public function setLaboratorios($laboratorios) {
        $this->laboratorios = $laboratorios;
    }

    public function getProyecto() {
        return $this->proyecto;
    }

    public function setProyecto($proyecto) {
        $this->proyecto = $proyecto;
    }

    public function getSemestral() {
        return $this->semestral;
    }

    public function setSemestral($semestral) {
        $this->semestral = $semestral;
    }

    public function calcularNota() {
        $nota = ($this->parciales * 0.25 + $this->laboratorios * 0.25 + $this->proyecto * 0.25 + $this->semestral * 0.25);
        
        return $nota;
    }

    public function calcularRango() {
        $nota = $this->calcularNota();
        $rango = "";
        switch ($nota) {
            case $nota > 90:
                $rango = "A";
                break;
            case $nota > 80:
                $rango = "B";
                break;
            case $nota > 70:
                $rango = "C";
                break;
            case $nota > 60:
                $rango = "D";
                break;
            default:
                $rango = "F";
                break;
        }

        return $rango;
    }

    public function imprimirNota() {
        $notaLista = $this->calcularNota();
        $rangoListo = $this->calcularRango();

        echo "Nota: $notaLista \n
                Rango: $rangoListo";
    }
}
?>