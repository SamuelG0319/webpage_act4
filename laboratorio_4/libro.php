<?php

class Libro {

  public $titulo;
  public $autor;
  public $anioPublicacion;
  public $numeroHojas;
  public $editorial;

  public function __construct($titulo, $autor, $anioPublicacion, $numeroHojas, $editorial) {
    $this->titulo = $titulo;
    $this->autor = $autor;
    $this->anioPublicacion = $anioPublicacion;
    $this->numeroHojas = $numeroHojas;
    $this->editorial = $editorial;
  }
  public function getTitulo() {
    return $this->titulo;
}

public function getAutor() {
    return $this->autor;
}

public function getAnioPublicacion() {
    return $this->anioPublicacion;
}

public function getNumeroHojas() {
    return $this->numeroHojas;
}

public function getEditorial() {
    return $this->editorial;
}
  public function __toString() {
    return "<div class='libro'>
        <p class='titulo'>Título del libro: {$this->titulo}<p>
        <p class='autor'>Autor: {$this->autor}</p>
        <p class='anioPublicacion'>Año de publicación: {$this->anioPublicacion}</p>
        <p class='numeroHojas'>Número de páginas: {$this->numeroHojas}</p>
        <p class='editorial'>Editorial: {$this->editorial}</p>
      </div>";
  }

}