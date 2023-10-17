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
    <link rel="stylesheet" href="estilos.css">
    <title>Mi Lista</title>
</head>
<body>
    <header class="contenedor-header">
        <nav>
            <a href="index.php" class="text-32">Inicio</a>
            <a href="perfil.php" class="text-32">Perfil</a>
        </nav>
    </header>
    <section class="contenedor">
    <?php 
    $cl = new ControladorLibro();
    $mi_lista = $cl->MiLista($usuario);
    if ($mi_lista != false){
        foreach ($mi_lista as  $libro) {
            ?><article class="contenedor2"><?php
            echo ($libro->Mostrar()."<br>");
            echo ('<form action="eliminar_de_lista.php" method="post">'.'<input type="hidden" name="idlibro" value='.  $libro->getId() .'>'.'<input type="submit" value="eliminar de la lista">'.'</form><hr>');
            if ($libro->getLeido() == null){
                echo ('<form action="marcar_leido.php" method="post">'.'<input type="hidden" name="idlibro" value='.  $libro->getId() .'>'.'<input type="submit" value="marcar como leido">'.'</form><hr>');
            }
            ?></article><?php
        }
    }
    else
    {
        echo ('<h2 class="text-32 centrar">No tienes libros seleccionados<h2>');
    }
    ?>
    </section>
  
</body>
</html>