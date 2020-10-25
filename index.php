<?php

require_once 'autoload.php';

require_once 'config/conection.php';

require_once 'config/parameters.php';
require_once 'helpers/utils.php';

require_once 'views/layout/header.php';
require_once 'views/layout/sidebar.php';

//Función que llama la vista de error 404
function mostrar_error(){
    $error = new ErrorController();
    $error->index();
}

//Si existe $_GET['controller'] guarda en la variable $nombre_controlador el nombre del controlador
if(isset($_GET['controller'])){
    $nombre_controlador = $_GET['controller'] . 'Controller';
    $nombre_controlador = ucfirst($nombre_controlador);

/*Si no existe $_GET['controller'] ni $_GET['action'] guarda en la variable $nombre_controlador 
el controlador por defecto ProductoController, que esta almacenado en la constante default_controller y
guarda en la variable $action el método por defecto index, que está almacenado en 
la constante default_action*/ 
}elseif(!isset($_GET['action'])){
    $nombre_controlador = default_controller;
    $action = default_action;

//Si no existe $_GET['controller'] pero si existe $_GET['action'] muestra error 404
}else{
    mostrar_error();
    exit();
}

//Si existe la clase almacenada en $nombre_controlador, instancia un objeto de dicha clase 
//en la variable $controlador
if(class_exists($nombre_controlador)){

    $controlador = new $nombre_controlador;

    //Si existe $_GET['action'] Y el método que está almacenado allí existe en la clase instanciada,
    //ejecuta dicho método en dicha clase
    if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){
        $action = $_GET['action'];
        $controlador->$action();

    //Si no existe $_GET['action'] guarda en la variable $action 
    //el método por defecto index, que está almacenado en la constante default_action
    //y ejecuta dicho método en la clase instanciada en la variable $controlador
    }elseif(!isset($_GET['action'])){
        $action = default_action;
        $controlador->$action();

    //Si existe $_GET['action'] pero el método que está almacenado allí no existe en la clase instanciada,
    //muestra error 404
    }else{
        mostrar_error();
    }

//Si no existe la clase almacenada en $nombre_controlador, muestra error 404
}else{
    mostrar_error();
}


require_once 'views/layout/footer.php';