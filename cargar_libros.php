<?php 
require_once "clases/libro/Libro.php";
require_once "clases/controlador/ControladorLibro.php";
require_once "clases/usuario/Usuario.php";
        
function datos_a_filtrar($genero,$autor){
    $filtro[0] = $genero;
    $filtro[1] = $autor;
    $cl = new ControladorLibro();
    $id_libros_a_filtrar = $cl->Filtro($filtro);
    return $id_libros_a_filtrar;
}
    
function mostrarlibros($libroscargados,$ignorar = false){    
    if ($libroscargados !== false){//si no hay libros,libroscargados es falso, sino un array con objetos de la clase libro
        foreach ($libroscargados as  $libro) {
            ?><article class="contenedor2"><?php
            echo ($libro->Mostrar());
            if ($ignorar !== false){//ignorar va a ser falso si el usuario no esta logeado o 0 si no tiene libros en su lista
                if (!(in_array($libro->getId(),$ignorar))){//si el id del libro no se encuentra en el array ignorar, te permite agregarlo a la lista
                    echo ('<form action="agregar_a_lista.php" method="post">'.'<input type="hidden" name="idlibro" value='.  $libro->getId() .'>'.'<input type="submit" class ="boton" value="agregar a la lista">'.'</form><br>');     
                }
            }
            ?></article><?php
        }
    }
    else
    {
        echo ("No hay libros para mostrar");
    }
}

//valen 1 si no existen 
function cargar_libros($genero = 1,$autor = 1,Usuario $usuario = null){
    if (($genero === 1 and $autor === 1) or ($genero === "" and $autor === "")){
        $filtro = false;
        $cl = new ControladorLibro();
        $libroscargados = $cl->CargarLibros($filtro);//trae todos los libros
    }
    else
    {
        $filtro = datos_a_filtrar($genero,$autor);//devuelve las id de los libros que cumplen la condicion, o falso
        $cl = new ControladorLibro();
        $libroscargados = $cl->CargarLibros($filtro);//trae los libros segun la condicion del filtro, si filtro vale false, se traen todos los libros
    }

    if ($usuario !== null){//si usuario es distinto de null, significa que esta logeado y que la funcion recibio el objeto usuario
        $cl = new ControladorLibro();
        $milista = $cl->MiLista($usuario);//Trae los libros que el usuario selecciono previamente
        if ($milista !== false){
            foreach ($milista as $libro) {
                $ignorar[] = $libro->getId();//guarda la id de todos los libros del usuario
            }
            if (!isset($ignorar)){//si no tiene valor, le asigna 0
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