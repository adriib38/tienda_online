<?php

    include('inc/User.inc.php');

    $user = 'Lumos';
    $password = 'Nox';
    $bdName = 'tiendamercha';
    $host = 'localhost';
    $port = '3306';

    //Información de la base de datos
    $dsn = 'mysql:host='.$host.';port='.$port.';dbname='.$bdName.'';          
    $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
 
    /**
    * Inserta un usuario
    */
    function insertUser($userCrear){
        global $dsn, $user, $password, $opciones;
        $conexion = new PDO($dsn, $user, $password, $opciones);

        try{
            $consulta = $conexion->prepare('INSERT INTO usuarios
                (usuario, email, contrasenya, rol, token) 
                VALUES (?, ?, ?, ?, ?);');
            $consulta->bindParam(1, $userCrear->usuario);
            $consulta->bindParam(2, $userCrear->email);
            $consulta->bindParam(3, $userCrear->contrasenya);
            $consulta->bindParam(4, $userCrear->rol);
            $consulta->bindParam(5, $userCrear->token);

            $consulta->execute();

            unset($conexion);

            return true;
        }catch(PDOException $e){
            return false;
        }   
    }


    /**
    * Si el email coincide con la contraseña devuelve el usuario; Si no devuelve false
    *
	* @deprecated desde login2
	*/
    function login($email, $pass){
        global $dsn, $user, $password, $opciones;
        $conexion = new PDO($dsn, $user, $password, $opciones);

        try{  
            $resultado = $conexion->query('SELECT contrasenya, usuario FROM usuarios WHERE email like "'.$email.'";');
            unset($conexion);

            $filas = $resultado->rowCount();
            if($filas != 0){
                $passObtenida = $resultado->fetch();
                if(password_verify($pass, $passObtenida["contrasenya"])){
                    return $passObtenida["usuario"];
                }else {
                    return false;
                }
            }else{
                return false;
            }
        }catch(Exception $e){
            return false;
        }
    }

    /**
    * Devuelve usuario por id.
    */
    function selectUserByUsuario($usuario){
        global $dsn, $user, $password, $opciones;
        $conexion = new PDO($dsn, $user, $password, $opciones);

        $returnUser = null;

        try{
            //Consulta SELECT
            $resultado = $conexion->query('SELECT * FROM `usuarios` WHERE `usuario` LIKE "'.$usuario.'"');
            unset($conexion);

            $filas = $resultado->rowCount();
            if($filas == 0){ 
                return false;
            };

            $userObtenido = $resultado->fetch();
            $usr = new User($userObtenido['usuario'], $userObtenido['contrasenya'], $userObtenido['email'], $userObtenido['rol'], $userObtenido['email'], $userObtenido['token']);
            return $usr;
        }catch(Exception $e){
            return false; 
        }
        return false;
    }

    function insertarTokenLogin($usuario){
        global $dsn, $user, $password, $opciones;
        $conexion = new PDO($dsn, $user, $password, $opciones);

        try{
            $token = bin2hex(random_bytes(90));

            $resultado = $conexion->query('UPDATE `usuarios` SET `token`="'.$token.'" WHERE `usuario` LIKE "'.$usuario.'"');
            unset($conexion);
    
            setcookie('token', $token, time()+800000);
        }catch(Exception $e){
            return false;
        }
       
    }

    /**
     * 
     * Comprueba si existe el token, si existe luego se inicia la sesión
     */
    function selectTokenLogin($usuario){
        global $dsn, $user, $password, $opciones;
        $conexion = new PDO($dsn, $user, $password, $opciones);

        $token = bin2hex(random_bytes(90));

        $resultado = $conexion->query('SELECT * FROM `usuarios` WHERE `usuario` LIKE "'.$usuario.'"');
        unset($conexion);

        $filas = $resultado->rowCount();
        if($filas == 0){ 
            return false;
        };

        $userObtenido = $resultado->fetch();
        
    
        return $userObtenido['token'];

    }

    /**
     * 
     * Comprueba si en la base de datos existe el token
     */
    function existenElTokenEnLaBD($token){
        global $dsn, $user, $password, $opciones;
        $conexion = new PDO($dsn, $user, $password, $opciones);

        try{
            $token = bin2hex(random_bytes(90));

            $resultado = $conexion->query('SELECT * FROM `usuarios` WHERE token LIKE "'.$token.'"');
            unset($conexion);
    
            $filas = $resultado->rowCount();
            if($filas == 0){ 
                return false;
            }else{
                return true;
            }
        }catch(Exception $e){
            return false;
        }
      
    }

    /**
    * Devuelve usuario por token.
    */
    function selectUserByToken($token){
        global $dsn, $user, $password, $opciones;
        $conexion = new PDO($dsn, $user, $password, $opciones);

        $returnUser = null;

        try{
            //Consulta SELECT
            $resultado = $conexion->query('SELECT * FROM `usuarios` WHERE `token` LIKE "'.$token.'"');
            unset($conexion);

            $filas = $resultado->rowCount();
            if($filas == 0){ 
                return false;
            };

            $userObtenido = $resultado->fetch();
            $usr = new User($userObtenido['usuario'], $userObtenido['contrasenya'], $userObtenido['email'], $userObtenido['rol'], $userObtenido['email'], $userObtenido['token']);
            return $usr;
        }catch(Exception $e){
            return false; 
        }
        return false;
    }
?>