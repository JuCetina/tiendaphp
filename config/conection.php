<?php

class Conexion{
    public static function conectar(){
        //$db = new mysqli('localhost', 'root', 'root', 'tienda');
        $db = new mysqli('us-cdbr-east-02.cleardb.com', 'b4c82f831e5cf3', '00dc21aa', 'heroku_0235cc1deec8300');
        $db->query("SET NAMES 'utf8'");
        return $db;
    }
}

session_start();