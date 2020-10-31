<?php

class Producto{
    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
    private $imagen;

    private $zonaHoraria;
    private $db;

    public function __construct(){
        $this->db = Conexion::conectar();
        $this->fecha = date('Y-m-d');
    }

    public function setId($id){
        $this->id = $this->db->real_escape_string($id);
    }

    public function getId(){
        return $this->id;
    }

    public function setCategoria_id($categoria_id){
        $this->categoria_id = $this->db->real_escape_string($categoria_id);
    }

    public function getCategoria_id(){
        return $this->categoria_id;
    }

    public function setNombre($nombre){
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setDescripcion($descripcion){
        $this->descripcion = $this->db->real_escape_string($descripcion);
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function setPrecio($precio){
        $this->precio = $this->db->real_escape_string($precio);
    }

    public function getPrecio(){
        return $this->precio;
    }

    public function setStock($stock){
        $this->stock = $this->db->real_escape_string($stock);
    }

    public function getStock(){
        return $this->stock;
    }

    public function setOferta($oferta){
        $this->oferta = $this->db->real_escape_string($oferta);
    }

    public function getOferta(){
        return $this->oferta;
    }

    public function setFecha($fecha){
        $this->fecha = $this->db->real_escape_string($fecha);
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function setImagen($imagen){
        $this->imagen = $this->db->real_escape_string($imagen);
    }

    public function getImagen(){
        return $this->imagen;
    }

    public function getAll(){
        $sql = "SELECT * from productos ORDER BY id DESC";
        $productos = $this->db->query($sql);
        $result = false;

        if($productos && $productos->num_rows >= 1){
            $result = $productos;
        }

        return $result;
    }

    public function almacenar(){
        $sql = "INSERT into productos VALUES(null, {$this->categoria_id}, '{$this->nombre}', '{$this->descripcion}', {$this->precio}, {$this->stock}, '{$this->oferta}', '{$this->fecha}', '{$this->imagen}')";
        $insercion = $this->db->query($sql);
        $result = false;

        if($insercion){
            $result = true;
        }

        return $result;
    }

    public function getOne(){
        $sql = "SELECT *, FORMAT(precio, 2) AS 'precio_formateado' from productos where id = {$this->id}";
        $consultado = $this->db->query($sql);
        $result = false;

        if($consultado && $consultado->num_rows == 1){
            $result = $consultado->fetch_object();
        }

        return $result;
    }

    public function actualizar(){
        $sql = "UPDATE productos SET categoria_id = {$this->categoria_id}, nombre = '{$this->nombre}', descripcion = '{$this->descripcion}', precio = {$this->precio}, stock = {$this->stock}, oferta = '{$this->oferta}', fecha = '{$this->fecha}', imagen = '{$this->imagen}' where id = {$this->id}";
        $actualizacion = $this->db->query($sql);
        $result = false;

        if($actualizacion){
            $result = true;
        }

        return $result;
    }

    public function borrar(){
        $sql = "DELETE from productos where id = {$this->id}";
        $borrado = $this->db->query($sql);
        $result = false;

        if($borrado){
            $result = true;
        }

        return $result;
    }

    public function getRandom($limit){
        $sql = "SELECT *, FORMAT(precio, 2) AS 'precio_formateado' from productos ORDER BY RAND() limit $limit";
        $consulta = $this->db->query($sql);
        $result = false;

        if($consulta && $consulta->num_rows >= 1){
            $result = $consulta;
        }

        return $result;
    }

    public function getAllByCategory(){
        $sql = "SELECT *, FORMAT(precio, 2) AS 'precio_formateado' from productos where categoria_id = {$this->categoria_id}";
        $consulta = $this->db->query($sql);
        $result = false;

        if($consulta && $consulta->num_rows >= 1){
            $result = $consulta;
        }

        return $result;
    }

}