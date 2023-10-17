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
            $mostrar = '<table border=1>';
            $mostrar .= '<tr><th class="text-32 naranja">'.$this->getTitulo().'</th></tr>';
            $mostrar .='<tr><th class="text-24">Descripcion</th></tr>';
            $mostrar .= "<td>".$this->getDescripcion()."</td>";
            $mostrar .='<tr><th class="text-24">Autores</th></tr>';
            $mostrar .="<tr><td class=centrar>".$this->getAutor()."</td><tr>";
            $mostrar .='<tr><th class="text-24">Generos</th></tr>';
            $mostrar .="<tr><td class=centrar>".$this->getGenero()."</td><tr>";
            if ($this->leido != null){
                $mostrar .="<tr><th>Leido el dia ".$this->getLeido()."</th></tr>";
            }
            $mostrar .='</table>';
            return $mostrar;
    }
}