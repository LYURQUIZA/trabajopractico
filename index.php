<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libreria</title>
</head>
<body>
    <?php
    require_once "clases/libro/Libro.php";
    require_once "clases/controlador/ControladorLibro.php"; 
    session_start();
    $cl = new ControladorLibro();
    $libroscargados = $cl->CargarLibros();
    if ($libroscargados !== false){
        foreach ($libroscargados as  $libro) {
            echo ($libro->Mostrar()."<br>");
        }
    }
    else
    {
        echo ("No hay libros para mostrar");
    }
    
    ?>
    <form action="iniciar_sesion.php" method="post">
        <input type="submit" value="Iniciar sesion">
    </form>

</body>
</html>