<?php

class Usuario{
    private $id;
    private $nombres;
    private $apellidos;
    private $email;
    private $password;
    private $rol;
    private $imagen;

    private $db;

    public function __construct(){
        $this->db = Conexion::conectar();
        $this->rol = 'user';
    }

    public function setNombres($nombres){
        $this->nombres = $this->db->real_escape_string($nombres);
    }

    public function getNombres(){
        return $this->nombres;
    }

    public function setApellidos($apellidos){
        $this->apellidos = $this->db->real_escape_string($apellidos);
    }

    public function getApellidos(){
        return $this->apellidos;
    }

    public function setEmail($email){
        $this->email = $this->db->real_escape_string($email);
    }

    public function getEmail(){
        return $this->email;
    }

    public function setPassword($password){
        $this->password = $this->db->real_escape_string($password);
    }

    public function getPassword(){
        return $this->password;
    }

    public function setRol($rol){
        $this->rol = $this->db->real_escape_string($rol);
    }

    public function getRol(){
        return $this->rol;
    }

    public function setImagen($imagen){
        $this->imagen = $this->db->real_escape_string($imagen);
    }

    public function getImagen(){
        return $this->imagen;
    }

    public function almacenar(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT, ['cost' => 4]);
        $sql = "INSERT into usuarios VALUES(null, '{$this->nombres}', '{$this->apellidos}', '{$this->email}', '{$this->password}', '{$this->rol}', '{$this->imagen}')";
        $guardar = $this->db->query($sql);
        $result = false;
        
        if($guardar){
            $result = true;
        }

        return $result;
    }

    public function ingresar(){
        $email = $this->email;
        $password = $this->password;

        $sql = "SELECT * from usuarios where email = '$email'";
        $ingreso = $this->db->query($sql);
        $result = false;

        if($ingreso && $ingreso->num_rows == 1){
            $usuario = $ingreso->fetch_object();

            $verify = password_verify($password, $usuario->password);

            if($verify){
                $result = $usuario;
            }
        }

        return $result;
    }

}