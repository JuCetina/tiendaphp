<?php

class Categoria{
    private $id;
    private $nombre;

    private $db;

    public function __construct(){
        $this->db = Conexion::conectar();
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setNombre($nombre){
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getAll(){
        $sql = "SELECT * from categorias ORDER BY id DESC";
        $consulta = $this->db->query($sql);
        $result = false;

        if($consulta && $consulta->num_rows >= 1){
            $result = $consulta;
        }

        return $result;
    }

    public function almacenar(){
        $sql = "INSERT into categorias VALUES(null, '{$this->nombre}')";
        $insercion = $this->db->query($sql);
        $result = false;

        if($insercion){
            $result = true;
        }

        return $result;
    }

    public function getOne(){
        $sql = "SELECT * from categorias where id = {$this->id}";
        $consulta = $this->db->query($sql);
        $result = false;

        if($consulta && $consulta->num_rows == 1){
            $result = $consulta->fetch_object();
        }

        return $result;
    }

    public function actualizar(){
        $sql = "UPDATE categorias SET nombre = '{$this->nombre}' where id = {$this->id}";
        $actualizacion = $this->db->query($sql);
        $result = false;

        if($actualizacion){
            $result = true;
        }

        return $result;
    }

    public function borrar(){
        $sql = "DELETE from categorias where id = {$this->id}";
        $eliminacion = $this->db->query($sql);
        $result = false;

        if($eliminacion){
            $result = true;
        }

        return $result;
    }

}