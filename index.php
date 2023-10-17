<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>Libreria</title>
</head>
<body>
    <?php
    require_once "cargar_libros.php"; 
    require_once "clases/usuario/Usuario.php";
    require_once "filtro.php";
    ?>
    <main class="contenedor-main">
        <section class="contenedor-filtro">
            <form action="index.php" method="get">
                <?php echo (filtro()); ?>
                <input type="submit" value="filtrar">
            </form>
        </section>
        <?php
        session_start();
        if (isset($_SESSION['usuario'])) {
            $usuario = unserialize($_SESSION['usuario']);
            ?>
        <header class="contenedor-header">
            <nav>
                <a href="perfil.php" class="text-32">Perfil</a>
            </nav>
        </header>
            <?php
            if ((isset($_GET["generofiltro"])) and (isset($_GET["autorfiltro"]))){
                ?><section class="contenedor"><?php cargar_libros($_GET["generofiltro"],$_GET["autorfiltro"],$usuario);?></section><?php
            }
            else
            {
                ?><section class="contenedor"><?php cargar_libros(1,1,$usuario);?></section><?php    
            }
        }
        else
        {
            ?>
        <header class="contenedor-header">
            <nav>
                <a href="iniciar_sesion.php" class="text-32">Iniciar sesion</a>
            </nav>
        </header>
            <?php
            if ((isset($_GET["generofiltro"])) and (isset($_GET["autorfiltro"]))){
                ?><section class="contenedor"><?php cargar_libros($_GET["generofiltro"],$_GET["autorfiltro"]);?></section><?php
            }
            else
            {
                ?><section class="contenedor"><?php cargar_libros(1,1);?></section><?php
            }   
        }
        ?>
    </main>
</body>
</html>