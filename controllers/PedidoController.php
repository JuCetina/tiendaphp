<?php

require_once 'models/pedido.php';

class PedidoController{
    public function comprar(){
        require_once 'views/pedido/comprar.php';
    }

    public function guardar(){
        if(isset($_SESSION['logueado'])){
            if(isset($_POST)){

                if(isset($_POST['depto']) && isset($_POST['ciudad']) && isset($_POST['direccion'])){
                    $depto = filter_var(trim($_POST['depto']), FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
                    $ciudad = filter_var(trim($_POST['ciudad']), FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
                    $direccion = filter_var(trim($_POST['direccion']), FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
                }
    
                $errores_datos = false;
    
                if(empty($depto) || is_numeric($depto) || preg_match("/[0-9]/", $depto)){
                    $errores_datos = true;
                }
    
                if(empty($ciudad) || is_numeric($ciudad) || preg_match("/[0-9]/", $ciudad)){
                    $errores_datos = true;
                }
    
                if(empty($direccion) || is_numeric($direccion)){
                    $errores_datos = true;
                }
    
                if(!$errores_datos){

                    $total = 0;
                    foreach($_SESSION['carrito'] as $indice => $elemento){
                        $total += $elemento['producto']->precio * $elemento['unidades'];
                    }

                    $usuario_id = $_SESSION['logueado']->id;

                    $pedido = new Pedido();
                    $pedido->setUsuario_id($usuario_id);
                    $pedido->setDepartamento($depto);
                    $pedido->setCiudad($ciudad);
                    $pedido->setDireccion($direccion);
                    $pedido->setCosto($total);
    
                    $almacenado = $pedido->almacenar();
                    $guardado = $pedido->almacenarPedidoProducto();
    
                    if($almacenado && $guardado){
                        $_SESSION['pedido'] = 'completed';
                    }else{
                        $_SESSION['pedido'] = 'failed';
                    }

                    header("Location:".base_url."pedido/confirmado");
                }else{
                    $_SESSION['pedido'] = 'failed';
                    header("Location:".base_url."pedido/comprar");
                }
            }else{
                header("Location:".base_url);
            }
        }else{
            header("Location:".base_url);
        }
        
    }

    public function confirmado(){
        if(isset($_SESSION['logueado'])){
            $pedidos = new Pedido();
            $pedidos->setUsuario_id($_SESSION['logueado']->id);
            $pedido = $pedidos->getOneByUser();

            $pedido_producto = new Pedido();
            $pedido_productos = $pedido_producto->getProductosPorPedido($pedido->id);
        }
        require_once 'views/pedido/confirmado.php';
    }

    public function mis_pedidos(){
        if(isset($_SESSION['logueado'])){
            $usuario_id = $_SESSION['logueado']->id;

            $pedido = new Pedido();
            $pedido->setUsuario_id($usuario_id);
            $pedidos = $pedido->getAllByUser();
            require_once 'views/pedido/mis_pedidos.php';
        }else{
            header("Location:".base_url);
        }
    }

    public function detalle(){
        if(isset($_SESSION['logueado'])){
            if(isset($_GET['id'])){
                $pedido_id = $_GET['id'];
                $pedido = new Pedido();
                $pedido->setId($pedido_id);
                $ped = $pedido->getOne();
                
                require_once 'views/pedido/detalle.php';
            }else{
                header("Location:".base_url);
            }
        }else{
            header("Location:".base_url);
        }
    }

    public function gestion(){
        Utils::isAdmin();

        $gestion = true;

        $pedido = new Pedido();
        $pedidos = $pedido->getAll();

        require_once 'views/pedido/mis_pedidos.php';
    }

    public function estado(){
        Utils::isAdmin();

        if(isset($_GET['id'])){

            $pedido_id = $_GET['id'];
        
            if(isset($_POST)){

                if(isset($_POST['estado'])){
                    $estado = filter_var(trim($_POST['estado']), FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);                
                }
    
                $errores_datos = false;
    
                if(empty($estado) || is_numeric($estado) || preg_match("/[0-9]/", $estado) || ($estado != "En preparación" &&  $estado != "Enviado")){
                    $errores_datos = true;
                }
    
                if(!$errores_datos){
                    $pedido = new Pedido();
                    $pedido->setId($pedido_id);
                    $pedido->setEstado($estado);
                    $actualizado = $pedido->actualizarEstado();
    
                    if($actualizado){
                        $_SESSION['estado'] = 'completed';
                    }else{
                        $_SESSION['estado'] = 'failed';
                    }
                }else{
                    $_SESSION['estado'] = 'failed';
                }
            }        
        }
            
        header("Location:".base_url."pedido/gestion");
           
    }
}