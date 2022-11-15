<?php

    //Parametros base de datos
    $dsn = 'mysql:host=localhost;port=3306;dbname=tiendamercha';
    $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

    //Se hace conexión a la bd
    try {  
        $conexion = new PDO($dsn, 'Lumos', 'Nox', $opciones);
    } catch(PDOException $e) {
        echo 'Error durante la conexión.';
    }
    
?>