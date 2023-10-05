<?php
require_once 'clases/usuario/Usuario.php';

session_start();
function en_sesion(){
// Validamos que el usuario tenga sesión iniciada:
if (isset($_SESSION['usuario'])) {
    // Si es así, recuperamos la variable de sesión
    $usuario = unserialize($_SESSION['usuario']);
    return $usuario;
} 
else 
{
    // Si no, redirigimos al login
    header('Location: iniciar_sesion.php');
}
}
?>