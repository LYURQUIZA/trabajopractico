<?php
require_once 'clases/repositorio/RepositorioLibro.php';
require_once 'clases/libro/Libro.php';
require_once 'clases/usuario/Usuario.php';

class ControladorLibro{

    //devuelve todos los libros
    public function CargarLibros(){
        $rl = new RepositorioLibro();
        $libroscargados = $rl->CargarLibros();
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
}