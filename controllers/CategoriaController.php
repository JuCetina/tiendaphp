<?php

require_once 'models/categoria.php';

class CategoriaController{

    public function principal(){
        Utils::isAdmin();

        $categoria = new Categoria();
        $categorias = $categoria->getAll();        

        require_once 'views/categoria/principal.php';
    }

    public function crear(){
        Utils::isAdmin();
        require_once 'views/categoria/crear.php';
    }

    public function guardar(){
        Utils::isAdmin();
        if(isset($_POST)){

            if(isset($_POST['nombre'])){

                $nombre = filter_var(trim($_POST['nombre']), FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
            }
            
            $errores_datos = false;

            if(empty($nombre) || is_numeric($nombre)){
                $errores_datos = true;
            }

            //Si no hay errores en ninguno de los datos
            if(!$errores_datos){
                $categoria = new Categoria();
                $categoria->setNombre($nombre);

                //Si se recibe un id por GET (por url) es una edición, sino es una inserción
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $categoria->setId($id);

                    $actualizada = $categoria->actualizar();

                    if($actualizada){
                        $_SESSION['categoria_actualizada'] = 'completed';
                    }else{
                        $_SESSION['categoria_actualizada'] = 'failed';
                    }

                    header("Location:".base_url."categoria/editar&id=".$id);

                }else{
                    $guardar = $categoria->almacenar();
                
                    if($guardar){
                        $_SESSION['categoria_crear'] = 'completed';
                    }else{
                        $_SESSION['categoria_crear'] = 'failed';
                    }

                    header("Location:".base_url."categoria/crear");
                }
                
            }else{
                //Si se recibe un id por GET (por url) es una edición, sino es una inserción 
                //y guarda errores en la variable sesión apropiada según el caso
                if(isset($_GET['id'])){
                    $_SESSION['categoria_actualizada'] = 'failed';
                    header("Location:".base_url."categoria/editar&id=".$_GET['id']);
                }else{
                    $_SESSION['categoria_crear'] = 'failed';
                    header("Location:".base_url."categoria/crear");
                }
            }

        }else{
            header("Location:".base_url."categoria/principal");
        }
         
    }

    public function editar(){
        Utils::isAdmin();
    
        if(isset($_GET['id'])){
            $editar = true;
            $id = $_GET['id'];

            $categoria = new Categoria();
            $categoria->setId($id);

            $cat_consultada = $categoria->getOne();

            require_once 'views/categoria/crear.php';

        }else{
            header("Location:".base_url."categoria/principal");
        }

    }

    public function eliminar(){
        Utils::isAdmin();
    
        if(isset($_GET['id'])){

            $id = $_GET['id'];

            $categoria = new Categoria();
            $categoria->setId($id);

            $eliminada = $categoria->borrar();

            if($eliminada){
                $_SESSION['categoria_eliminada'] = 'completed';
            }else{
                $_SESSION['categoria_eliminada'] = 'failed';
            }
        }
        
        header("Location:".base_url."categoria/principal");
    }
}