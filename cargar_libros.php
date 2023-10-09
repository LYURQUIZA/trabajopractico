<?php
require_once "clases/libro/Libro.php";
require_once "clases/controlador/ControladorLibro.php"; 
require_once "clases/usuario/Usuario.php";

function mostrarlibros($libroscargados,$ignorar = false){    
    if ($libroscargados !== false){//si no hay libros,libroscargados es falso, sino un array con objetos de la clase libro
        foreach ($libroscargados as  $libro) {
            echo ($libro->Mostrar()."<br>");
            if ($ignorar !== false){//ignorar va a ser falso si el usuario no esta logeado o 0 si no tiene libros en su lista
                if (!(in_array($libro->getId(),$ignorar))){//si el id del libro no se encuentra en el array ignorar, te permite agregarlo a la lista
                    echo ('<form action="agregar_a_lista.php" method="post">'.'<input type="hidden" name="idlibro" value='.  $libro->getId() .'>'.'<input type="submit" value="agregar a la lista">'.'</form><hr>');     
                }
            }
        }
    }
    else
    {
        echo ("No hay libros para mostrar");
    }
}

function cargar_libros(Usuario $usuario = null){
    $cl = new ControladorLibro();
    $libroscargados = $cl->CargarLibros();//trae todos los libros
    
    if ($usuario !== null){//si usuario es distinto de null, significa que esta logeado y que la funcion recibio el objeto usuario
        $cl = new ControladorLibro();
        $milista = $cl->MiLista($usuario);//Trae los libros que el usuario selecciono previamente
        if ($milista !== false){
            foreach ($milista as $libro) {
                $ignorar[] = $libro->getId();//guarda la id de todos los libros del usuario
            }
            if ($ignorar === null){
                $ignorar[0] = 0;
            }
            mostrarlibros($libroscargados,$ignorar);
        }     
    }
    else//si no esta logeado
    {
        mostrarlibros($libroscargados);
    }
}
?>