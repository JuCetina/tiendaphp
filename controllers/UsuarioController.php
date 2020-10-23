<?php

class UsuarioController{
    public function index(){
        echo 'Controlador UsuarioController, método index.';
    }
    public function registro(){
        require_once 'views/usuario/registro.php';
    }
    public function guardar(){
        if(isset($_POST)){
            var_dump($_POST);
        }
    }
}