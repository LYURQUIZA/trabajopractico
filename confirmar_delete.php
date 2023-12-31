<?php
require_once 'en_sesion.php'

// Validamos que el usuario tenga sesión iniciada:
$usuario = en_sesion();

?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title>libreria</title>
        <link rel="stylesheet" href="bootstrap.min.css">
    </head>
    <body class="container">
      <div class="jumbotron text-center">
      <h1>Libreria</h1>
      </div>
      <div class="text-center">
            <div id="mensaje" class="alert alert-danger text-center">
                    <p>Advertencia. Ud va a <strong>eliminar</strong> su usuario.
                        Esta acción no se puede deshacer.</p>
            </div>

            <form action="delete.php" method="post">
            <label for="usuario">Escriba su nombre de usuario para <strong>eliminar</strong> su cuenta: </label><br>
            <input name="usuario" class="form-control form-control-lg" placeholder="Usuario"><br>
            <input type="submit" value="Eliminar usuario" class="btn btn-primary">
            </form>
      </div>
    </body>
</html>
