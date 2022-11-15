<?php


    session_start();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/92a45f44ad.js" crossorigin="anonymous"></script>

    <title>Carrito</title>
</head>
<body>
    <?php include('inc/cabecera.inc.php') ?>
    <h2>Carrito</h2>
    <?php 
        if(isset($_SESSION)){
           
            //print_r($_SESSION);
            
            foreach($_SESSION as $item => $cantidad){
                
                $cod = explode("_", $item)[1];
                echo $cod;
                echo '-';
                echo $cantidad;
                echo '<br>';

                include('inc/Conexion.inc.php');
                //Consulta SELECT
                $resultado = $conexion->query('SELECT * FROM `productos` WHERE `codigo` = '.$cod.';');
                unset($conexion);

                //Imprime los grupos resultados obtenidos de la consulta
                echo '<table>';
                while ($registro = $resultado->fetch()) {

                ?>
               
                    <td><?=$registro['nombre']??'' ?> - <?=$registro['precio']??'' ?>€ X <?=$cantidad??'' ?> unidades, <?=$registro['precio']*$cantidad??'' ?>€</td>
               
                    
    
                <?php
                    }
           
            
            }
        }

    ?>
</body>
</html>