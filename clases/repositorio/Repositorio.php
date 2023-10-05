<?php
require_once '.env.php';

class Repositorio{
    protected static $conexion = null;

    public function __construct(){
        $credenciales = credenciales();//credenciales() esta guardado en .env.php
        if (is_null(self::$conexion)) {
            self::$conexion = new mysqli($credenciales['servidor'],$credenciales['usuario'],$credenciales['clave'],$credenciales['base_de_datos']);
        }
        if (self::$conexion->connect_error) {
            $error = 'Error de conexion: ' . self::$conexion->connect_error;
            self::$conexion = null;
            die($error);
        }
        self::$conexion->set_charset('utf8mb4');
    }
}