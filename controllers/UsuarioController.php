<?php

require_once 'models/usuario.php';

class UsuarioController{

    public function registro(){
        require_once 'views/usuario/registro.php';
    }

    public function guardar(){
        if(isset($_POST)){

            if(isset($_POST['nombre']) && isset($_POST['apellidos']) && isset($_POST['email']) && isset($_POST['password'])){

                $nombres = filter_var(trim($_POST['nombre']), FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
                $apellidos = filter_var(trim($_POST['apellidos']), FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
                $email = trim($_POST['email']);
                $password = $_POST['password'];
                
            }

            $errores_datos = false;

            if(empty($nombres) || is_numeric($nombres) || preg_match("/[0-9]/", $nombres)){
                $errores_datos = true;
            }

            if(empty($apellidos) || is_numeric($apellidos) || preg_match("/[0-9]/", $apellidos)){
                $errores_datos = true;
            }
        
            if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errores_datos = true;
            }
        
            if(empty($password)){
                $errores_datos = true;
            }

            if(!$errores_datos){
                $usuario = new Usuario();
                $usuario->setNombres($nombres);
                $usuario->setApellidos($apellidos);
                $usuario->setEmail($email);
                $usuario->setPassword($password);
            
                $almacenado = $usuario->almacenar();

                if($almacenado){
                    $_SESSION['registro'] = 'completed';
                }else{
                    $_SESSION['registro'] = 'failed';
                }

            }else{
                $_SESSION['registro'] = 'failed';
            }
            
        }else{
            $_SESSION['registro'] = 'failed';
        }

        header("Location:".base_url."usuario/registro");
    }

    public function login(){

        if(isset($_POST)){
            if(isset($_POST['email']) && isset($_POST['password'])){

                $usuario = new Usuario();
                $usuario->setEmail($_POST['email']);
                $usuario->setPassword($_POST['password']);
                
                $logueado = $usuario->ingresar();

                if($logueado && is_object($logueado)){
                    $_SESSION['logueado'] = $logueado;

                    if($logueado->rol == 'admin'){
                        $_SESSION['admin'] = true;
                    }
                }else{
                    $_SESSION['error_login'] = "Login incorrecto";
                }
            }else{
                $_SESSION['error_login'] = "Login incorrecto";
            }
        }else{
            $_SESSION['error_login'] = "Login incorrecto";
        }

        header("Location:".base_url);
    }

    public function logout(){
        Utils::deleteSession('admin');
        Utils::deleteSession('logueado');
        header("Location:".base_url);
    }

}