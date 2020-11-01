<?php

require_once 'models/producto.php';

class CarritoController{

    public function principal(){
        require_once 'views/carrito/principal.php';
    }

    public function add(){
        /*Si se recibe id del producto por URL, lo guarda en variable $producto_id
        Si no recibe id del producto por URL, redirige a la página principal*/
        if(isset($_GET['id'])){
            $producto_id = $_GET['id'];
        }else{
            header("Location:".base_url);
        }

        //Si la sesión carrito existe, (es decir que hay 1 o más productos en el carrito)
        if(isset($_SESSION['carrito'])){

            //Inicializa variable $producto_diferente en true
            $producto_diferente = true;

            //Recorre los valores de la sesión carrito
            foreach($_SESSION['carrito'] as $indice => $elemento){
                /*Verifica si el id del producto recibido por URL es igual al de otro producto ya almacenado en la sesión carrito,
                Si es así le suma 1 unidad a dicho producto*/
                if($elemento['producto']->id == $producto_id){
                    $_SESSION['carrito'][$indice]['unidades']++;
                    //Y se cambia el valor de la variable $producto_diferente a false
                    $producto_diferente = false;
                }
            }
        }
        
        /*Si no existe la sesión carrito, es decir, que el carrito está vacío
        O si la variable $producto_diferente es igual a true (que quiere decir: que existe la sesión carrito, es decir, que hay
        1 o más productos en el carrito PERO que el producto recibido por URL es un producto DIFERENTE a todos los que ya hay en el carrito)*/
        if(!isset($_SESSION['carrito']) || $producto_diferente == true){
            
            //Obtiene el producto
            $pro = new Producto();
            $pro->setId($producto_id);
            $producto = $pro->getOne();
            
            //Si lo obtenido es un objeto
            if(is_object($producto)){
                /*Crea la sesión carrito si no existe y le añade el producto obtenido y 1 unidad, 
                si existe la sesión carrito, solamente le añade el producto obtenido y 1 unidad*/
                $_SESSION['carrito'][] = array (
                    "producto" => $producto,
                    "unidades" => 1
                );
            }
        }

        header("Location:".base_url."carrito/principal");
    }

    public function remove(){
    }

    public function delete(){
        unset($_SESSION['carrito']);
        header("Location:".base_url."carrito/principal");
    }
}