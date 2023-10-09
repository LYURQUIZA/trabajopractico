<?php
require_once 'Repositorio.php';
require_once 'clases/libro/libro.php';
require_once 'clases/usuario/Usuario.php';

class RepositorioLibro extends Repositorio{

    public function CargarLibros(){

        $q = "SELECT libros.id_libro ,libros.titulo , libros.descripcion, generos.genero, autores.autor FROM libros "; 
        $q .="INNER JOIN autores_libros  ON libros.id_libro = autores_libros.id_libro ";
        $q .="INNER JOIN autores ON autores_libros.id_autor = autores.id_autor ";
        $q .="INNER JOIN generos_libros on libros.id_libro = generos_libros.id_libro ";
        $q .="INNER JOIN generos on generos.id_genero = generos_libros.id_genero ";
        $q .="ORDER BY libros.id_libro;";
        
        return $this->CargadorSelect($q);
    }

    public function MiLista(Usuario $usuario){
        $id_usuario = $usuario->getId();

        $q = "SELECT libros.id_libro ,libros.titulo , libros.descripcion, generos.genero, autores.autor, lista_usuarios_libros.leido FROM usuarios ";
        $q .="INNER JOIN lista_usuarios_libros  ON usuarios.id_usuario = lista_usuarios_libros.id_usuario ";
        $q .="INNER JOIN libros ON libros.id_libro = lista_usuarios_libros.id_libro ";
        $q .="INNER JOIN autores_libros  ON libros.id_libro = autores_libros.id_libro ";
        $q .="INNER JOIN autores ON autores_libros.id_autor = autores.id_autor ";
        $q .="INNER JOIN generos_libros on libros.id_libro = generos_libros.id_libro ";
        $q .="INNER JOIN generos on generos.id_genero = generos_libros.id_genero ";
        $q .="WHERE usuarios.id_usuario = ? ";  
        $q .="ORDER BY libros.id_libro;";

        return $this->CargadorSelect($q,$id_usuario);
    }

    protected function CargadorSelect($q,$id_usuario = false){
        $libroscargados = array();
        $id_repetido = 0;
        $pos = 0;
        
        $query = self::$conexion->prepare($q);
        if ($id_usuario){
            $query->bind_param("d", $id_usuario);
        }
        
        if ($query->execute()){
            if ($id_usuario){
                $query->bind_result($id, $titulo, $descripcion, $genero, $autor, $leido);
            }
            else
            {
                $query->bind_result($id, $titulo, $descripcion, $genero, $autor);
                $leido = null;
            }
            while ($query->fetch()) {
                if ($id_repetido != $id){
                    $libroscargados[$pos] = new Libro($id,$titulo,$descripcion,$genero,$autor, $leido);
                    $id_repetido = $id;
                    $autor_repetido = 0;
                    $genero_repetido = 0;
                    $pos++;
                }
                else
                {
                    if ($libroscargados[$pos - 1]->autor[$autor_repetido] != $autor){
                        $libroscargados[$pos - 1]->setAutor($autor);
                        $autor_repetido++;
                    }
                    else
                    {
                        $libroscargados[$pos - 1]->setGenero($genero);
                        $genero_repetido++;   
                    }
                }
            }
            return $libroscargados;
        }
        else
        {
            return false;
        }

    }

    public function AgregarLista(Usuario $usuario,$idlibro){
        $id_usuario = $usuario->getId();

        $q = "INSERT INTO lista_usuarios_libros (id_usuario , id_libro) ";
        $q .= "VALUES (?,?)";

        $this->CargadorDeleteInsertUpdate($q,$id_usuario,$idlibro);
    }

    public function EliminarLista(Usuario $usuario,$idlibro){
        $id_usuario = $usuario->getId();

        $q = "DELETE FROM lista_usuarios_libros ";
        $q .= "WHERE id_usuario = ? and id_libro = ?";

        $this->CargadorDeleteInsertUpdate($q,$id_usuario,$idlibro);
    }

    public function CargadorDeleteInsertUpdate($q,$id_usuario,$idlibro){
        $query = self::$conexion->prepare($q);
        $query->bind_param("dd", $id_usuario, $idlibro);
        $query->execute();
    }

    public function MarcarLeido(Usuario $usuario,$idlibro){
        $id_usuario = $usuario->getId();

        $q = "UPDATE lista_usuarios_libros ";
        $q .= "SET leido = CURRENT_TIMESTAMP ";
        $q .= "WHERE id_usuario = ? and id_libro = ?";

        $this->CargadorDeleteInsertUpdate($q,$id_usuario,$idlibro);
    }
}