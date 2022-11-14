<?php


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicion</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Productos</h2>
    
    <?php
        include('inc/Conexion.inc.php');
        
        //Consulta SELECT
        $resultado = $conexion->query('SELECT * FROM `productos`;');
        unset($conexion);
        //Imprime los grupos resultados obtenidos de la consulta
        echo '<div class="productos">';
        while ($registro = $resultado->fetch()) {
            ?>    
            <div>
                <h3><?=$registro['nombre']??'' ?></h3>
                <p><?=$registro['categoria']??'' ?></p>
                <p><?=$registro['precio']??'' ?></p>
                <img width="250px" src="<?=$registro['imagen']??'' ?>">
                <p>Stock <?=$registro['stock']??'' ?></p>
            </div>
        <?php
        }
        echo '</div>';
    ?>
</body>
</html>