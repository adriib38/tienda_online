<?php
    //Se inicia la sesión
    session_start();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="styles/style.css">
    <script src="https://kit.fontawesome.com/92a45f44ad.js" crossorigin="anonymous"></script>

    <title>Carrito</title>
</head>
<body>
    <?php include('inc/cabecera.inc.php') ?>
    <h2>Carrito</h2>
    <div class="content">
        <?php 
            //Si existe la sesión (hay obketps en el carro)
            if(isset($_SESSION["carrito"])){
            
                //Imprime tabla con los productos
                echo '<table class="carrito">';
                echo '<tr>
                        <td>Producto</td>
                        <td>Precio unidad</td>
                        <td>Unidades</td>
                        <td>Precio total</td>
                    </tr>';
                    
                $totalPagar = 0;
                //Recorre los productos del carro
                $carrito = $_SESSION['carrito'];
                foreach($carrito as $item => $cantidad){
                    
                    $cod = explode("_", $item)[1];

                    include('inc/Conexion.inc.php');
                    //Consulta SELECT de cada codigo de producto
                    $resultado = $conexion->query('SELECT * FROM `productos` WHERE `codigo` = '.$cod.';');
                    unset($conexion);

                    /**
                     * 
                     * Imprime los grupos resultados obtenidos de la consulta.
                     * Cada producto con su precio y unidades añadidas al carro
                     */
                    while ($registro = $resultado->fetch()) { 
                        $totalPagar = $totalPagar + $registro['precio']*$cantidad;   
                    ?>
                        <tr>
                            <td><?=$registro['nombre']??'' ?></td>
                            <td><?=$registro['precio']??'' ?>€</td>
                            <td><?=$cantidad??'' ?> unidades</td>
                            <td><?=$registro['precio']*$cantidad??'' ?>€</td>
                        </tr>
                        
                    <?php }
                
                }
                echo '</tr>';
                echo '<tr>
                <td></td>
                <td></td>
                <td></td>
                <td>'.$totalPagar.'€</td>
                        ';
                echo '</table>';
            }
        ?>
        <p>Pagar ahora <?=$totalPagar??'' ?>€</p>
    </div>
</body>
</html>