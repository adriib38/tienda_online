<?php
    include('inc/bd.inc.php');

    session_start();

    //Si la sesión de usuario está iniciada redirige a index.
    if(isset($_SESSION['usuario'])){
        header('Location: index.php');
    }

    //Cuando llega algo POST (solicitud inicio de sesión)
    if(!empty($_POST)){  
        $usuario = login($_POST["mail"], $_POST["pass"]);
        if($usuario){
            /*
            * Sesión inciada correctamente
            */
            $usr = selectUserByUsuario($usuario);
            $_SESSION['usuario'] = $usr;
            
            ini_set('session.gc_maxlifetime', 3600);

            if($_POST['recordar'] = 'on'){
                insertarTokenLogin($_SESSION['usuario']->usuario);
            }

            header('Location: index.php');
        } else {
            $mensajeInicioFallido = 'Inicio fallido';
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MerchaShop</title>

    <link rel="stylesheet" href="styles/style.css">
    <script src="https://kit.fontawesome.com/92a45f44ad.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php 
        include('inc/cabecera.inc.php');
    ?>
        
    <p class="red"><?=$mensajeInicioFallido?? ''?></p>

    <form action="#" id="login" method="post">
        Email: <input type="text" name="mail" id="">
        Password: <input type="password" name="pass" id="">
        <label for="sesion_iniciada">Recuerdame </label> <input type="checkbox" name="recordar" id="sesion_iniciada">
        <input type="submit" value="Login">
    </form>
</body>
</html>