<?php

class Libro
{
    protected $id;
    protected $titulo;
    protected $descripcion;
    public $genero = array();
    public $autor = array();
    protected $leido = null;

    public function __construct($id, $titulo, $descripcion, $genero, $autor, $leido = null)
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->genero[] = $genero;
        $this->autor[] = $autor;
        $this->leido = $leido;
    }

    public function getId(){
        return $this->id;
    }

    public function getTitulo(){
        return $this->titulo;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function getGenero(){
        return $this->CargarAutorGenero($this->genero);
    }

    public function getAutor(){
        return $this->CargarAutorGenero($this->autor);
    }

    protected function CargarAutorGenero($carga){
        $salida = "";
        foreach ($carga as $valor){
            $salida .="$valor ";
        }
        return trim($salida);
    }

    public function getLeido(){
        return $this->leido;
    }

    public function setAutor($autor){
        $this->autor[] = $autor;
    }

    public function setGenero($genero){
        $this->genero[] = $genero;
    }

    public function Mostrar(){
            $mostrar = "<table border=1><tr><th>Titulo</th></tr>";
            $mostrar .= "<td>".$this->getTitulo()."</td>";
            $mostrar .="<tr><th>Descripcion</th></tr>";
            $mostrar .= "<td>".$this->getDescripcion()."</td>";
            $mostrar .="<tr><th>Autores</th></tr>";
            $mostrar .="<tr><td>".$this->getAutor()."</td><tr>";
            $mostrar .="<tr><th>Generos</th></tr>";
            $mostrar .="<tr><td>".$this->getGenero()."</td><tr>";
            if ($this->leido != null){
                $mostrar .="<tr><th>Leido el dia ".$this->getLeido()."</th></tr>";
            }
            return $mostrar;
    }
}