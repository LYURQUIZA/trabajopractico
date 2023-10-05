<?php
require_once 'en_sesion.php';
require_once 'clases/usuario/Usuario.php';
require_once 'clases/libro/Libro.php';
require_once 'clases/controlador/ControladorLibro.php';
require_once 'clases/controlador/ControladorSesion.php';

$usuario = en_sesion();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Lista</title>
</head>
<body>
    <?php 
    $cl = new ControladorLibro();
    $mi_lista = $cl->MiLista($usuario);
    if ($mi_lista != false){
        foreach ($mi_lista as  $libro) {
            echo ($libro->Mostrar()."<br>");
        }
    }
    else
    {
        echo ("No tiene libros seleccionados");
    }

    ?>
</body>
</html>