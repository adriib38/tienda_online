<?php    
    //Definimos que la sesión expire en 10 minutos, para que se vacíe el carrito.
    ini_set('session.cookie_lifetime', 600000);
    session_start();

    //Si llegan parametros por GET, alguno de los botones de acciones
    if(!empty($_GET)){
        //Le demos un nombre al producto: "cod_" más su codigo.
        $cod = 'cod_'.$_GET['product'].'';

        //Si la acción recibida es "sumar":
        if($_GET['action'] == 'sumar'){
            //Si ya existe en el carro: suma 1.
            if(isset($_SESSION[$cod])){
                $_SESSION[$cod]++;
            }else{
                //Si no existia: se define como 0.
                $_SESSION[$cod] = 1;
            }
        }

        //Si la acción recibida es restar.
        if($_GET['action'] == 'restar'){
            //Si sí existia el producto en el carro:
            if(isset($_SESSION[$cod])){
                //Si el numero es mayor a 0
                if($_SESSION[$cod] > 0){
                    //Restará 1
                    $_SESSION[$cod] = $_SESSION[$cod] - 1;
                }else{
                    //Si el numero no es mayor de 0:
                    //Se pone a 0 y se elimina de carro
                    $_SESSION[$cod] == 0;
                    unset($_SESSION[$cod]);
                }
            }
        }

        //Si la acción recibida es eliminar:
        if($_GET['action'] == 'eliminar'){
            //Si el codigo está en el carro:
            if(isset($_SESSION[$cod])){
                //Se elimina
                unset($_SESSION[$cod]);
            }
        }
        //Redirige a index
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

    <link rel="stylesheet" href="styles/style.css">
    <script src="https://kit.fontawesome.com/92a45f44ad.js" crossorigin="anonymous"></script>
</head>
<body>

        <?php include('inc/cabecera.inc.php') ?>
        <div class="content">
        <h2>Productos</h2>
        <?php
            include('inc/Conexion.inc.php');
            
            //Consulta SELECT de los productos
            $resultado = $conexion->query('SELECT * FROM `productos`;');
            unset($conexion);
            //Imprime los productos, resultados obtenidos de la consulta
            echo '<div class="productos">';
            while ($registro = $resultado->fetch()) {
                ?>    
                <div>
                    <h3><?=$registro['nombre']??'' ?></h3>
                    <p><?=$registro['categoria']??'' ?></p>
                    <p><?=$registro['precio']??'' ?>€</p>
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
    </div>
</body>
</html>