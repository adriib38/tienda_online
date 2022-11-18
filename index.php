<?php    
    include('inc/bd.inc.php');

    session_start();

    /**
     *  AUTOLOGIN
     * 
     *  Si el usuario ha iniciado sesión y ha dicho "recordarme"
     * 
     *  Si no existe la variable de sesión del usuario y existe la cookie con el token:
     * se comprobará si en la base de datos existe ese token, en caso de existir
     * se obtendrán los datos del usuario y se creará la variable de sesión con
     * ellos. 
     * 
     */
    if(!isset($_SESSION['usuario'])){
        if(isset($_COOKIE['token'])){
            if(existenElTokenEnLaBD($_COOKIE['token'])){
                //Obtener usuario por token e inicia la sesion
                $_SESSION['usuario'] = selectUserByToken($_COOKIE['token']);
            }
        }
    }
   
    //Si llegan parametros por GET, alguno de los botones de acciones
    if(!empty($_GET)){
        //Le demos un nombre al producto: "cod_" más su codigo.
        $cod = 'cod_'.$_GET['product'].'';

        //Si la acción recibida es "sumar":
        if($_GET['action'] == 'sumar'){
            //Si ya existe en el carro: suma 1.
            if(isset($_SESSION['carrito'][$cod])){
                $_SESSION['carrito'][$cod]++;
            }else{
                //Si no existia: se define como 0.
                $_SESSION['carrito'][$cod] = 1;
            }
        }

        //Si la acción recibida es restar.
        if($_GET['action'] == 'restar'){
            //Si sí existia el producto en el carro:
            if(isset($_SESSION['carrito'][$cod])){
                //Si el numero es mayor a 0
                if($_SESSION['carrito'][$cod] > 0){
                    //Restará 1
                    $_SESSION['carrito'][$cod] = $_SESSION['carrito'][$cod] - 1;
                }else{
                    //Si el numero no es mayor de 0:
                    //Se pone a 0 y se elimina de carro
                    $_SESSION['carrito'][$cod] == 0;
                    unset($_SESSION['carrito'][$cod]);
                }
            }
        }

        //Si la acción recibida es eliminar:
        if($_GET['action'] == 'eliminar'){
            //Si el codigo está en el carro:
            if(isset($_SESSION['carrito'][$cod])){
                //Se elimina
                unset($_SESSION['carrito'][$cod]);
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
    <title>🛍️ MerchaShop</title>

    <link rel="stylesheet" href="styles/style.css">
    <script src="https://kit.fontawesome.com/92a45f44ad.js" crossorigin="anonymous"></script>
</head>
<body>

    <?php 

        //Si el usuario está iniciado
        //Dependiendo del rol del usuario iniciado se mostrará una cabacera u otra.
        if(isset($_SESSION['usuario'])){
            if($_SESSION['usuario']->rol == 'cliente'){
                include('inc/cabecera_cliente.inc.php');
            }else{
                include('inc/cabecera_admin.inc.php');
            }
            //Imprime el catalogo de productos
            include('inc/catalogo.inc.php');

        //Si el usuario no está iniciando
        }else{
        
            //NO logeados
            include('inc/cabecera.inc.php');
          
            echo '<div id="botones">';
            echo '<a href="registro.php" class="registro">Registro</a>';
            echo '<a href="login.php" class="login">Login</a>';
            echo '<br>';
            echo '<a href="ofertas.php"><img src="img/ofertas.png" width="660px"></a>';
            echo '</div>';
        }
    ?>
   
</body>
</html>