<?php
require_once 'Repositorio.php';
require_once 'clases/usuario/Usuario.php';

class RepositorioUsuario extends Repositorio{

    //Login de usuario
    //Si el login es exitoso, devuelve una instancia de la clase Usuario
    //Si el login fracasa, devuelve false.
    public function login($nombre_usuario, $clave){
        $q = "SELECT id_usuario, clave, nombre, apellido FROM usuarios WHERE nombre_usuario = ?;";
        $query = self::$conexion->prepare($q);
        $query->bind_param("s", $nombre_usuario);

        if ($query->execute()){
            $query->bind_result($id, $clave_encriptada, $nombre, $apellido);
            if ($query->fetch()) {
                // Validar que la clave esté bien:
                if (password_verify($clave, $clave_encriptada)) {
                    return new Usuario($nombre_usuario, $nombre, $apellido, $id);
                }
            }

        }
        return false;
    }

    //Crea y guarda un usuario en la base de datos
    //Devuelve la id del usuario en caso de crear al usuario correctamente
    //Devuelve false en caso de no poder crear al usuario correctamente
    public function save(Usuario $usuario, $clave){
        $nombre_usuario = $usuario->nombre_usuario;
        $clave = password_hash($clave, PASSWORD_DEFAULT);
        $nombre = $usuario->nombre;
        $apellido = $usuario->apellido;
        

        $q = "INSERT INTO usuarios (nombre_usuario, clave, nombre, apellido) ";
        $q.= "VALUES (?, ? , ? , ?)";
        $query = self::$conexion->prepare($q);
        $query->bind_param("ssss", $nombre_usuario, $clave, $nombre, $apellido);

        try{
            if ($query->execute()){
                return self::$conexion->insert_id;
            }
            else
            {
                throw new Exception("Nombre de usuario ya existente");//esto no se muestra.. de momento xd
            }  
        }
        catch(exception $ex){
            return false;
        }    
    }

    //Elimina el usuario de la base de datos. 
    //Devuelve true si tuvo éxito, false si no.
    public function eliminar(Usuario $usuario){
        $id = $usuario->getId();
        
        $q = "DELETE FROM usuarios WHERE id_usuario = ?";
        $query = self::$conexion->prepare($q);
        $query->bind_param("d", $id);

        return $query->execute();
    }

     //Actualiza en la base de datos los datos del usuario
     //devuelve true si actualizo, false si no actualizo
    public function actualizar(string $nombre_usuario,string $nombre,string $apellido,Usuario $usuario){
        $id = $usuario->getId();
        
        $q = "UPDATE usuarios SET nombre_usuario = ?, nombre = ?, apellido = ? ";
        $q.= " WHERE id_usuario = ?;";
        $query = self::$conexion->prepare($q);
        $query->bind_param("sssd", $nombre_usuario, $nombre, $apellido, $id);

        try{
            if ($query->execute()){
                return true;
            }
            else
            {
                throw new Exception("Nombre de usuario ya existente");//esto no se muestra.. de momento xd
            }  
        }
        catch(exception $ex){
            return false;
        }    
    }
}