<?php
require_once "en_sesion.php";
require_once "clases/controlador/ControladorLibro.php";

$usuario = en_sesion();//id usuario y id libro
if (isset($_POST["idlibro"])){
    $cl = new ControladorLibro();
    $idlibro = $_POST["idlibro"];
    $cl->AgregarLista($usuario,$idlibro);    
}
    header('Location: index.php');
?>