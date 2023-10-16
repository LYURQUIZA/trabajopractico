<?php
require_once 'clases/repositorio/RepositorioLibro.php';
require_once 'clases/libro/Libro.php';
require_once 'clases/usuario/Usuario.php';

class ControladorLibro{

    //devuelve todos los libros o los libros solicitados mediante el filtro
    public function CargarLibros($filtro){
        $rl = new RepositorioLibro();
        $libroscargados = $rl->CargarLibros($filtro);
        return $libroscargados;
    }

    //devuelve todos los libros que tenga el usuario agregado a su lista
    public function MiLista(Usuario $usuario){
        $rl = new RepositorioLibro();
        $mi_lista = $rl->MiLista($usuario);
        return $mi_lista;
    }
    
    public function AgregarLista(Usuario $usuario,$idlibro){
        $rl = new RepositorioLibro();
        $rl->AgregarLista($usuario,$idlibro);
    }

    public function EliminarLista(Usuario $usuario,$idlibro){
        $rl = new RepositorioLibro();
        $rl->EliminarLista($usuario,$idlibro);
    }

    public function MarcarLeido(Usuario $usuario,$idlibro){
        $rl = new RepositorioLibro();
        $rl->MarcarLeido($usuario,$idlibro);
    }

    public function CargarGeneros(){
        $rl = new RepositorioLibro();
        return $rl->CargarGeneros();
    }

    public function CargarAutores(){
        $rl = new RepositorioLibro();
        return $rl->CargarAutores();
    }

    //devuelve un array con los id_libro o false
    public function Filtro($filtro){
        $rl = new RepositorioLibro();
        return $rl->Filtro($filtro);
    }
    
}