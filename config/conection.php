<?php

class Conexion{
    public static function conectar(){
        $db = new mysqli('localhost', 'root', 'root', 'tienda');
        $db->query("SET NAMES 'utf8'");
        return $db;
    }
}

session_start();