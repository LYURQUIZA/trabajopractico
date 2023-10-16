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
    require_once "filtro.php";
    session_start();
    if (isset($_SESSION['usuario'])) {
        $usuario = unserialize($_SESSION['usuario']);
        if ((isset($_GET["generofiltro"])) and (isset($_GET["autorfiltro"]))){
            cargar_libros($_GET["generofiltro"],$_GET["autorfiltro"],$usuario);
        }
        else
        {
            cargar_libros(1,1,$usuario);    
        }
        ?>
        <form action="perfil.php" method="post">
        <input type="submit" value="perfil">
        </form>
        <?php
    }
    else
    {
        if ((isset($_GET["generofiltro"])) and (isset($_GET["autorfiltro"]))){
            cargar_libros($_GET["generofiltro"],$_GET["autorfiltro"]);
        }
        else
        {
            cargar_libros(1,1);
        }   
        ?>
        <form action="iniciar_sesion.php" method="post">
        <input type="submit" value="Iniciar sesion">
        </form>
        <?php
    }
    ?>
    <form action="index.php" method="get">
        <?php echo (filtro()); ?>
        <input type="submit" value="filtrar">
    </form>
</body>
</html>