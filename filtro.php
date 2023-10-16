<?php 
require_once "clases/libro/Libro.php";
require_once "clases/controlador/ControladorLibro.php";

function filtro(){
    $cl = new ControladorLibro();
    $generos = $cl->CargarGeneros();//trae todos los generos
    $autores = $cl->CargarAutores();//trae todos los autores
    //select
    $filtro = '<select name ="generofiltro"><option value="">Lista de generos</option>';
    $filtro .= crear_filtro($generos);
    //select cerrado
    $filtro .='</select>';
    //select
    $filtro .= '<select name ="autorfiltro"><option value="">Lista de autores</option>';
    $filtro .= crear_filtro($autores);
    //select cerrado
    $filtro .='</select>';
    return $filtro;
}

function crear_filtro($array){
    $opciones = "";
    foreach ($array as $valor) {
        $opciones .= '<option value="'.$valor.'">'.$valor.'</option>';
    }
    return $opciones;
}

?>