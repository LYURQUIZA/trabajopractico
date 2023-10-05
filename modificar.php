<?php

require_once 'clases/usuario/Usuario.php';
require_once 'clases/controlador/ControladorSesion.php';
require_once 'en_sesion.php'

// Validamos que el usuario tenga sesión iniciada:
$usuario = en_sesion();

// Validamos lo que llegó por POST.
if (
    empty($_POST['nombre_usuario'])
    || empty($_POST['nombre'])
    || empty($_POST['apellido'])
) {
    $mensaje = "No fue posible realizar la actualización, faltan campos.";
    header("Location:perfil.php?mensaje=$mensaje");
    die();
}

$cs = new ControladorSesion();

$resultado = $cs->modificar($_POST['nombre_usuario'], $_POST['nombre'], $_POST['apellido'], $usuario);

if ($resultado) {
    $redirigir = "perfil.php?mensaje=Datos actualizados correctamente";
} else {
    $redirigir = "perfil.php?mensaje=Error al actualizar datos";
}
header("Location: $redirigir");



