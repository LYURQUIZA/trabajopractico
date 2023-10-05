<?php
require_once 'clases/repositorio/RepositorioUsuario.php';
require_once 'clases/usuario/Usuario.php';

class ControladorSesion{
    
    //Verifica el login de usuario.
    //El primer valor del array es true o false, según si el login fue exitoso o no. 
    //El segundo elemento del array es un mensaje que explica el motivo del éxito o fracaso.
    public function login($nombre_usuario, $clave){
        $repo = new RepositorioUsuario();
        $usuario = $repo->login($nombre_usuario, $clave);//devulve false O un objeto de la clase usuario.

        if ($usuario === false){
            return [false, "Error de credenciales"];
        } 
        else 
        {
            session_start();//Iniciamos la sesión 
            $_SESSION['usuario'] = serialize($usuario);//Guardamos el objeto usuario como variable de sesión
            return [true, "Usuario correctamente autenticado"];
        }
    }

    //Crea un nuevo objeto usuario y le solicita al RepositorioUsuario que lo guarde en la base de datos. 
    //Si el guardado fue exitoso, save() devuelve la id del usuario, sino devuelve false.
    //Si save() devuelve una id, se devuelve en el primer valor del array true, sino false. 
    //El segundo valor del array retornado es un mensaje detallando el exito o el fracaso de la creacion.
    function create($nombre_usuario, $nombre, $apellido, $clave){
        $repo = new RepositorioUsuario();
        $usuario = new Usuario($nombre_usuario, $nombre, $apellido);
        $id = $repo->save($usuario, $clave);
        if ($id === false) {
            return [ false, "Error al crear el usuario" ];
        } 
        else 
        {
            $usuario->setId($id);//se le asigna la id al objeto usuario devuelto por la base de datos 
            session_start();//Iniciamos la sesión
            $_SESSION['usuario'] = serialize($usuario);//Guardamos el objeto usuario como variable de sesión
            return [ true, "Usuario creado correctamente" ];
        }
    }

    //Elimina el usuario. Devuelve true si tuvo exito, sino false.
    function eliminar(Usuario $usuario){
        $repo = new RepositorioUsuario();
        return $repo->eliminar($usuario);
    }

    //Solicita que se actualicen los datos del usuario en la base de datos
    //si tiene exito, actualiza también los datos del usuario almacenados en la sesión.
    //Devuelve true si tuvo éxito, sino false.
    function modificar(string $nombre_usuario, string $nombre, string $apellido, Usuario $usuario){
        $repo = new RepositorioUsuario();

        if ($repo->actualizar($nombre_usuario, $nombre, $apellido, $usuario)) {
            $usuario->setDatos($nombre_usuario, $nombre, $apellido);//Se actualizan los valores en el objeto Usuario
            $_SESSION['usuario'] = serialize($usuario);//Actualizo los datos del usuario almacenados en la sesión.

            return true;
        }
        else 
        {
            return false;
        }
    }
}