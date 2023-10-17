<?php
require_once 'clases/usuario/Usuario.php';
require_once 'en_sesion.php';

$usuario = en_sesion();
$nomApe = $usuario->getNombreApellido();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title>Libreria</title>
        <link rel="stylesheet" href="bootstrap.min.css">
    </head>
    <body class="container">
      <div class="jumbotron text-center">
      <h1>Libreria</h1>
      </div>
      <div class="text-center">
        <h3>Hola <?php echo $nomApe;?></h3>

        <?php
            if (isset($_GET['mensaje'])) {
                echo '<div id="mensaje" class="alert alert-primary text-center">
                    <p>'.$_GET['mensaje'].'</p></div>';
            }
        ?>
        <p><a href="mi_lista.php">Mi Lista</a></p>
        <p><a href="index.php">Volver al inicio</a></p>
        <p><a href="datos_modificar.php">Modificar datos de mi usuario</a></p>
        <p><a href="confirmar_delete.php">Eliminar mi usuario</a></p>
        <p><a href="logout.php">Cerrar sesión</a></p>
      </div>
    </body>
</html>