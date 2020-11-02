<?php

class Pedido{
    private $id;
    private $usuario_id;
    private $departamento;
    private $ciudad;
    private $direccion;
    private $costo;
    private $estado;
    private $fecha;
    private $hora;

    private $db;

    public function __construct(){
        $this->db = Conexion::conectar();
        $this->estado = 'Confirmado';
        $this->fecha = date('Y-m-d');
        $this->hora = date('H:i:s');
    }

    public function setId($id){
        $this->id = $this->db->real_escape_string($id);
    }

    public function getId(){
        return $this->id;
    }

    public function setUsuario_id($usuario_id){
        $this->usuario_id = $this->db->real_escape_string($usuario_id);
    }

    public function getUsuario_id(){
        return $this->usuario_id;
    }

    public function setDepartamento($departamento){
        $this->departamento = $this->db->real_escape_string($departamento);
    }

    public function getDepartamento(){
        return $this->departamento;
    }

    public function setCiudad($ciudad){
        $this->ciudad = $this->db->real_escape_string($ciudad);
    }

    public function getCiudad(){
        return $this->ciudad;
    }

    public function setDireccion($direccion){
        $this->direccion = $this->db->real_escape_string($direccion);
    }

    public function getDireccion(){
        return $this->direccion;
    }

    public function setCosto($costo){
        $this->costo = $this->db->real_escape_string($costo);
    }

    public function getCosto(){
        return $this->costo;
    }

    public function setEstado($estado){
        $this->estado = $this->db->real_escape_string($estado);
    }

    public function getEstado(){
        return $this->estado;
    }

    public function setFecha($fecha){
        $this->fecha = $this->db->real_escape_string($fecha);
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function setHora($hora){
        $this->hora = $this->db->real_escape_string($hora);
    }

    public function getHora(){
        return $this->hora;
    }

    public function almacenar(){
        $sql = "INSERT into pedidos VALUES(null, {$this->usuario_id}, '{$this->departamento}', '{$this->ciudad}', '{$this->direccion}', {$this->costo}, '{$this->estado}', '{$this->fecha}', '{$this->hora}')";
        $insertado = $this->db->query($sql);
        $result = false;

        if($insertado){
            $result = true;
        }

        return $result;
    }

    public function getAll(){
        $sql = "SELECT *, FORMAT(costo, 2) AS 'costo_formateado' from pedidos ORDER BY id DESC";
        $pedidos = $this->db->query($sql);
        $result = false;

        if($pedidos && $pedidos->num_rows >= 1){
            $result = $pedidos;
        }

        return $result;
    }

    public function getOne(){
        $sql = "SELECT p.id, p.departamento, p.ciudad, p.direccion, pp.producto_id, pp.unidades, pr.nombre, pr.imagen, pr.precio, "
                ."FORMAT(pr.precio, 2) AS 'precio_producto_formateado' from pedidos p "
                ."INNER JOIN pedidos_productos pp ON pp.pedido_id = p.id "
                ."INNER JOIN productos pr ON pr.id = pp.producto_id "
                ."where p.id = {$this->id}";
        $consultado = $this->db->query($sql);
        $result = false;

        if($consultado && $consultado->num_rows >= 1){
            $result = $consultado;
        }

        return $result;
    }

    public function almacenarPedidoProducto(){
        $sql = "SELECT LAST_INSERT_ID() AS 'pedido'";
        $consultado = $this->db->query($sql);
        $pedido_id = $consultado->fetch_object()->pedido;

        foreach($_SESSION['carrito'] as $indice => $elemento){
            $producto = $elemento['producto'];

            $insert = "INSERT into pedidos_productos VALUES(null, {$pedido_id}, {$producto->id}, {$elemento['unidades']})";
            $insertado = $this->db->query($insert);

        }

            $result = false;
            
            if($insertado){
                $result = true;
            }

        return $result;
    }

    public function getOneByUser(){
        $sql = "SELECT id, FORMAT(costo,2) AS 'costo_formateado' from pedidos "
                ."WHERE usuario_id = {$this->usuario_id} "
                ."order by id DESC limit 1";
        $consulta = $this->db->query($sql);
        $result = false;

        if($consulta && $consulta->num_rows == 1){
            $result = $consulta->fetch_object();
        }

        return $result;
    }

    public function getProductosPorPedido($id){
        
        $sql = "SELECT pr.*, pp.unidades from productos pr "
                ."INNER JOIN pedidos_productos pp "
                ."ON pp.producto_id = pr.id "
                ."WHERE pedido_id = {$id}";

        $productos = $this->db->query($sql);
        $result = false;

        if($productos && $productos->num_rows >= 1){
            $result = $productos;
        }

        return $result;
    }

    public function getAllByUser(){
        $sql = "SELECT *, FORMAT(costo, 2) AS 'costo_formateado' from pedidos WHERE usuario_id = {$this->usuario_id} ORDER BY id DESC";
        $pedidos = $this->db->query($sql);
        $result = false;

        if($pedidos && $pedidos->num_rows >= 1){
            $result = $pedidos;
        }

        return $result;
    }
}