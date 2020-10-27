<?php

require_once 'models/producto.php';

class ProductoController{
    public function index(){
        require_once 'views/producto/destacados.php';
    }

    public function gestion(){
        Utils::isAdmin();

        $producto = new Producto();
        $productos = $producto->getAll();

        require_once 'views/producto/gestion.php';
    }

    public function crear(){
        Utils::isAdmin();

        require_once 'views/producto/crear.php';
    }

    public function guardar(){
        Utils::isAdmin();

        if(isset($_POST)){

            if(isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['categoria']) && isset($_POST['precio']) && isset($_POST['stock']) && isset($_POST['oferta'])){

                $nombre = filter_var(trim($_POST['nombre']), FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
                $descripcion = filter_var(trim($_POST['descripcion']), FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
                $categoria = trim($_POST['categoria']);
                $precio = trim($_POST['precio']);
                $stock = trim($_POST['stock']);
                $oferta = filter_var(trim($_POST['oferta']), FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
                
            }

            $errores_datos = false;

            if(empty($nombre) || is_numeric($nombre)){
                $errores_datos = true;
            }

            if(empty($descripcion) || is_numeric($descripcion)){
                $errores_datos = true;
            }

            if(empty($categoria) || !is_numeric($categoria)){
                $errores_datos = true;
            }

            if(empty($precio) || !is_numeric($precio)){
                $errores_datos = true;
            }

            if(empty($stock) || !is_numeric($stock)){
                $errores_datos = true;
            }
        
            if(is_numeric($oferta)){
                $errores_datos = true;
            }


            if(!$errores_datos){
                $producto = new Producto();
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setCategoria_id($categoria);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setOferta($oferta);
                

                //Saca los datos de la imagen enviada en el formulario
                $archivo = $_FILES['imagen'];
                $archivo_nombre = $archivo['name'];
                $mimetype = $archivo['type'];
                
                //Si cumple con alguno de los mime type de imágenes
                if($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif"){
                    
                    //Crea carpetas uploads/images en la raiz si no existen
                    if(!is_dir('uploads/images')){
                        mkdir('uploads/images', 0777, true);
                    }
                    
                    //Guarda la imagen (el archivo como tal) en las carpetas uplodas/images 
                    move_uploaded_file($archivo['tmp_name'], 'uploads/images/'.$archivo_nombre);

                    //En la instancia de la clase Producto setea la imagen, enviando su nombre como parámetro
                    $producto->setImagen($archivo_nombre);
                }

                
                $almacenado = $producto->almacenar();

                if($almacenado){
                    $_SESSION['producto_crear'] = 'completed';
                }else{
                    $_SESSION['producto_crear'] = 'failed';
                }

            }else{
                $_SESSION['producto_crear'] = 'failed';
            }
            
        }else{
            $_SESSION['producto_crear'] = 'failed';
        }

        header("Location:".base_url."producto/crear");
    }

    public function editar(){
        Utils::isAdmin();

        if(isset($_GET['id'])){
            $editar = true;
            $id = $_GET['id'];
    
            $producto = new Producto();
            $producto->setId($id);
            $pro_consultado = $producto->getOne();
    
            require_once 'views/producto/crear.php';
        }else{
            header("Location:".base_url."producto/gestion");
        }
    }

    public function guardar_editado(){
        Utils::isAdmin();

        if(isset($_GET['id'])){
            if(isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['categoria']) && isset($_POST['precio']) && isset($_POST['stock']) && isset($_POST['oferta'])){

                $nombre = filter_var(trim($_POST['nombre']), FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
                $descripcion = filter_var(trim($_POST['descripcion']), FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
                $categoria = trim($_POST['categoria']);
                $precio = trim($_POST['precio']);
                $stock = trim($_POST['stock']);
                $oferta = filter_var(trim($_POST['oferta']), FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
                
            }

            $errores_datos = false;

            if(empty($nombre) || is_numeric($nombre)){
                $errores_datos = true;
            }

            if(empty($descripcion) || is_numeric($descripcion)){
                $errores_datos = true;
            }

            if(empty($categoria) || !is_numeric($categoria)){
                $errores_datos = true;
            }

            if(empty($precio) || !is_numeric($precio)){
                $errores_datos = true;
            }

            if(empty($stock) || !is_numeric($stock)){
                $errores_datos = true;
            }
        
            if(is_numeric($oferta)){
                $errores_datos = true;
            }

            $id = $_GET['id'];

            if(!$errores_datos){

                $producto = new Producto();
                $producto->setId($id);
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setCategoria_id($categoria);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setOferta($oferta);
                

                //Saca los datos de la imagen enviada en el formulario
                $archivo = $_FILES['imagen'];
                $archivo_nombre = $archivo['name'];
                $mimetype = $archivo['type'];
                
                //Si cumple con alguno de los mime type de imágenes
                if($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif"){
                    
                    //Crea carpetas uploads/images en la raiz si no existen
                    if(!is_dir('uploads/images')){
                        mkdir('uploads/images', 0777, true);
                    }
                    
                    //Guarda la imagen (el archivo como tal) en las carpetas uplodas/images 
                    move_uploaded_file($archivo['tmp_name'], 'uploads/images/'.$archivo_nombre);

                    //En la instancia de la clase Producto setea la imagen, enviando su nombre como parámetro
                    $producto->setImagen($archivo_nombre);
                }

                
                $actualizado = $producto->actualizar();

                if($actualizado){
                    $_SESSION['producto_actualizado'] = 'completed';
                }else{
                    $_SESSION['producto_actualizado'] = 'failed';
                }

            }else{
                $_SESSION['producto_actualizado'] = 'failed';
            }

            header("Location:".base_url."producto/editar&id=".$id);
            
        }else{
            header("Location:".base_url."producto/gestion");
        }     
    }

    public function eliminar(){
        Utils::isAdmin();

        if(isset($_GET['id'])){
            
            $id = $_GET['id'];
            
            $producto = new Producto();
            $producto->setId($id);

            $eliminado = $producto->borrar();
            
            if($eliminado){
                $_SESSION['producto_eliminado'] = 'completed';
            }else{
                $_SESSION['producto_eliminado'] = 'failed';
            }
        }

        header("Location:".base_url."producto/gestion"); 
    }
}