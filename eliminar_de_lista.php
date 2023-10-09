<?php
require_once "en_sesion.php";
require_once "clases/controlador/ControladorLibro.php";

$usuario = en_sesion();
if (isset($_POST["idlibro"])){
    $cl = new ControladorLibro();
    $idlibro = $_POST["idlibro"];
    $cl->EliminarLista($usuario,$idlibro);    
}
    header('Location: mi_lista.php');
?>