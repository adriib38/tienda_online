<?php
    session_start();

    print_r($_SESSION);

    if(!empty($_GET)){

        $cod = 'cod_'.$_GET['product'].'';

        if($_GET['action'] == 'sumar'){
            if(isset($_SESSION[$cod])){
                $_SESSION[$cod]++;
            }else{
                $_SESSION[$cod] = 1;
            }
        }

        if($_GET['action'] == 'restar'){
            if(isset($_SESSION[$cod])){
                if($_SESSION[$cod] > 0){
                    $_SESSION[$cod] = $_SESSION[$cod] - 1;
                }else{
                    $_SESSION[$cod] == 0;
                    unset($_SESSION[$cod]);
                }
            }
        }

        if($_GET['action'] == 'eliminar'){
            if(isset($_SESSION[$cod])){
                unset($_SESSION[$cod]);
            }
        }

        header('Location: index.php');
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicion</title>

    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/92a45f44ad.js" crossorigin="anonymous"></script>
</head>
<body>

    <?php include('inc/cabecera.inc.php') ?>
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
                <div class="product-buttons">
                    <a href="index.php?action=sumar&product=<?=$registro['codigo']??'' ?>">
                        <i class="fa-solid fa-circle-plus"></i>
                    </a>
                    <a href="index.php?action=restar&product=<?=$registro['codigo']??'' ?>">
                        <i class="fa-solid fa-circle-minus"></i>
                    </a>
                    <a href="index.php?action=eliminar&product=<?=$registro['codigo']??'' ?>">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>

                </div>
            </div>
        <?php
        }
        echo '</div>';
    ?>
</body>
</html>