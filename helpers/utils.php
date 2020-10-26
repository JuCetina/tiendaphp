<?php

class Utils{
    public static function deleteSession($session_name){
        if(isset($_SESSION[$session_name])){
            $_SESSION[$session_name] = null;
            unset($_SESSION[$session_name]);
        }
    }

    public static function isAdmin(){
        if(!isset($_SESSION['admin'])){
            header("Location:".base_url);
        }
    }

    public static function mostrarCategorias(){
        
        require_once 'models/categoria.php';

        $categoria = new Categoria();
        $categorias = $categoria->getAll();

        return $categorias;
    }
}