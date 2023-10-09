<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libreria</title>
</head>
<body>
    <?php
    require_once "cargar_libros.php"; 
    require_once "clases/usuario/Usuario.php";
    session_start();
    if (isset($_SESSION['usuario'])) {
        $usuario = unserialize($_SESSION['usuario']);
        cargar_libros($usuario);
        ?>
        <form action="perfil.php" method="post">
        <input type="submit" value="perfil">
        </form>
        <?php
    }
    else
    {
        cargar_libros();
        ?>
        <form action="iniciar_sesion.php" method="post">
        <input type="submit" value="Iniciar sesion">
        </form>
        <?php
    } 
    ?>
</body>
</html>