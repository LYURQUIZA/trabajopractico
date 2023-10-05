<?php
require_once 'clases/repositorio/RepositorioLibro.php';
require_once 'clases/libro/Libro.php';
require_once 'clases/usuario/Usuario.php';

class ControladorLibro{

    public function CargarLibros(){
        $rl = new RepositorioLibro();
        $libroscargados = $rl->CargarLibros();
        return $libroscargados;
    }

    public function MiLista(Usuario $usuario){
        $rl = new RepositorioLibro();
        $mi_lista = $rl->MiLista($usuario);
        return $mi_lista;

    }
}