<?php
    include('inc\bd.inc.php');

    session_start();

    if(!empty($_POST)){  

        $usuario = login($_POST["mail"], $_POST["pass"]);
        if($usuario){
            /*
            * Sesión inciada correctamente
            */
            $usr = selectUserByUsuario($usuario);
            $_SESSION['usuario'] = $usr;
           
            header('Location: index.php');
        } else {
            $mensajeInicioFallido = '<p class="red">Inicio fallido</p>';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="styles/style.css">
    <script src="https://kit.fontawesome.com/92a45f44ad.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php 
        include('inc/cabecera.inc.php');
    ?>
    <form action="#" method="post">
        Email: <input type="text" name="mail" id="">
        Password: <input type="password" name="pass" id="">
        <input type="submit" value="Login">
    </form>
</body>
</html>