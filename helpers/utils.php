<?php

class Utils{
    public static function deleteSession($session_name){
        if(isset($_SESSION[$session_name])){
            $_SESSION[$session_name] = null;
            unset($_SESSION[$session_name]);
        }
    }
}