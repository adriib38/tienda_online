<?php

    session_start();

    //Si la sesión de usuario está iniciada redirige a index.
    if(isset($_SESSION['usuario'])){
        header('Location: index.php');
    }


    include('inc/bd.inc.php');
    include('inc/regex.inc.php');

    $hayErrores = false;

    $formularioEnviado = false;

    $contrasenyaValor = '';
    $repContrasenya = '';

    //Aseguramos que lleguen respuestas antes de validarlas
    if(!empty($_POST)){

        if(!preg_match($usuario, $_POST["usuario"] )){
            $errorNombre = '<br><span class="red"> -Nombre no valido</span>';
            $hayErrores = true;
        }

        if(!preg_match($mail, $_POST["mail"] )){
            $errorMail = '<br><span class="red"> -Mail no valido</span>';
            $hayErrores = true;
        }

        if(!preg_match($contrasenya, $_POST["pass"] )){
            $errorPass = '<br><span class="red"> -Contraseña no valida, mínimo 8 caracteres, numeros y letras</span>';
            $contrasenyaValor = $_POST["pass"];
            $hayErrores = true;
        }

        $contrasenyaValor = $_POST["pass"];
        $repContrasenya = $_POST["rep-pass"];
        if($contrasenyaValor != $repContrasenya){
            $errorRepPass = '<br><span class="red"> Las contraseñas no coinciden</span>';
            $hayErrores = true;
        }

        if(!$hayErrores){
            $passEncriptada = password_hash($_POST["pass"], PASSWORD_DEFAULT);
            $newUser = new User($_POST["usuario"], $passEncriptada, $_POST["mail"], 'cliente');
            
            if(insertUser($newUser)){
                header('Location: login.php');
            }
        }

    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>

    <link rel="stylesheet" href="styles/style.css">
    <script src="https://kit.fontawesome.com/92a45f44ad.js" crossorigin="anonymous"></script>
</head>
</head>
    <body>
    <?php 
        include('inc/cabecera.inc.php');
        
    ?>
        <h2>Registro</h2>
        <form id="registro" action="#" method="post">
            <input type="text" name="usuario" value="<?=$_POST['usuario']??'' ?>">
            <?=$errorNombre??'' ?>
            <input type="mail" name="mail" value="<?=$_POST['mail']??'' ?>">
            <?=$errorMail??'' ?>
            <input type="password" name="pass">
            <?=$errorPass??'' ?>
            <input type="password" name="rep-pass">
            <?=$errorRepPass??'' ?>
            <input type="submit" value="Registrarme">
        </form>
    </body>
</html>