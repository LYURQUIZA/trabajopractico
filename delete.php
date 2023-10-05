<?php
require_once 'clases/usuario/Usuario.php';
require_once 'clases/controlador/ControladorSesion.php';
require_once 'en_sesion.php'
// Validamos que el usuario tenga sesión iniciada:
$usuario = en_sesion();

if (empty($_POST['usuario']) || $_POST['usuario'] != $usuario->nombre_usuario) {
    header("Location: perfil.php?mensaje=Error al eliminar el usuario");
    die();
}

$cs = new ControladorSesion();

$resultado = $cs->eliminar($usuario);

if ($resultado) {
    $redirigir = "iniciar_sesion.php?mensaje=Usuario eliminado";
    session_destroy();
} else {
    $redirigir = "perfil.php?mensaje=No se pudo eliminar su usuario por un error interno";
}

header("Location: $redirigir");
